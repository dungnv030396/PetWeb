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
        return back()->with('status', 'Chúc mừng bạn đã đăng ký tài khoản Thành Công!');
    }

    public function show()
    {
        $id = \request('id');
        $user = User::all()->find($id);
        return view('clientViews.profile.userProfile', compact('user'));
    }
    public function registerSupplier(Request $request){
            $user = new SupplierRegister();
            $user->registerToSupplier($this,$request);
            return back()->with('registerToSupSuccess','Gửi đơn đăng ký thành công');
    }
}
