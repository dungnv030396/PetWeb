<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function Sodium\compare;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function loginView()
    {
        return view('ModeratorView.login');
    }

    public function loginModerator(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'roleId' => [4,1],'delete_flag' => 0])) {
            $menu = 'home';
            return redirect(route('supplierManagement'));
        } else {
            return Redirect::back()->withErrors([
                'message' => 'Email hoặc mật khẩu không chính xác hoặc đã bị khóa',
            ]);
        }
        return back();
    }

    public function destroy()
    {
        auth()->logout();
        return redirect(route('loginView'));
    }
}
