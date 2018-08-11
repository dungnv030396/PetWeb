<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
use Alert;
use App\User;

class CartsController extends Controller
{
    public function addToCart(Request $request)
    {
        $oldcart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $product = new Product();
        $quantity = $product->getProductById($request->id)->quantity;
        $message = '';
        $oldquantity = 0;
        if (!empty($cart->items[$request->id]['quantity'])){
            $oldquantity = $cart->items[$request->id]['quantity'];
        }
        if($quantity >= ($request->quantity + $oldquantity)){
            $pro = $product->getProductById($request->id);
            $cart->add($pro, $request->quantity);
            $request->session()->put('cart', $cart);
            $message = "Thêm sản phẩm thành công";
            alert()->success($message);
        }else{
            $message = "Sản phẩm vượt quá số lượng trong kho";
            alert()->error($message);
        }
        //var_dump($cart->items);die;
        return redirect()->back()->with('message',$message);
    }

    public function removeCart(Request $request)
    {
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->removeItem($request->id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getCheckout()
    {
        $user = new User();
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        if($user->isLogin()){
            $currentUser = $user->getCurrentUser();
            $city = strrev(str_before(strrev($currentUser->address),','));
            return view('clientViews.dat_hang', compact('currentUser','cart','city'));
        }
        alert()->error("Xin quý khách đăng nhập trước khi thanh toán!!");
        return redirect()->back()->with('message','checkout');
    }
}
