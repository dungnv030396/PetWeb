<?php

namespace App\Http\Controllers;

use App\Order;
use App\Warehouse;
use Illuminate\Http\Request;
use App\OrderLine;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function Sodium\compare;

class ModeratorController extends Controller
{

    public function loginModerator(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'roleId' => 4,'delete_flag' => 0])) {
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

    public function orderSuccess(Request $request){
        try{
            $orderObj = new Order();
            $orderObj->orderSuccess($request);
            alert()->success('Đã nhận order số '.$request->id);
            return redirect()->back()->with('message','Đã nhận order số '.$request->id);
        }catch (\Exception $e){
            alert()->error('Có lỗi xảy ra!');
            return redirect()->back()->with('message','Có lỗi xảy ra!');
        }
    }

    public function orderOfWarehouseView(Request $request){
        $menu = 'order';
        $warehouse = Warehouse::find($request->id);
        return view('ModeratorView.order_warehouse',compact('menu','warehouse'));
    }

    public function orderShip(Request $request){
        try{
            $orderObj = new Order();
            $orderObj->orderShip($request);
            alert()->success('Xác nhận đã chuyển đơn hàng số '.$request->id);
            return redirect()->back()->with('message','success');
        }catch (\Exception $e){
            alert()->error('Có lỗi xảy ra!');
            return redirect()->back()->with('message','Có lỗi xảy ra!');
        }
    }

    public function productToWarehouseView(Request $request){
        $menu = 'product';
        $warehouse = Warehouse::find($request->id);
        return view('ModeratorView.product_warehouse',compact('menu','warehouse'));
    }

    public function confirmProductToWarehouse(Request $request)
    {
        $error = '';
        $success_output = '';
        try {
            $orderLine = OrderLine::find($request->id);
            $orderLine->orderline_status_id = 3;
            $orderLine->save();
            $order = Order::find($orderLine->order->id);
            if($order){
                $check = true;
                foreach ($order->orderLine as $oLine){
                    if($oLine->status->id!=3){
                        $check = false;
                        break;
                    }
                }
                if($check){
                    $order->status_id = 3;
                    $order->save();
                }
            }
            $success_output = 'success';
        } catch (\Exception $e) {
            $error = 'error';
        }
        $output = array(
            'error' => $error,
            'success' => $success_output
        );
        echo json_encode($output);
    }
}
