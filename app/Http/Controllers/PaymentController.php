<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderLine;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Session;
use Alert;
use App\Payment;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {

        $payment = new Payment();
        $order = $payment->checkout($request, $this)->id; //order_id vừa add
        $payment->sendMailSuplier($order);
        return redirect(route('checkoutSucess', compact('order')));
    }

    public function checkoutSucess(Request $request)
    {
        $order = Order::find($request->order);
        $user = Auth::user();
        alert()->success("Bạn đã đặt hàng thành công! Chúng tôi sẽ liên hệ và giao hàng cho bạn trong khoảng thời gian sớm nhât!");
        return view('clientViews.checkout_sucess')->with('user', $user)->with('order', $order)->with('message', 'Đặt hàng thành công');
    }

    public function ordersHistory()
    {
        $order = new Order();
        $listOrders = $order->ordersHistory();
        return view('clientViews.customer.orders_history', compact('listOrders'));
    }

    public function detailOrder()
    {
        $orderLine = new OrderLine();
        $orderDetail = $orderLine->detailOrder();
        return view('clientViews.customer.detail_order', compact('orderDetail'));

    }

    public function searchOrdersHistory()
    {
        $order = new Order();
        $listOrders = $order->searchOrdersHistory();
        return view('clientViews.customer.orders_history', compact('listOrders'));
    }
}
