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
        if (Auth::attempt(['email' => $request->emailid, 'password' => $request->password, 'roleId' => [2,3],'delete_flag' => 0])) {
            return back();
        }else{
            return Redirect::back()->with(
                'error_code', 5
            )->withErrors([
                'block' => 'Email không đúng hoặc đã bị khóa,Vui lòng liên hệ quản lí',
            ]);
        }

        return back();
    }

    public function destroy()
    {

        auth()->logout();

        return redirect(route('trangchu'));
    }
}
