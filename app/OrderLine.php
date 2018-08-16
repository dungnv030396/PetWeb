<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
    public function order()
    {
        return $this->hasOne(Order::class,'id','order_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function warehouse(){
        return $this->hasOne(Warehouse::class,'id','warehouse_id');

    }

    public function detailOrder()
    {
        $order_id = request('id');
        $detailOrder = OrderLine::where('order_id', $order_id)->latest()->paginate(5);
        foreach ($detailOrder as $item) {
            $nestedData = array();
            $nestedData['status_name'] = Status::find($item->orderline_status_id)->stt;
            $nestedData['product_name'] = $item->product['name'];
            $nestedData['discount'] = $item->product['discount'];
            $nestedData['image_link'] = $item->product['image_link'];
            $nestedData['price'] = $item->product['price'];
            $nestedData['quantity'] = $item->quantity;
            $nestedData['amount'] = $item->amount;
            $nestedData['total'] = +(int)$item->amount;
            $dataProduct[] = $nestedData;
        }
        $order = Order::find($order_id);
        $user = array();
        $user['customer_name'] = $order->user['name'];
        $user['address'] = $order->address;
        $user['email'] = $order->user['email'];
        $user['gender'] = $order->user['gender'];
        $user['phonenumber'] = $order->user['phoneNumber'];
        $user['name'] = $order->created_at;
        $user['description'] = $order->payment['user_message'];
        $user['created_at'] = $order->created_at;
        $user['total'] = $order->payment['amount'];
        $dataUser[] = $user;
        return [
            'detailOrderPaginate' =>$detailOrder,
            'detailOrder' => $dataProduct,
            'user_info' => $dataUser
        ];
    }

    public function status(){
        return $this->hasOne(OrderlineStatus::class,'id','orderline_status_id');
    }

    public function productToWarehouseAjax($start, $length, $search, $oderColunm, $oderSortType, $draw,$warehouse_id)
    {
        $columns = array(
            0 => 'id',
            6 => 'created_at'
        );
        $totalData = OrderLine::whereHas('status', function ($query) {
            $query->whereIn('id', [1, 2, 3, 4]);
        })->whereHas('warehouse',function ($query) use ($warehouse_id){
            $query->where('id',$warehouse_id);
        })->whereHas('order', function ($query) {
            $query->where('delete_flag', 0);
        })->count();
        if (empty($search)) {
            $orderLines = OrderLine::whereHas('warehouse', function ($query) use ($warehouse_id){
                    $query->where('id', $warehouse_id);
                })
                ->whereHas('status', function ($query) {
                    $query->whereIn('id', [1, 2, 3, 4]);
                })
                ->whereHas('order', function ($query) {
                    $query->where('delete_flag', 0);
                })
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $orderLines = OrderLine::whereHas('warehouse', function ($query) use ($warehouse_id){
                    $query->where('id', $warehouse_id);
                })
                ->whereHas('status', function ($query) {
                    $query->whereIn('id', [1, 2, 3, 4]);
                })
                ->whereHas('order', function ($query) use ($search) {
                    $query->where('delete_flag', 0);
                    $query->where('id', 'like', "%$search%");
                })
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $orderLines->count();
        }
        $data = array();
        if ($orderLines) {
            foreach ($orderLines as $orderLine) {
                $nestedData = array();
                $nestedData['order_code'] = $orderLine->order->id . '-' . $orderLine->id;
                $nestedData['orderLine_id'] = $orderLine->id;
                $nestedData['product_id'] = $orderLine->product->id;
                $nestedData['product_name'] = $orderLine->product->name;
                $nestedData['catalog'] = $orderLine->product->category->catalog->name;
                $nestedData['category'] = $orderLine->product->category->name;
                $nestedData['price'] = number_format($orderLine->product->price);
                $nestedData['salePrice'] = number_format($orderLine->product->price - (($orderLine->product->price * $orderLine->product->discount) / 100));
                $nestedData['quantity'] = $orderLine->quantity;
                $nestedData['amount'] = number_format($orderLine->amount);
                $nestedData['discount'] = $orderLine->product->discount;
                $nestedData['created_at'] = $orderLine->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['updated_at'] = $orderLine->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['status'] = $orderLine->status->stt;
                $nestedData['status_id'] = $orderLine->status->id;
                $nestedData['supplier_name'] = $orderLine->product->user->name;
                $nestedData['supplier_phoneNumber'] = $orderLine->product->user->phoneNumber;
                $nestedData['supplier_address'] = $orderLine->product->user->address;
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