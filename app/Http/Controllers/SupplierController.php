<?php

namespace App\Http\Controllers;
use Datatables;
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

    public function listOrder(){
        return view('ProductManagementViews.order_view');
    }
}

