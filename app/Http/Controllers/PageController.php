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
