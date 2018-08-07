<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public  function listSupplier(){
        $user = new User();
        $listSupplier = $user->listSupplier();
        return view('suppliers.listSupplier',compact('listSupplier'));
    }

    public function searchByName(){
        $user = new User();
        $listSupplier = $user->searchByName();
        return view('suppliers.listSupplier',compact('listSupplier'));
    }
    public function detailSupplier(){
        $id = \request('id');
        $user = User::all()->find($id);
        $pro = new Product();
        $products = $pro->getProductsBySupplierId($id,12);
        return view('suppliers.detailSupplier',compact('user','products'));
    }

    public function home(){
        $menu = 'home';
        $userObj = new User();
        $user = $userObj->getCurrentUser();
        if($userObj->isSupplier($user)){
            return view('ProductManagementViews.home',compact('user','menu'));
        }
        alert()->error('Quý khách k có quyền truy cập!');
        return redirect()->back()->with('message','failed');
    }
    public function load(){
        return view('ProductManagementViews.ordersHistory');
    }
    public function demo()
    {
        $id = Auth::user()->id;
//        $products = DB::table('products')->select('id', 'created_at')->where('user_id',$id)->get();
        $products = Order::where('user_id',$id);
        return datatables($products)->make(true);
    }
    public function listOrder(){
        $menu = 'order';
        return view('ProductManagementViews.order_view',compact('menu'));
    }

}

