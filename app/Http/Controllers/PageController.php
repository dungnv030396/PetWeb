<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Category;
use App\Slide;
use App\Product;
use Session;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public  function test(Request $request){
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
        $products = $product->getProductsByType($request->cata_id,$request->cate_id,9);
        //var_dump($products['products']['0']->name);die;
        $sale_products = $product->getSaleProducts(3);
        //var_dump($sale_products);die;
        return view('clientViews.loai_sanpham', compact('products', 'sale_products', 'catalogs'));
    }

    public function getProductDetail(Request $reqest)
    {
        $pro = new Product();
        $product = $pro->getProductDetailById($reqest->id);
        $same_products = $pro->getProductsByCategoryId($product['category']->id,3);
        $new_products = $pro->getNewProducts(7);
        return view('clientViews.chitiet_sanpham', compact('product', 'same_products', 'new_products'));
    }

    public function getLienHe()
    {
        return view('clientViews.lienhe');
    }

    public function getGioiThieu()
    {
        return view('clientViews.gioi_thieu');
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

    public function getCheckout()
    {
        return view('clientViews.dat_hang');
    }

    public function postCheckout(Request $req)
    {
        $cart = Session::get('cart');
        dd($cart);
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phonenumber = $req->phone;
        $customer->notes = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart['items'] as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price'] / value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back() > with('thongbao', 'Đặt hàng thành công');

    }
}
