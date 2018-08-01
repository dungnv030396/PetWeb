<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt(['email' => $request->emailid, 'password' => $request->password, 'roleId' => [2,3]])) {
            return Redirect::back()->with(
                'error_code', 5
            )->withErrors([
                'message' => 'Email hoặc mật khẩu không chính xác',
            ]);
        }
        if (!Auth::attempt(['email' => $request->emailid, 'password' => $request->password,'delete_flag' => 0])){
            return Redirect::back()->with(
                'error_code', 5
            )->withErrors([
                'block' => 'Email đã bị khóa,Vui lòng liên hệ quản lí',
            ]);
        }
        return Redirect::to('/index');
    }

    public function destroy()
    {

        auth()->logout();

        return Redirect::to('/index');
    }
}
