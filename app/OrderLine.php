<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function detailOrder()
    {
        $order_id = request('id');
        $detailOrder = OrderLine::where('order_id', $order_id)->latest()->paginate(5);
        $number = count($detailOrder);
        foreach ($detailOrder as $item) {
            $nestedData = array();
//            $nestedData['status_id'] = $item->orders['status_id'];
//            $nestedData['status_name'] = Status::find($item->orders['status_id']);
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
            'detailOrder' => $dataProduct,
            'user_info' => $dataUser
        ];
    }
}