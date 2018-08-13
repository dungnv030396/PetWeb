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
            return back()->with('postProductSuccess', 'Gửi đơn đăng ký thành công');
        }
    }
    public function registerSupplierPage(){
        $userCity = User::find(Auth::user()->id)->city;
        $cities = City::all();
        return view('clientViews.customer.registerToSupplier',compact('cities','userCity'));
    }

    public function registerView(){
        $cities = City::all();
        return view('registration.register',compact('cities'));
    }
}
