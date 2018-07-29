<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
use Alert;
use App\Payment;

class PaymentController extends Controller
{
    public function checkout(Request $request){

        $payment = new Payment();
        $payment->checkout($request,$this);
        alert()->success("Bạn đã đặt hàng thành công! Chúng tôi sẽ liên hệ và giao hàng cho bạn trong khoảng thời gian sớm nhât!");
        return redirect()->back()-> with('message', 'Đặt hàng thành công');
    }
}
