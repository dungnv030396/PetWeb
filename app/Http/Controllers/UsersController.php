<?php

namespace App\Http\Controllers;

use App\SupplierRegister;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\City;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $user->register($this);
        return back();
    }

    public function show()
    {
        $userCity = User::find(Auth::user()->id)->city;
        $cities = City::all();
        return view('clientViews.profile.userProfile', compact('cities','userCity'));
    }

    public function registerSupplier(Request $request)
    {
        $user = new SupplierRegister();
        $res = $user->registerToSupplier($this, $request);
        if ($res['error']) {
            return back()->with($res['code'], $res['message']);
        } else {
                return redirect(route('registerSupplierSuccess',$res['user']->user_id));
        }
    }
    public function registerSupplierPage(){
        $userCity = User::find(Auth::user()->id)->city;
        $cities = City::all();
        $count = SupplierRegister::where('user_id',Auth::user()->id)->count();
        return view('clientViews.customer.registerToSupplier',compact('cities','userCity','count'));
    }

    public function registerView(){
        $cities = City::all();
        return view('registration.register',compact('cities'));
    }
    public function registerSupplierSuccess(){
        $user_id = \request('id');
        $user_info = SupplierRegister::where('user_id',$user_id)->first();
//        dd($user_info);
        return view('clientViews.customer.register_to_supplier_success',compact('user_info'));
    }
}
