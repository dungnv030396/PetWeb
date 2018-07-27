<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        //dd($user);
        return view('suppliers.detailSupplier',compact('user'));
    }
}
