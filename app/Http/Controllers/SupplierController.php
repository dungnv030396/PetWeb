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
        return view('ProductManagementViews.productManagement');
//        return view('ProductManagementViews.ordersHistory');
    }

    public function load(){
        return view('ProductManagementViews.ordersHistory');
    }

    public function demo(){
        $id = Auth::user()->id;
        $products = DB::table('products')->select('id','created_at');
        return datatables($products)->make(true);
    }

}
