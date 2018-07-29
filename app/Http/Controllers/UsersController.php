<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $user = new User();
        $email = User::all()->where('email', \request('emailid'));
        if (count($email) > 0) {
            return back()->withErrors('Đăng ký không thành công! Email đã tồn tại!xin mời nhập lại');
        }

        $this->validate(\request(), [
            'mem_name' => 'required',
            'emailid' => 'required|email',
            'password' => 'required|confirmed|digits_between:6,15',
            'phonenumber' => 'required|digits_between:10,15|numeric',
            'address' => 'required'
        ],
            [
                'password.digits_between' => 'Mật khẩu phải từ 6-15 kí tự!',
                'password.confirmed' => 'Mật Khẩu xác nhận không chính xác',
                'phonenumber.digits_between' => 'Số điện thoại phải có 10-15 chữ số!',
                'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!'
            ]);

        $user->name = request('mem_name');
        $user->email = request('emailid');
        $user->password = bcrypt(request('password'));
        $user->phoneNumber = request('phonenumber');
        $user->gender = \request('gender');
        $user->address = request('address');
        $user->avatar = 'user-default.png';
        $user->save();

        return redirect('/register')->with('status', 'Chúc mừng bạn đã đăng ký tài khoản Thành Công!');
    }

    public function show()
    {
        $id = \request('id');
        $user = User::all()->find($id);
        return view('profile.userProfile', compact('user'));
    }
}
