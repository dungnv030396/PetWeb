<?php

namespace App\Http\Controllers;

use App\Product;
use App\StoreBenefit;
use App\User;
use App\Order;
use App\OrderLine;
use App\OrderlinepaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\SupplierRegister;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
//use Laravel\Socialite\One\User;

class AdminController extends Controller
{
    public function loginAdmin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'roleId' => 1, 'delete_flag' => 0])) {
            return \redirect()->route('admin_manage_place');
        } else {
            return Redirect::back()->with([
                'message' => 'Email hoặc mật khẩu không chính xác hoặc đã bị khóa',
            ]);
        }
        return back();
    }

    public function home(){
        $menu = 'home';
        $totalIncome = StoreBenefit::all()->sum('amount') * 10;
        $totalBenefit = $totalIncome * 0.1;
        $totalUsersActive = User::whereIn('roleId',[2,3])->where('delete_flag',0)->count();
        $totalUsers = User::whereIn('roleId',[2,3])->count();
        $totalOrdersActive = Order::where('delete_flag',0)->count();
        $totalOrders = Order::all()->count();
        $headerData = [
            $totalIncome,$totalBenefit,$totalOrdersActive,$totalOrders,$totalUsersActive,$totalUsers
        ];
        return view('AdminView.home',compact('menu','headerData'));
    }

    public function loadDataFinanceDaysAjax(Request $request)
    {
        try {
            $data = array();
            $orderObj = new Order();
            $dataOrder = $orderObj->getOrdersDataMonth();
            $dataIncomeReal = $orderObj->getFinanceDataMonth();
            $dataIncomeEstimate = $orderObj->getEstimateFinanceDataMonth();
            $data['days'] = (int) date('t');
            $data['orders'] = $dataOrder;
            $data['realIncome'] = $dataIncomeReal;
            $data['estimateIncome'] = $dataIncomeEstimate;
        } catch (\Exception $e) {
            return \redirect()->back();
        }
        return $data;
    }

    public function loadDataFinanceMonthsAjax(Request $request)
    {
        try {
            $data = array();
            $orderObj = new Order();
            $dataOrder = $orderObj->getOrdersDataYear();
            $dataIncomeReal = $orderObj->getFinanceDataYear();
            $dataIncomeEstimate = $orderObj->getEstimateFinanceDataYear();
            $data['days'] = (int) date('t');
            $data['orders'] = $dataOrder;
            $data['realIncome'] = $dataIncomeReal;
            $data['estimateIncome'] = $dataIncomeEstimate;
        } catch (\Exception $e) {
            return \redirect()->back();
        }
        return $data;
    }

    public function loadDataFinanceYearsAjax(Request $request)
    {
        try {
            $data = array();
            $orderObj = new Order();
            $dataOrder = $orderObj->getOrdersDataAnnual();
            $dataIncomeReal = $orderObj->getFinanceDataAnnual();
            $data['orders'] = $dataOrder;
            $data['realIncome'] = $dataIncomeReal;
        } catch (\Exception $e) {
            return \redirect()->back();
        }
        return $data;
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
        try{
            $startDate = Carbon::parse(OrderLine::orderBy('payment_date','asc')->first()->payment_date)->format('m-d-Y');
            $endDate = Carbon::parse(OrderLine::orderBy('payment_date','desc')->first()->payment_date)->format('m-d-Y');
        }catch (\Exception $e){
            $startDate = Carbon::parse(Carbon::now())->modify('+7 hours')->format('m-d-Y');
            $endDate = $startDate;
        }
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
        $moderators = User::where([['roleId','=',4],['delete_flag','=',0]])->get();
        $menu = 'finance';
        try {
            $startDate = Carbon::parse(Order::where('status_id', 5)->orderBy('completed_at', 'asc')->first()->completed_at)->format('m-d-Y');
            $endDate = Carbon::parse(Order::where('status_id', 5)->orderBy('completed_at', 'desc')->first()->completed_at)->format('m-d-Y');
        }catch (\Exception $e){
            $startDate = Carbon::parse(Carbon::now())->modify('+7 hours')->format('m-d-Y');
            $endDate = $startDate;
        }
        return view('AdminView.store_finance', compact('menu','startDate','endDate','moderators'));
    }

    public function blockAccount(Request $request){
        $error = '';
        $success_output = '';
        try {
            $user = User::find($request->id);
            $user->delete_flag = 1;
            $user->save();
            if($user->roleId == 3){
                $orders = Order::where([['user_id','=',$user->id],['status_id','!=',5]])->get();
                if($orders){
                    foreach ($orders as $order){
                        $orderObj = Order::where([['id','=',$order->id],['status_id','!=',5]])->first();
                        $orderObj->delete_flag = 1;
                        $orderObj->save();
                    }
                }
            }
            if($user->roleId == 2){
                if($user->products){
                    foreach ($user->products as $product){
                        $productObj = Product::find($product->id);
                        $productObj->delete_flag = 1;
                        $productObj->save();
                    }
                }
            }
            if($user->roleId == 4){
                $orders = Order::where([['moderator_id','=',$user->id],['status_id','!=',5]])->get();
                if($orders){
                    foreach ($orders as $order){
                        $orderObj = Order::where([['id','=',$order->id],['status_id','!=',5]])->first();
                        $orderObj->moderator_id = null;
                        $orderObj->save();
                    }
                }
            }
            //send mail
            $email = $user->email;
            $data = [
                'type' => 1,
                'blocked_at' => $user->updated_at->modify('+7 hours')->format('H:i:s d/m/Y'),
                'email' => $email,
                'name' => $user->name,
                'phone' => $user->phoneNumber,
                'address' => $user->address,
                'role' => $user->role->role
            ];
            $uObj = new User();
            $uObj->block_unblock_sendMail($data,$email);
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

    public function unblockAccount(Request $request){
        $error = '';
        $success_output = '';
        try {
            $user = User::find($request->id);
            $user->delete_flag = 0;
            $user->save();
            if($user->roleId == 2){
                if($user->products){
                    foreach ($user->products as $product){
                        $productObj = Product::find($product->id);
                        $productObj->delete_flag = 0;
                        $productObj->save();
                    }
                }
            }
            $email = $user->email;
            $data = [
                'type' => 2,
                'unblocked_at' => $user->updated_at->modify('+7 hours')->format('H:i:s d/m/Y'),
                'email' => $email,
                'name' => $user->name,
                'phone' => $user->phoneNumber,
                'address' => $user->address,
                'role' => $user->role->role
            ];
            $uObj = new User();
            $uObj->block_unblock_sendMail($data,$email);
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
