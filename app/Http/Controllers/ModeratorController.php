<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }
    public function loginView(){
        return view('ModeratorView.login');
    }
    public function login(Request $request){
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'roleId' => [0,1]])) {
            return Redirect::back()->withErrors([
                'message' => 'Email hoặc mật khẩu không chính xác',
            ]);
        }
        if (!Auth::attempt(['email' => $request->emailid, 'password' => $request->password,'delete_flag' => 0])){
            return Redirect::back()->withErrors([
                'block' => 'Email đã bị khóa,Vui lòng liên hệ quản lí',
            ]);
        }
        $menu = 'home';
        return view('ProductManagementViews.home',compact('menu'));
    }

    public function destroy()
    {

        auth()->logout();

        return redirect(route('trangchu'));
    }
}
