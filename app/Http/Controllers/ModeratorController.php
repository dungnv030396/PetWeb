<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function Sodium\compare;

class ModeratorController extends Controller
{

    public function loginModerator(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'roleId' => [4,1],'delete_flag' => 0])) {
            $menu = 'home';
            return view('ModeratorView.home', compact('menu'));
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
        return redirect(route('loginView'));
    }

    public function orderDetail(Request $request){
        $menu = 'order';
        $orderObj = new Order();
        $order = $orderObj->getOrderByID($request->id);
        return view("ModeratorView.order_detail",compact('menu','order'));
    }

    public function printOrder(Request $request){
        $orderObj = new Order();
        $order = $orderObj->getOrderByID($request->id);
        return view("ModeratorView.order_print",compact('order'));
    }

    public function orderAssign(Request $request){
        try{
            $orderObj = new Order();
            $orderObj->orderAssign($request);
            alert()->success('Đã nhận order số '.$request->id);
            return redirect()->back()->with('message','Đã nhận order số '.$request->id);
        }catch (\Exception $e){
            alert()->error('Có lỗi xảy ra!');
            return redirect()->back()->with('message','Có lỗi xảy ra!');
        }
    }
    public function orderAssignDelete(Request $request){
        try{
            $orderObj = new Order();
            $orderObj->orderAssignDelete($request);
            alert()->success('Đã bỏ quản lý order số '.$request->id);
            return redirect()->back()->with('message','Đã bỏ quản lý order số '.$request->id);
        }catch (\Exception $e){
            alert()->error('Có lỗi xảy ra!');
            return redirect()->back()->with('message','Có lỗi xảy ra!');
        }
    }

    public function orderDelete(Request $request){
        try{
            $message = 'true';
            $menu = 'order';
            $orderObj = new Order();
            $orderObj->orderDelete($request);
            alert()->success('Đã hủy order số '.$request->id);
            return view('ModeratorView.order_view',compact('menu','message'));
        }catch (\Exception $e){
            alert()->error('Có lỗi xảy ra!');
            return redirect()->back()->with('message','Có lỗi xảy ra!');
        }
    }

}
