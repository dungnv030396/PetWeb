<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function updateProfile()
    {
        $this->validate(\request(), [
            'mem_name' => 'required',
            'emailid' => 'required|email',
            'phonenumber' => 'required|digits_between:10,15|numeric',
            'address' => 'required'
        ],
            [
                'phonenumber.digits_between' => 'Số điện thoại phải có 10-15 chữ số!',
                'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!'
            ]);

        $id = Auth::user()->id;
        $user = User::find($id);

        $user->name = request('mem_name');
        $user->email = request('emailid');
        $user->phoneNumber = request('phonenumber');
        $user->address = request('address');
        $user->save();

        return back()->with('statusUpdateProfile', 'Chúc mừng bạn đã thay đổi thông tin cá nhân Thành Công!');
    }

    public function updatePassword(Request $request)
    {

//        $id = Auth::user()->id;
//        $user = User::find($id);
//        $oldpwd = $user->password;
//        if ($oldpwd == \request('oldpwd')){
//

//
//        }else{
//
//            return back()->withErrors('Mật khẩu hiện tại không chính xác!');
//        }
//
//        return back()->with('statusUpdatePass','Chúc mừng bạn đã thay đổi mật khẩu Thành Công!');

        $this->validate(\request(), [
            'password' => 'required|confirmed|digits_between:6,15',
        ], [
            'password.digits_between' => 'Mật khẩu phải từ 6-15 kí tự!',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác! Xin mời nhập lại'
        ]);

        if (Hash::check(\request('oldpwd'), Auth::user()->password)) {

            Auth::user()->fill([
                'password' => Hash::make($request->password) //'password'--trong talble, $request->password-- trong view
            ])->save();

            return back()->with('statusUpdatePass', 'Chúc mừng bạn đã thay đổi mật khẩu Thành Công!');

        } else {
            return back()->withErrors('Mật khẩu hiện tại không chính xác!');

        }
    }
}
