<?php

namespace App\Http\Controllers;

use App\OrderlinepaymentStatus;
use App\Order;
use App\OrderLine;
use App\Catalog;
use App\Payment;
use App\Slide;
use App\Product;
use App\StoreBenefit;
use Carbon\Carbon;
use PhpParser\Node\Expr\Array_;
use Session;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use function Sodium\add;
use App\Cart;

class PageController extends Controller
{

    public  function test(Request $request){
        $start = 0;
        $end = 150;
        $orders = Order::offset($start)
            ->limit($end)->get();
        $payments = Payment::offset($start)
            ->limit($end)->get();
        $lines = OrderLine::offset($start)
                ->limit($end)->get();
        foreach ($orders as $order){
            $day = rand(1,30);
            $datetime = Carbon::create(2017,11,$day);
            $d = $datetime->modify('+1 days');
            $order->status_id = 5;
            $order->completed_at = $d;
            $order->created_at = $datetime;
            var_dump($datetime->modify('+1 days'));var_dump($datetime);die;
            $order->save();
        }
        die;
        foreach ($payments as $payment){
            $payment->created_at = $datetime;
            $payment->save();
        }
        foreach ($lines as $line){
            $line->sent_at = $datetime;
            $line->payment_date = $datetime->modify('+7 days')->format('Y-m-d');
            $line->created_at = $datetime;
            $line->save();
        }
        var_dump('good1');die;


//        for ($i = 1; $i <= 1000; $i++){
//            $order = new Order();
//            $payment = new Payment();
//            $line = new OrderLine();
//            if($i%2 == 0){
//                $address = 'Mỹ Đình, Thành phố Hà Nội';
//                $city_code = 1;
//                $warehouse_id = 1;
//                $user_id = 14;
//                $pamount = 3500000;
//                $product_id = 77;
//                $quantity = 1;
//            }else if($i%3 == 0){
//                $address = 'Hội An, Thành phố Đà Nẵng';
//                $city_code = 48;
//                $warehouse_id = 2;
//                $user_id = 8;
//                $pamount = 2500000;
//                $product_id = 70;
//                $quantity = 1;
//            }else{
//                $address = 'Chợ Bến Thành, Thành Phố Hồ Chí Minh';
//                $city_code = 79;
//                $warehouse_id = 3;
//                $user_id = 9;
//                $pamount = 2500000;
//                $product_id = 70;
//                $quantity = 1;
//            }
//            $payment->amount = $pamount;
//            $payment->save();
//            $order->payment_id = $payment->id;
//            $order->address = $address;
//            $order->city_code = $city_code;
//            $order->warehouse_id = $warehouse_id;
//            $order->user_id = $user_id;
//            $order->save();
//            $line->order_id = $order->id;
//            $line->city_code = $city_code;
//            $line->warehouse_id = $warehouse_id;
//            $line->product_id = $product_id;
//            $line->quantity = $quantity;
//            $line->amount = $pamount;
//            $line->save();
//        }
    }
    public function getIndex()
    {
        if (Auth::check()){
            if (Auth::user()->roleId == 1 OR Auth::user()->roleId==4){
                Auth::logout();
            }
        }
        $product = new Product();
        $slide = Slide::all();
        $pet_products = $product->getProductsAll(8);
        $sale_products = $product->getSaleProducts(8);
        return view('clientViews.trangchu', compact('slide', 'pet_products', 'sale_products'));
    }

    public function getProductsByType(Request $request)
    {
        $catalog = new Catalog();
        $catalogs = $catalog->getAllCatalog();
        $product = new Product();
        $products = $product->getProductsByType($request->cata_id,$request->cate_id,9);;
        //var_dump($products->toArray());die;
        $sale_products = $product->getSaleProducts2(3,['*'],'p5');
        //var_dump($sale_products);die;
        $cate_id = $request->cate_id;
        if($request->cata_id==3){
            return view('clientViews.dichvu', compact('products', 'sale_products', 'catalogs','cate_id'));
        }
        return view('clientViews.loai_sanpham', compact('products', 'sale_products', 'catalogs','cate_id'));
    }

    public function getProductDetail(Request $reqest)
    {
        $pro = new Product();
        $product = $pro->getProductDetailById($reqest->id);
        $same_products = $pro->getProductsByCategoryId($product['category']->id,3);
        $new_products = $pro->getNewProducts(7);
        $comments = new Comment();
        $comments = $comments->getCommentsByProductId($reqest->id,5);
        if($product['category']->catalog->id==3){
            return view('clientViews.chitiet_dichvu', compact('product', 'same_products', 'new_products','comments'));
        }
        return view('clientViews.chitiet_sanpham', compact('product', 'same_products', 'new_products','comments'));
    }

    public function getLienHe()
    {
        return view('clientViews.supports.lienhe');
    }

    public function getGioiThieu()
    {
        return view('clientViews.supports.gioi_thieu');
    }

    public function getAddtocart(Request $req, $id)
    {
        $product = Product::find($id);
        $oldcart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->add($product, $id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getDelItemCart($id)
    {
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }

}
