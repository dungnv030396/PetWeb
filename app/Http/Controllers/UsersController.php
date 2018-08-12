<?php

namespace App\Http\Controllers;

use App\SupplierRegister;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $city = strrev(str_before(strrev(Auth::user()->address),','));
        return view('clientViews.profile.userProfile', compact('city'));
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
        $city = strrev(str_before(strrev(Auth::user()->address),','));
        return view('clientViews.customer.registerToSupplier',compact('city'));
    }
}
