<?php

namespace App\Http\Controllers;

use App\PasswordToken;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class MailController extends Controller
{
    public function resetPassword()
    {
        $user = new User();
        $res = $user->resetPass();
        if (!$res['error']){
            return back()->with($res['code'],$res['message']);
        }else{
            return back()->with($res['code'],$res['message']);
        }
    }
    public function changePassword(){
        $user_id = \request('user_id');
        $user = new User();
        $res = $user->changePassByMail($this,$user_id);
        if ($res!=null){
            return redirect(route('backChangePassByMail'))->with('ChangePassSuccess','Thay Đổi Mật Khẩu Thành Công');
        }else{
            return redirect(route('backChangePassByMail'))->with('ChangePassFails','Thay Đổi Mật Khẩu Không Thành Công');
        }
    }
    public function checkUrl(){
        $url = \request('token');
        $password_token = new PasswordToken();
        $tokens = PasswordToken::all();
        foreach ($tokens as $token){
            if (Hash::check(\request('token').''.'thepetteam',$token->token)) {
                $user_id = $token->user_id;
                return view('clientViews.profile.change_pass_by_email',compact('user_id'));
            }
            else{
                return view('welcome');
            }
        }
    }
}
