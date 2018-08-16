<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function loginAdmin(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'roleId' => 1,'delete_flag' => 0])) {
            $menu = 'home';
            return view('AdminView.home', compact('menu'));
        } else {
            return Redirect::back()->with([
                'message' => 'Email hoặc mật khẩu không chính xác hoặc đã bị khóa',
            ]);
        }
        return back();
    }
    public function destroy()
    {
        auth()->logout();
        return redirect(route('loginViewAdmin'));
    }
}
