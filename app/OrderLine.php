<?php

namespace App;

use App\OrderlinepaymentStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');

    }

    public function status()
    {
        return $this->hasOne(OrderlineStatus::class, 'id', 'orderline_status_id');
    }

    public function payment_status()
    {
        return $this->hasOne(OrderlinepaymentStatus::class, 'id', 'finance_status');
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
            'detailOrderPaginate' => $detailOrder,
            'detailOrder' => $dataProduct,
            'user_info' => $dataUser
        ];
    }

    public function productToWarehouseAjax($start, $length, $search, $oderColunm, $oderSortType, $draw, $warehouse_id)
    {
        $columns = array(
            0 => 'id',
            6 => 'created_at'
        );
        $totalData = OrderLine::whereHas('status', function ($query) {
            $query->whereIn('id', [1, 2, 3, 4]);
        })->whereHas('warehouse', function ($query) use ($warehouse_id) {
            $query->where('id', $warehouse_id);
        })->whereHas('order', function ($query) {
            $query->where('delete_flag', 0);
        })->count();
        if (empty($search)) {
            $orderLines = OrderLine::whereHas('warehouse', function ($query) use ($warehouse_id) {
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
            $orderLines = OrderLine::whereHas('warehouse', function ($query) use ($warehouse_id) {
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

    public function getSupplier_financeAjax($start, $length, $search, $oderColunm, $oderSortType, $draw, $startDate, $endDate, $status_id)
    {
        $columns = array(
            0 => 'id',
            6 => 'payment_date'
        );
        $startDate = substr($startDate, -4) . '-' . substr($startDate, 0, 1) . substr($startDate, 1, -5);
        $endDate = substr($endDate, -4) . '-' . substr($endDate, 0, 1) . substr($endDate, 1, -5);
        if ($status_id == 0) {
            $status_id = array();
            $statues = OrderlinepaymentStatus::all('id');
            foreach($statues as $sta){
                $status_id[] = $sta->id;
            }
        }else{
            $status_id = [$status_id];
        }
        $totalData = OrderLine::whereIn('finance_status', $status_id)
            ->whereHas('order', function ($query) {
                $query->where('delete_flag', 0);
            })->whereBetween('payment_date', [$startDate, $endDate])->count();
        if (empty($search)) {
            $orderLines = OrderLine::whereIn('finance_status', $status_id)
                ->whereHas('order', function ($query) {
                    $query->where('delete_flag', 0);
                })
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $orderLines = OrderLine::whereIn('finance_status', $status_id)
                ->whereHas('order', function ($query) use ($search) {
                    $query->where('delete_flag', 0);
                    $query->where('id', 'like', "%$search%");
                })
                ->whereBetween('payment_date', [$startDate, $endDate])
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
                $nestedData['supplier_name'] = $orderLine->product->user->name;
                $nestedData['supplier_phoneNumber'] = $orderLine->product->user->phoneNumber;
                $nestedData['supplier_address'] = $orderLine->product->user->address;
                $nestedData['supplier_bank_name'] = $orderLine->product->user->bank_name;
                $nestedData['supplier_bank_branch'] = $orderLine->product->user->bank_branch;
                $nestedData['supplier_bank_username'] = $orderLine->product->user->bank_username;
                $nestedData['supplier_card_number'] = $orderLine->product->user->card_number;
                $nestedData['payment_status_name'] = $orderLine->payment_status->name;
                $nestedData['payment_status'] = $orderLine->finance_status;
                if ($orderLine->payment_date) {
                    $nestedData['payment_date'] = Carbon::parse($orderLine->payment_date)->format('d/m/Y');

                } else {
                    $nestedData['payment_date'] = '';
                }
                $nestedData['amount'] = number_format($orderLine->amount - ($orderLine->amount * 0.1));
                $nestedData['product_id'] = $orderLine->product->id;
                $nestedData['product_name'] = $orderLine->product->name;
                $nestedData['salePrice'] = number_format($orderLine->product->price - (($orderLine->product->price * $orderLine->product->discount) / 100));
                $nestedData['quantity'] = $orderLine->quantity;
                $nestedData['amountLine'] = number_format($orderLine->amount);
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

    //at supplier management view
    public function getSupplier_financeDataAjax($start, $length, $search, $oderColunm, $oderSortType, $draw, $startDate, $endDate, $status_id)
    {
        $columns = array(
            0 => 'id',
            5 => 'payment_date'
        );
        $startDate = substr($startDate, -4) . '-' . substr($startDate, 0, 1) . substr($startDate, 1, -5);
        $endDate = substr($endDate, -4) . '-' . substr($endDate, 0, 1) . substr($endDate, 1, -5);
        if ($status_id == 0) {
            $status_id = array();
            $statues = OrderlinepaymentStatus::all('id');
            foreach($statues as $sta){
                $status_id[] = $sta->id;
            }
        }else{
            $status_id = [$status_id];
        }
        $totalAmount = 0;
        $totalReceive = 0;
        $totalData = OrderLine::whereIn('finance_status', $status_id)
            ->whereHas('order', function ($query) {
                $query->where('delete_flag', 0);
            })->whereBetween('payment_date', [$startDate, $endDate])->count();
        if (empty($search)) {
            $orderLines = OrderLine::whereIn('finance_status', $status_id)
                ->whereHas('order', function ($query) {
                    $query->where('delete_flag', 0);
                })
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $orderLines = OrderLine::whereIn('finance_status', $status_id)
                ->whereHas('order', function ($query) use ($search) {
                    $query->where('delete_flag', 0);
                    $query->where('id', 'like', "%$search%");
                })
                ->whereBetween('payment_date', [$startDate, $endDate])
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
                $nestedData['bank'] = '';
                if($orderLine->product->user->card_number){
                    $nestedData['bank'] = $orderLine->product->user->bank_name.', chi nhánh '.$orderLine->product->user->bank_branch;
                }
                $nestedData['card_number'] = $orderLine->product->user->card_number;
                $nestedData['payment_status_name'] = $orderLine->payment_status->name;
                $nestedData['payment_status'] = $orderLine->finance_status;
                if ($orderLine->payment_date) {
                    $nestedData['payment_date'] = Carbon::parse($orderLine->payment_date)->format('d/m/Y');

                } else {
                    $nestedData['payment_date'] = '';
                }
                $nestedData['amount'] = number_format($orderLine->amount - ($orderLine->amount * 0.1));
                $nestedData['product_id'] = $orderLine->product->id;
                $nestedData['product_name'] = $orderLine->product->name;
                $nestedData['discount'] = $orderLine->product->discount;
                $nestedData['price'] = number_format($orderLine->product->price);
                $nestedData['salePrice'] = number_format($orderLine->product->price - (($orderLine->product->price * $orderLine->product->discount) / 100));
                $nestedData['quantity'] = $orderLine->quantity;
                $nestedData['amountLine'] = number_format($orderLine->amount);
                $totalAmount += $orderLine->amount;
                $totalReceive += $orderLine->amount - ($orderLine->amount * 0.1);
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
            "data" => $data,
            "totalAmount" => number_format($totalAmount),
            "totalReceive" => number_format($totalReceive),
        );
        return $json_data;
    }
}