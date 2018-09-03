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
use App\User;
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
//        $order = Order::find(1);
//        $datetime = Carbon::create(2018,2,15);
//        $order->created_at = $datetime;
//        $order->save();
//        $start = 1;
//        $end = 200;
//        $orders = Order::where('delete_flag',0)->where('id','>=',$start)->where('id','<=',$end)->get();
//        foreach ($orders as $order){
//            $day = random_int(1,30);
//            $payment = new Payment();
//            $payment = $order->payment();
//            var_dump($payment);die;
//            $payment->created_at = Carbon::create(2017,11,$day);
//            $payment->updated_at = Carbon::create(2017,11,$day);
//            $payment->save();
//        }
//        $d = Carbon::create(2017,11,11)->modify('+7 days')->format('Y-m-d');
//        var_dump($d);die;
        //$d = Carbon::create(2018,8,28)->modify('+7 days +7 hours')->format('Y-m-d');
        //var_dump(Carbon::now()->modify('+7 hours') < Carbon::create(2018,8,28)->modify('+7 days +7 hours'));die;
        $users = User::where('id','>=',15)->where('id','<=',605)->get();
        $orders = Order::where('id','>=',15)->get();
        foreach ($orders as $order){
            $user_id = random_int(14,605);
            $order->user_id = $user_id;
            $order->save();
        }var_dump('ok');die;
        for ($i = 1; $i <= 1000; $i++) {
            $user = new User();
            $user->name = 'user'.$i;
            $user->email = 'user'.$i.'@gmail.com';
            $user->password = bcrypt('123456');
            $user->avatar = 'user-default.png';
            $user->save();
        }
        var_dump('ok');die;
        $month = date('m');
        $year = date('Y');
        $orders = Order::whereRaw('YEAR(completed_at) = ?', $year)->whereRaw('MONTH(completed_at) = ?', $month)->where('delete_flag', 0)->orderBy('completed_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->completed_at)->format('d');
        });
        if ($orders->count() > 0){
            var_dump('here');die;
        }
        var_dump($orders);die;
        $orders = Order::all();
        foreach ($orders as $order){
            $payment = Payment::find($order->id);
            $payment->status = $order->finance_status;
            $payment->save();
        }
        var_dump('ok1111');die;
        for ($i = 1; $i <= 89; $i++){
            $order = new Order();
            $payment = new Payment();
            $line = new OrderLine();
            $sBe = new StoreBenefit();
            $day = random_int(1,2);
            $month = 9;
            if($i%2 == 0){
                $address = 'Mỹ Đình, Thành phố Hà Nội';
                $city_code = 1;
                $warehouse_id = 1;
                $user_id = 14;
                $pamount = 3500000;
                $product_id = 77;
                $quantity = 1;
            }else if($i%3 == 0){
                $address = 'Hội An, Thành phố Đà Nẵng';
                $city_code = 48;
                $warehouse_id = 2;
                $user_id = 8;
                $pamount = 2500000;
                $product_id = 70;
                $quantity = 1;
            }else{
                $address = 'Chợ Bến Thành, Thành Phố Hồ Chí Minh';
                $city_code = 79;
                $warehouse_id = 3;
                $user_id = 9;
                $pamount = 2500000;
                $product_id = 70;
                $quantity = 1;
            }
            $payment->amount = $pamount;
            $payment->created_at = Carbon::create(2018,$month,$day);
            $payment->updated_at = Carbon::create(2018,$month,$day);
            $payment->save();
            $order->payment_id = $payment->id;
            $order->address = $address;
            $order->city_code = $city_code;
            $order->warehouse_id = $warehouse_id;
            $order->user_id = $user_id;
            $order->created_at = Carbon::create(2018,$month,$day);
            $order->updated_at = Carbon::create(2018,$month,$day);
            $order->save();
            $line->order_id = $order->id;
            $line->city_code = $city_code;
            $line->warehouse_id = $warehouse_id;
            $line->product_id = $product_id;
            $line->quantity = $quantity;
            $line->amount = $pamount;
            $line->created_at = Carbon::create(2018,$month,$day);
            $line->updated_at = Carbon::create(2018,$month,$day);
            $line->save();
        }
        var_dump('ok');die;
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
        $selected = $request->select_sort;
        if(!$selected){
            $selected = 1;
        }
        $cata_id = $request->cata_id;
        $catalog = new Catalog();
        $catalogs = $catalog->getAllCatalog();
        $product = new Product();
        $products = $product->getProductsByType($request->cata_id,$request->cate_id,9,$selected);
        $sale_products = $product->getSaleProducts2(3,['*'],'p5');
        $cate_id = $request->cate_id;
        if($request->cata_id==3){
            return view('clientViews.dichvu', compact('products', 'sale_products', 'catalogs','cate_id','cata_id','selected'));
        }
        return view('clientViews.loai_sanpham', compact('products', 'sale_products', 'catalogs','cate_id','cata_id','selected'));
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
