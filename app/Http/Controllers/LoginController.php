<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest',['except' =>'destroy']);
    }

    public function login(Request $request){


//        if(! \auth()->attempt(\request(['username','password']))){
//
//            return back()->withErrors([
//
//                'message' => 'Tài khoản hoặc mật khẩu không chính xác'
//            ]);
//        }

//        if(!Auth::attempt(['username' => $request->username,'password'=> $request->password,'roleId' => 2,'roleId' => 3])){
//
//            return back()->withErrors([
//
//                'message' => 'Tài khoản hoặc mật khẩu không chính xác'
//            ]);
//        }
        if(!Auth::attempt(['username' => $request->username,'password'=> $request->password,'roleId' => 2,'roleId' => 3])){

            return Redirect::back()->with(
                'error_code',5
                //'error_code' => 'Tài khoản hoặc mật khẩu không chính xác',
            )->withErrors([
                'message' => 'Tài khoản hoặc mật khẩu không chính xác',
            ]);
        }
        return Redirect::to('/index');
    }

    public function destroy(){

        auth()->logout();

        return Redirect::to('/index');
    }
}
