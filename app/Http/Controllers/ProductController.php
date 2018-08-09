<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use function Sodium\compare;

class ProductController extends Controller
{
    public function postProduct(Request $request)
    {
        $product = new Product();
        $res = $product->postProduct($this, $request);
        if ($res['error']) {
            return back()->with($res['code'], $res['message']);
        } else {
//            return back()->with('postProductSuccess', 'Chúc mừng bạn đã đăng bán sản phẩm Thành Công');
            $menu = 'detailproduct';
            $id =$res['product_id'];
            return view('SupplierView.detail_add_product',compact('id','menu'));
//            return redirect(route(''),compact('id'));
        }
    }
}
