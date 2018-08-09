<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function status(){
        return $this->hasOne(Status::class,'id','status_id');
    }
    public function orderLine(){
        return $this->hasMany(OrderLine::class);
    }

    public function getOrdersAjax($start,$length,$search,$oderColunm,$oderSortType,$draw)
    {
        $columns = array(
            0 => 'id',
            2 => 'moderator_id',
            3 => 'status_id',
            4 => 'created_at'
        );
       // $page = floor($start / $length) + 1;
        $totalData = Order::count();
        if(empty($search)){
            $orders = Order::where('delete_flag',0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm],$oderSortType)
                ->get();
            $totalFiltered = $totalData;
        }else{
            $orders = Order::whereHas('user',function ($query) use ($search){
                    $query->where('name','like',"%$search%");
                })
                ->where('delete_flag','=',0)
                ->orWhere('created_at','like',"%$search%")
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm],$oderSortType)
                ->get();
            $totalFiltered = $orders->count();
        }

        $data = array();
        if($orders){
            foreach($orders as $order){
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user->id;
                $nestedData['user_name'] = $order->user->name;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['status_id'] = $order->status_id;
                $nestedData['moderator'] = '';
                if($order->moderator != null){
                    $nestedData['moderator_id'] = $order->moderator->id;
                    $nestedData['moderator'] = $order->moderator->name;
                }
                $nestedData['created_at'] = date('d-m-Y H:i:s',strtotime($order->created_at));
                $nestedData['updated_at'] = $order->updated_at;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data
        );
        return $json_data;
    }
    public function ordersHistory(){
        $id = request('id');
        $orders = Order::where('user_id',$id)->latest()->paginate(10);
        if ($orders){
            foreach ($orders as $order){
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user_id;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['created_at'] = date('d-m-Y H:i:s',strtotime($order->created_at));
                $nestedData['address'] = $order->address;
                $data[] = $nestedData;
            }
        }
        $number = count($orders);
        return [
            'orderPaginate' => $orders,
            'allOrders' => $data,
            'number' => $number
        ];
    }
    public function detailOrder(){
        return view('clientViews.customer.detail_order');
    }
}
