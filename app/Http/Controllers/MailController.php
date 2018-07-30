<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class MailController extends Controller
{
    public function resetPassword()
    {
        $user = new User();
        $user->resetPass();
        return back()->with('resetPassSuccess','Khôi phục mật khẩu thành công! Chúng tôi đã gửi email tới địa chỉ email của bạn.');
    }
    public function changePassword(){
        $user = new User();
        $user->changePassByMail($this);
        return back()->with('ChangePassSuccess','Thay Đổi Mật Khẩu Thành Công');

    }
}
