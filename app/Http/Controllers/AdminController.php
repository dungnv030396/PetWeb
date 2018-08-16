<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\SupplierRegister;

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
    public function viewDetailRegistration(){
        $registration_id = request('id');
        $supplierRegister = new SupplierRegister();
        $res = $supplierRegister->viewDetailRegistration($registration_id);
        $menu = 'supplier';
        return view('AdminView.detail_registration',compact('res','menu'));
    }
    public function registrationProcess(){
        $supRegistrer = new SupplierRegister();
        $res = $supRegistrer->registrationProcess();
        if ($res){
            alert()->success('Chấp Thuận Đơn Thành Công');
            return \redirect()->route('listRegistrationForm')->with('accept','true');
        }else{
            alert()->error('Hủy Đơn Thành Công');
            return \redirect()->route('listRegistrationForm')->with('cancel','false');
        }
    }
}
