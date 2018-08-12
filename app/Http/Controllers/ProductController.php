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
            $id = $res['product_id'];
            return view('SupplierView.detail_add_product', compact('id', 'menu'));
//            return redirect(route(''),compact('id'));
        }
    }

    public function loadCategoriesAjax(Request $request)
    {
        $cateObj = new Category();
        $id = $request->id;
        $categories = $cateObj->getCategoriesByCatalogId($id);
        $returnHTML = view('SupplierView.categoriesAjaxView', compact('categories'))->render();
        return response()->json($returnHTML);
    }

    public function viewDetailProduct()
    {
        return view('suppliers.detail_product');
    }

    public function editProductAjax(Request $request)
    {
        $error = '';
        $success_output = '';
        try {
            $product = Product::find($request->id);
            $product->name = trim($request->name, ' ');
            $product->quantity = trim($request->quantity, ' ');
            $product->discount = trim($request->discount, ' ');
            $product->price = trim($request->price, ' ');
            $product->save();
            $success_output = '<div class="alert alert-success">Dữ liệu đã được cập nhật</div>';
        } catch (\Exception $e) {
            $error = '<div class="alert alert-danger">Có lỗi xảy ra</div>';
        }
        $output = array(
            'error' => $error,
            'success' => $success_output
        );

        echo json_encode($output);
    }

    public function removeProductAjax(Request $request)
    {
        $error = '';
        $success_output = '';
        try {
            $product = Product::find($request->id);
            $product->delete_flag = 1;
            $product->save();
            $success_output = 'success';
        } catch (\Exception $e) {
            $error = 'error';
        }
        $output = array(
            'error' => $error,
            'success' => $success_output
        );
        echo json_encode($output);
    }
}
