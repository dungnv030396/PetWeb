<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderLine;
use App\Catalog;
use App\Payment;
use App\Slide;
use App\Product;
use App\StoreBenefit;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public  function test(Request $request){

        $orderObj = Order::where([['id','=',49],['status_id','!=',5]])->first();
        var_dump($orderObj);die;
        $totalData = Order::where('status_id', 5)->where('delete_flag', 0)->get();
        foreach ($totalData as $order){
            if($order->payment->id != 18){
                $store = new StoreBenefit();
                $store->payment_id = $order->payment->id;
                $store->amount = ($order->payment->amount) * 0.1;
                $store->save();
            }
        }
        var_dump('ok');die;


        var_dump($orders);die;
        $totalData = OrderLine::whereHas('order', function ($query) {
            $query->where('delete_flag', 0);
        })->whereBetween('payment_date',['2018-08-21','2019-08-23'])->count();
        var_dump($totalData);die;
        $orderLines = OrderLine::whereHas('order', function ($query) {
            $query->where('delete_flag', 0);
        })
            ->whereBetween('payment_date',['2018-8-21','2018-8-23'])
            ->get();

        $str = '08-06-2018';
        $str = substr($str,-4).'-'.substr($str,0,1).substr($str,1,-5);
        var_dump($str);die;
        $endDate = new \DateTime('now');
        var_dump((new \DateTime('now'))->modify('+7 hours')->format('m-d-Y'));die;
        $orders = OrderLine::all();
        foreach ($orders as $order){
            $order->payment_date = Carbon::parse($order->created_at->modify('+7 days +7 hours')->format('Y-m-d H:i:s'));
            $order->save();
        }
        var_dump('ok');die;
        $order = OrderLine::orderBy('payment_date','desc')->first()->payment_date;
        var_dump($order);die;
        $orderLines = OrderLine::find(23);
        //var_dump($orderLines->sent_at);
        //var_dump($orderLines->created_at);
        //var_dump(Carbon::parse($orderLines->sent_at));
        //$order->updated_at->modify('+7 days')->format('d/m/Y');
        $time = Carbon::parse($orderLines->created_at->modify('+7 days')->format('Y-m-d H:i:s'));
        $orderLines->payment_date = $time;
        $orderLines->save();
        die;
        var_dump($orderLines->id);var_dump($orderLines->sent_at);var_dump($orderLines->created_at);die;
    }
    public function getIndex()
    {
        $product = new Product();
        $slide = Slide::all();
        $pet_products = $product->getProductsByCatalogID(1,8);
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
