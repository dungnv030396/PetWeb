<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function orderLine()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }

    public function moderator()
    {
        return $this->hasOne(User::class, 'id', 'moderator_id');
    }

    public function city(){
        return $this->hasOne(City::class,'code','city_code');

    }

    public function warehouse(){
        return $this->hasOne(Warehouse::class,'id','warehouse_id');

    }

    public function getOrdersAjax($start, $length, $search, $oderColunm, $oderSortType, $draw)
    {
        $columns = array(
            0 => 'id',
            4 => 'created_at'
        );
        // $page = floor($start / $length) + 1;
        $totalData = Order::count();
        if (empty($search)) {
            $orders = Order::where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $orders = Order::whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
                ->orwhereHas('status', function ($query) use ($search) {
                    $query->where('stt', 'like', "%$search%");
                })
                ->where('delete_flag', '=', 0)
                ->orWhere('created_at', 'like', "%$search%")
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $orders->count();
        }

        $data = array();
        if ($orders) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user->id;
                $nestedData['user_name'] = $order->user->name;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['status_id'] = $order->status_id;
                $nestedData['moderator'] = '';
                if ($order->moderator != null) {
                    $nestedData['moderator_id'] = $order->moderator->id;
                    $nestedData['moderator'] = $order->moderator->name;
                }
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['updated_at'] = $order->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['orderDetail'] = '
					<a href="' . route('orderDetail', $order->id) . '">' . '<b>Chi tiết đơn hàng</b>' . '</a>
				';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }

    public function getOrderByID($id)
    {
        return $this->find($id);
    }

    public function orderAssign($request)
    {
        $uObj = new User();
        $order = $this->getOrderByID($request->id);
        $moderator = $uObj->getCurrentUser();
        $order->moderator_id = $moderator->id;
        if($order->status_id == 1){
            $order->status_id = 2;
        }
        $order->save();
    }

    public function orderSuccess($request)
    {
        $order = $this->getOrderByID($request->id);
        if($order->status_id == 4){
            $order->status_id = 5;
        }
        $order->save();
        foreach ($order->orderLine as $orderLine){
            $orderLine->orderline_status_id = 5;
            $orderLine->save();
        }
    }

    public function orderAssignDelete($request)
    {
        $order = $this->getOrderByID($request->id);
        $order->moderator_id = null;
        $order->status_id = 1;
        $order->save();
    }

    public function orderDelete($request)
    {
        $order = $this->getOrderByID($request->id);
        $order->delete_flag = 1;
        $order->save();
    }

    public function orderShip($request){
        $order = $this->getOrderByID($request->id);
        $order->status_id = 4;
        $order->save();
        foreach ($order->orderLine as $orderLine){
            $orderLine->orderline_status_id = 4;
            $orderLine->save();
        }
    }

    public function ordersHistory()
    {
        $user_id = request('id');
        $orders = Order::where('user_id', $user_id)->latest()->paginate(10);
        $number = Order::where('user_id', Auth::user()->id)->count();
        if ($number != 0) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user_id;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['address'] = $order->address;
                $data[] = $nestedData;
            }
            return [
                'orderPaginate' => $orders,
                'allOrders' => $data,
                'number' => $number
            ];
        } else {
            return [
                'orderPaginate' => $orders,
                'allOrders' => null,
                'number' => $number
            ];
        }

    }

    public function searchOrdersHistory()
    {
        $value = request('name');
        $orders = Order::whereHas('status', function ($query) use ($value) {
            $query->where('stt', 'like', "%$value%");
        })
            ->orwhere('created_at','like',"%$value%")
            ->where('user_id', Auth::user()->id)
            ->latest()->paginate(10);
        $number = Order::where('user_id', Auth::user()->id)->count();
        if ($number != 0) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user_id;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['address'] = $order->address;
                $data[] = $nestedData;
            }
            return [
                'orderPaginate' => $orders,
                'allOrders' => $data,
                'number' => $number
            ];
        } else {
            return [
                'orderPaginate' => $orders,
                'allOrders' => null,
                'number' => $number
            ];
        }
    }

    public function getOrdersWarehouseAjax($start, $length, $search, $oderColunm, $oderSortType, $draw, $warehouse_id){
        $columns = array(
            0 => 'id',
            4 => 'created_at'
        );
        // $page = floor($start / $length) + 1;
        $totalData = Order::whereHas('warehouse',function ($query) use ($warehouse_id){
            $query->where('id',$warehouse_id);
        })->count();
        if (empty($search)) {
            $orders = Order::whereHas('warehouse',function ($query) use ($warehouse_id){
                    $query->where('id',$warehouse_id);
                })
                ->where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $orders = Order::whereHas('warehouse',function ($query) use ($warehouse_id){
                     $query->where('id',$warehouse_id);
                })
                ->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->orwhereHas('status', function ($query) use ($search) {
                    $query->where('stt', 'like', "%$search%");
                })
                ->where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $orders->count();
        }

        $data = array();
        if ($orders) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user->id;
                $nestedData['user_name'] = $order->user->name;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['status_id'] = $order->status_id;
                $nestedData['moderator'] = '';
                if ($order->moderator != null) {
                    $nestedData['moderator_id'] = $order->moderator->id;
                    $nestedData['moderator'] = $order->moderator->name;
                }
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['updated_at'] = $order->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['orderDetail'] = '
					<a href="' . route('orderDetail', $order->id) . '">' . '<b>Chi tiết đơn hàng</b>' . '</a>
				';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }
}
