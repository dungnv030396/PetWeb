<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Category;
use App\Order;
use App\Slide;
use App\Product;
use App\Status;
use App\User;
use Session;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public  function test(Request $request){
        //return redirect(route('logout'));
        //auth()->logout();
        var_dump(Session::all());
        die;
        if(1==1 && 2==3 ){
            var_dump('ok');die;
        }
        var_dump('not ok');die;
        auth()->logout();
        die;
        $user = Auth::attempt(['email'=>'acquy_tokyo_95@yahoo.com.vn','password'=>'123456','roleId'=>2,'delete_flag'=>0]);
        var_dump($user);die;
        $user = new User();
        $oObj = new Order();
        $search = '18:24:24';
        $orders = Order::whereHas('user',function ($query) {
            $query->where('address', '=', 'HASASHA');
        })->where('delete_flag',0)->first();
        $orders = Order::find(5);
        $orders = Order::where('delete_flag',0)
            ->get();

        $orders = Order::with(['user' => function ($query) use ($search){
            $query->where('name','like',"%$search%");
        }])
            ->where('delete_flag',0)
            ->orWhere('created_at','like',"%$search%")
            ->get();
        foreach ($orders as $order){
            var_dump($order->status_id);die;
        }
        die;
        $user = User::where('id',6)->first();
        $user->address = "HASASHA";
        $user->save();
        die;

        return redirect(route('trangchu'));

        $c = new User();
        $c = $c->getCurrentUser();
        var_dump($c->role->role);die;
        $pro = new Product();
        $cart = Session::get('cart');
        foreach ($cart->items as $cartLine) {
            var_dump($cartLine['item']->user->name);
            //$data = array('supplierName' => $listSupplier->name,'email' => $listSupplier->email);
            // truyền list_supplier &  vào $data để truyền về mail
        }
        die;
        $coment = new Comment();
        $coment->getCommentsByProductId(2,4);
        $catalog = new Catalog();
        $catalogs = $catalog->getCatalog([1,2]);
        $product = new Product();
        var_dump($request->id);die;
        $cate_id = $product->getProductById(1)->category->id;
        $pro = new Product();
        $product = $pro->getProductDetailById($reqest->id);



        var_dump(Category::find($cate_id)->catalog->toArray());die;
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
