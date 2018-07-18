<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $username = User::all()->where('userName', \request('username'));
        $email = User::all()->where('email', \request('emailid'));
        if (count($username) > 0) {
            return view('registration.register')->withErrors('Tên tài khoản đã tồn tại!xin mời nhập lại');
        }
        if (count($email) > 0) {
            return view('registration.register')->withErrors('Email đã tồn tại!xin mời nhập lại');
        }

        $this->validate(\request(), [
            'mem_name' => 'required',
            'username' => 'required|min:6',
            'emailid' => 'required|email',
            'password' => 'required|confirmed|digits_between:6,15',
            'phonenumber' => 'required|digits_between:10,15|numeric',
            'address' => 'required'
        ],
            [
                'username.min' => 'Tên tài khoản phải có 6 kí tự trở lên!',
                'password.digits_between' => 'Mật khẩu phải từ 6-15 kí tự!',
                'phonenumber.digits_between' => 'Số điện thoại phải có 10-15 chữ số!',
                'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!'
            ]);


        $user->name = request('mem_name');
        $user->userName = request('username');
        $user->email = request('emailid');
        $user->pwd = bcrypt(request('password'));
        $user->phoneNumber = request('phonenumber');
        $user->address = request('address');
        $user->save();


        return view('registration.register')->withErrors('Chúc mừng bạn đã đăng ký Thành Công!');

    }
}
