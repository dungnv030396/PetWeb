<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
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
        return view('suppliers.list_supplier',compact('listSupplier'));
    }

    public function searchByName(){
        $user = new User();
        $listSupplier = $user->searchByName();
        return view('suppliers.list_supplier',compact('listSupplier'));
    }
    public function detailSupplier(){
        $id = \request('id');
        $user = User::all()->find($id);
        $pro = new Product();
        $products = $pro->getProductsBySupplierId($id,12);
        return view('suppliers.detail_supplier',compact('user','products'));
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
            return redirect(route('listOrderSp'));
        }else{
            return Redirect::back()->with(
                'error_loginToManager', 4
            )->withErrors([
                'block' => 'Email không đúng hoặc đã bị khóa,Vui lòng liên hệ quản lí',
            ]);
        }
    }
}

