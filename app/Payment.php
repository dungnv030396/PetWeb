<?php

namespace App;

use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Payment extends Model
{
    //checkout
    public function checkout($request, $th)
    {
        $pro = new Product();
        $cUser = new User();
        $cUser = $cUser->getCurrentUser();
        $th->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits_between:10,11|numeric',
            'address' => 'required'
        ],
            [
                'phone.digits_between' => 'Số điện thoại phải có 10-11 chữ số!',
                'phone.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!',
                'name.required' => 'Vui lòng nhập tên tài khoản!',
                'gender.required' => 'Vui lòng chọn giới tính!',
                'address.required' => 'Vui lòng điền địa chỉ'
            ]);
        $amount = 0;
        $cart = Session::get('cart');
        foreach ($cart->items as $cartLine) {
            $product = $pro->getProductById($cartLine['item']->id);
            $para = 'quantity' . $cartLine['item']->id;
            $th->validate($request, [
                $para => 'required|numeric|max:' . $product->quantity
            ], [
                $para . '.required' => 'Vui lòng nhập số lượng',
                $para . '.numeric' => 'Vui kiểm tra lại số lượng',
                $para . '.max' => 'Vui kiểm tra lại số lượng'
            ]);
            if ($cartLine['item']->discount != 0) {
                $amount += ($request->$para * ($cartLine['item']->price - (($cartLine['item']->price * $cartLine['item']->discount) / 100)));
            } else {
                $amount += ($request->$para * $cartLine['item']->price);
            }
        }

        try {
            $payment = new Payment();
            $payment->amount = $amount;
            if (!empty($request->payment_cardnumber)) {
                $payment->payment = 'Visa';
                $arrInfo = ['username' => $request->payment_name, 'card_number' => $request->payment_cardnumber, 'Expiration_month' => $request->month, 'Expiration_year' => $request->year];
                $payment->payment_info = serialize($arrInfo);
                $payment->security = $request->cvv;
            }
            $payment->user_message = $request->notes;
            $payment->save();
            $order = new Order();
            $order->user_id = $cUser->id;
            $order->payment_id = $payment->id;
            if(!empty(trim($request->order_address,' '))){
                $order->address = trim($request->order_address,' ');
                $cUser->address = trim($request->address,' ');
            }else{
                $order->address = trim($request->address,' ');
            }
            $order->save();

            foreach ($cart->items as $cartLine) {
                $cLine = new OrderLine();
                $cLine->order_id = $order->id;
                $cLine->product_id = $cartLine['item']->id;
                $cLine->quantity = $request->$para;
                if ($cartLine['item']->discount != 0) {
                    $amountOfLine = ($request->$para * ($cartLine['item']->price - (($cartLine['item']->price * $cartLine['item']->discount) / 100)));
                } else {
                    $amountOfLine = ($request->$para * $cartLine['item']->price);
                }
                $cLine->amount = $amountOfLine;
                $cLine->save();
                $product = $pro->getProductById($cartLine['item']->id);
                $product->quantity -= $cLine->quantity;
                $product->save();
            }
            $cUser->name = trim($request->name,' ');
            $cUser->gender = $request->gender;
            $cUser->save();
            Session::forget('cart');
        } catch (\Exception $e) {
            throw $e;
        }
    }

//    public function sendMailSuplier()
//    {
//        $pro = new Product();
//        $cart = Session::get('cart');
//        $arr =[];
//        foreach ($cart->items as $cartLine) {
//            $product = $pro->getProductById($cartLine['item']->id);
//            //$supplier = User::find($cartLine['item']->user->id);
//            $data = array('supplierName' => $cartLine['item']->user->name,
//                'supplierEmail' => $cartLine['item']->user->email,
//                'productName' => $product->name,
//                'quanlity' => $casrtLine['quanlity']
//            );
//             array_push($arr,[$cartLine['item']->user->id,$data]);
//        }
//        Mail::send('clientViews.emails.notifiToSupplier', $data, function ($message) {
//            $message->to(\request('email'))
//                ->subject('The Pet Family - Thông Báo Sản Phẩm');
//            $message->from('thepetfamilyteam@gmail.com');
//        });
//        die;
//
//    }
}