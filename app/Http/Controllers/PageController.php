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
        $ordersLastMonth = Order::whereRaw('YEAR(created_at) = ?', 2018)->whereRaw('MONTH(created_at) = ?', 8)->count();
        var_dump($ordersLastMonth);die;
        $month = date('m');
        $orders = Order::whereRaw('MONTH(created_at) = ?',$month)->orderBy('created_at','asc')->get()->groupBy(function ($date){
            return Carbon::parse($date->created_at)->format('d');
        });
        if($orders){
            $data = array();
            for($i = 1; $i <= date('t'); $i++){
                foreach ($orders as $order) {
                    $year = Carbon::parse($order[0]->created_at)->format('Y');
                    $day = Carbon::parse($order[0]->created_at)->format('d');
                    if($i == $day){
                        $number = $order->count();
                    }else{
                        $number = 0;
                        $day = $i;
                    }
                    $data[$i] = [
                        'year'=>$year,
                        'month'=>$month,
                        'day'=>$day,
                        'number'=>$number
                    ];
                    break;
                }
            }

        }
        var_dump($data);
        die;
        $totalIncome = StoreBenefit::all()->sum('amount');
        var_dump($totalIncome);die;
        $date = new \DateTime('now');

        var_dump(Carbon::parse($mytime)->modify('+7 hours')->format('m-d-Y'));die;
        $str = Carbon::parse($date['date'])->modify('+7 hours')->format('m-d-Y');
        var_dump($str);die;
        $oldcart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $product_id = 12;
        $quantity = 3-1;
        $product = new Product();
        $pro = $product->getProductById($product_id);
        $cart->add($pro, $quantity);
        $request->session()->put('cart', $cart);
        $amount = number_format($cart->totalPrice);
        var_dump($amount);
        die;

    }
    public function getIndex()
    {
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
