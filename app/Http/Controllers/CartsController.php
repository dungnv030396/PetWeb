<?php

namespace App\Http\Controllers;

use App\City;
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
        if (!empty($cart->items[$request->id]['quantity'])) {
            $oldquantity = $cart->items[$request->id]['quantity'];
        }
        if ($quantity >= ($request->quantity + $oldquantity)) {
            $pro = $product->getProductById($request->id);
            $cart->add($pro, $request->quantity);
            $request->session()->put('cart', $cart);
            $message = "Thêm sản phẩm thành công";
            alert()->success($message);
        } else {
            $message = "Sản phẩm vượt quá số lượng trong kho";
            alert()->error($message);
        }
        //var_dump($cart->items);die;
        return redirect()->back()->with('message', $message);
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
        if ($user->isLogin()) {
            $currentUser = $user->getCurrentUser();
            $cities = City::all();
            return view('clientViews.dat_hang', compact('currentUser', 'cart', 'cities'));
        }
        alert()->error("Xin quý khách đăng nhập trước khi thanh toán!!");
        return redirect()->back()->with('message', 'checkout');
    }

    public function loadAmountAjax(Request $request)
    {
        $oldcart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $product = new Product();
        $pro = $product->getProductById($product_id);
        $cart->add2($pro, $quantity);
        $request->session()->put('cart', $cart);
        $oldcart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $returnHTML = view('clientViews.checkout_amountAjaxView',compact('cart'))->render();
        return response()->json($returnHTML);
    }
}
