<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['except' =>'destroy']);
    }

    public function login(){


       // $username = \request('username');
      //  $password = \request('password');

        if(! \auth()->attempt(\request(['username','pwd']))){

            return back()->withErrors([

                'message' => 'Plz check your account'
            ]);
        }
        return back()->withErrors([

            'message' => 'Tài khoản chính xác'
        ]);
        return redirect()->trangchu();
    }

    public function destroy(){
        auth()->logout();

        return Redirect::to('/index');
    }
}
