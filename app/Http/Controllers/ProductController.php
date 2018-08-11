<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Catalog;
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

    public function loadCategoriesAjax(Request $request){
        $cateObj = new Category();
        $id = $request->id;
        $categories = $cateObj->getCategoriesByCatalogId($id);
        $returnHTML = view('SupplierView.categoriesAjaxView',compact('categories'))->render();
        return response()->json($returnHTML);
    }
    public function viewDetailProduct(){

        $menu = 'order';
        return view('SupplierView.detail_product',compact('menu'));
    }
}
