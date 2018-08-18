<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderLine;
use App\OrderlinepaymentStatus;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\SupplierRegister;
use Carbon\Carbon;
use Laravel\Socialite\One\User;

class AdminController extends Controller
{
    public function loginAdmin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'roleId' => 1, 'delete_flag' => 0])) {
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

    public function viewDetailRegistration()
    {
        $registration_id = request('id');
        $supplierRegister = new SupplierRegister();
        $res = $supplierRegister->viewDetailRegistration($registration_id);
        $menu = 'supplier';
        return view('AdminView.detail_registration', compact('res', 'menu'));
    }

    public function registrationProcess()
    {
        $supRegistrer = new SupplierRegister();
        $res = $supRegistrer->registrationProcess();
        if ($res) {
            alert()->success('Chấp Thuận Đơn Thành Công');
            return \redirect()->route('listRegistrationForm')->with('accept', 'true');
        } else {
            alert()->error('Hủy Đơn Thành Công');
            return \redirect()->route('listRegistrationForm')->with('cancel', 'false');
        }
    }

    public function supplier_financeView(Request $request)
    {
        $menu = 'finance';
        $startDate = Carbon::parse(OrderLine::orderBy('payment_date','asc')->first()->payment_date)->format('m-d-Y');
        $endDate = Carbon::parse(OrderLine::orderBy('payment_date','desc')->first()->payment_date)->format('m-d-Y');
        $status = OrderlinepaymentStatus::all();
        return view('AdminView.supplier_finance', compact('menu','startDate','endDate','status'));
    }

    public function paymentForSupplierAjax(Request $request){
        $error = '';
        $success_output = '';
        try {
            $orderLine = OrderLine::find($request->id);
            $orderLine->finance_status = 2;
            $orderLine->save();
            $order = Order::find($orderLine->order_id);
            $check = true;
            foreach ($order->orderLine as $orderLine){
                if($orderLine->finance_status != 2){
                    $check = false;
                    break;
                }
            }
            if($check){
                $order->finance_status = 2;
                $order->save();
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

    public function webFinanceView(Request $request)
    {
        $menu = 'finance';
        $startDate = Carbon::parse(OrderLine::orderBy('payment_date','asc')->first()->payment_date)->format('m-d-Y');
        $endDate = Carbon::parse(OrderLine::orderBy('payment_date','desc')->first()->payment_date)->format('m-d-Y');
        $status = OrderlinepaymentStatus::all();
        return view('AdminView.supplier_finance', compact('menu','startDate','endDate','status'));
    }
    public function blockAccount(Request $request){
        $error = '';
        $success_output = '';
        try {
            $user = User::find($request->id);
            $user->delete_flag = 1;
            $user->save();
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
