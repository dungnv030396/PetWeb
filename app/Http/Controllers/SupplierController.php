<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Category;
use App\Order;
use App\OrderLine;
use App\Product;
use App\Report;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    public  function listSupplier(){
        $user = new User();
        $listSupplier = $user->listSupplier();
        return view('clientViews.customer.list_supplier',compact('listSupplier'));
    }

    public function searchByName(){
        $user = new User();
        $listSupplier = $user->searchByName();
        return view('clientViews.customer.list_supplier',compact('listSupplier'));
    }
    public function detailSupplier(){
        $id = \request('id');
        $user = User::all()->find($id);
        $reportTime = Report::where('reportTo_id',$id)->where('status',2)->get()->count();
        if($reportTime==null){
            $reportTime=0;
        }
        $listProducts = Product::where('user_id',$id)->get();
        $number = 0;
        foreach ($listProducts as $listProduct){
            $soldTime = OrderLine::where('product_id',$listProduct->id)->where('orderline_status_id',5)->count();
            if ($soldTime!=null){
                $number+=$soldTime;
            }
        }
//        dd($soldTime);
        $pro = new Product();
        $products = $pro->getProductsBySupplierId($id,12);
        return view('clientViews.customer.detail_supplier',compact('user','products','reportTime','number'));
    }

    public function home(){
        $menu = 'home';
        $userObj = new User();
        $user = $userObj->getCurrentUser();
        if($userObj->isSupplier($user)){
            return view('SupplierView.home',compact('user','menu'));
        }
        alert()->error('Quý khách k có quyền truy cập!');
        return redirect()->back()->with('message','failed');
    }

    public function load(){
        return view('SupplierView.ordersHistory');
    }
    public function demo()
    {
        $id = Auth::user()->id;
//        $products = DB::table('products')->select('id', 'created_at')->where('user_id',$id)->get();
        $products = Order::where('user_id',$id);
        return datatables($products)->make(true);
    }

    public function loginToManagement(Request $request){
        $currentUser = new User();
        $currentUser = $currentUser->getCurrentUser();
        if ($request->emailid == $currentUser->email && Hash::check($request->password,$currentUser->password)) {
            return redirect(route('productManagement'));
        }else{
            return Redirect::back()->with(
                'error_loginToManager', 4
            )->withErrors([
                'block' => 'Email không đúng hoặc đã bị khóa,Vui lòng liên hệ quản lí',
            ]);
        }
    }

    public function addProductView(){
        $cataObj = new Category();
        $menu = 'product';
        $catalogs = Catalog::all();
        $categories =  $cataObj->getCategoriesByCatalogId($catalogs[0]->id);
        return view('SupplierView.add_product_view',compact('catalogs','menu','categories'));
    }

    public function sentProductAjax(Request $request)
    {
        $error = '';
        $success_output = '';
        try {
            $orderLine = OrderLine::find($request->id);
            $orderLine->orderline_status_id = 2;
            $orderLine->save();
            $orderLine->sent_at = $orderLine->updated_at;
            $orderLine->save();
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

