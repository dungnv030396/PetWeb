<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\User;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Illuminate\Support\Facades\Mail;


class ReportController extends Controller
{
    public function reportSupplier(){
        $user = new User();
        if(!$user->isLogin()){
            alert()->error('Quý khách xin vui lòng đăng nhập trước khi báo cáo!');
            return redirect()->back()->with('message','false');
        }elseif (request('id') == Auth::user()->id) {
            alert()->error('Quý khách không thể báo cáo chính mình!');
            return redirect()->back()->with('message2','false');
        }else {
            $report = new Report();
            $report->reportSupplier($this);
            return back()->with('reportSupplierSuccess', 'Báo cáo đã được gửi! Chúng tôi sẽ đánh giá và kiểm tra báo cáo của bạn');
        }
        }

    public function reportProduct(){
        $user = new User();
        if(!$user->isLogin()){
            alert()->error('Quý khách xin vui lòng đăng nhập trước khi báo cáo!');
            return redirect()->back()->with('messageReport','false');
        }
        if (request('supplier_id') == Auth::user()->id){
            alert()->error('Quý khách không thể báo cáo chính sản phẩm của mình!');
            return redirect()->back()->with('message2','false');
        }
        $report = new Report();
        $report->reportProduct($this);
        alert()->success('Báo cáo đã được gửi! Chúng tôi sẽ đánh giá và kiểm tra báo cáo của bạn!');
        return back()->with('reportSuccess','Báo cáo đã được gửi! Chúng tôi sẽ đánh giá và kiểm tra báo cáo của bạn');
    }
    public function detailWaitingReport(){
        $report = new Report();
        $report_id = \request('id');
        $data = $report->detailWaitingReport($report_id);
        $menu = 'report';
        return view('AdminView.detail_waiting_report',compact('menu','data'));
    }
    public function reportProcess(){
        $report = Report::find(\request('id'));
        $user_reported = User::find(request('reportTo_id'));
        $user = User::find($report->user_id);
        $email = $user_reported->email;
        $email_report = $user->email;
        $button_value = \request('button');
//        $button_cancel = \request('cancel');
        if($button_value=='accept'){
            $report->admin_id = Auth::user()->id;
            $report->status = 2;
            try{
                //send mail to supplier
                $data = array('name' => $user_reported->name,'des' => $report->description,'product_id'=>$report->product_id);
                Mail::send('clientViews.emails.notifi_report', $data, function ($message) use ($email){
                    $message->to($email)
                        ->subject('The Pet Family - Báo Cáo');
                    $message->from('thepetfamilyteam@gmail.com');
                });
                //send mail to user_reporter success
                $data2 = array('name' => $user->name,
                    'des' => $report->description,
                    'product_id'=>$report->product_id,
                    'reportTo_name' => $user_reported->name
                );
                Mail::send('clientViews.emails.notifi_to_reporter_suc', $data2, function ($message) use ($email_report){
                    $message->to($email_report)
                        ->subject('The Pet Family - Báo Cáo');
                    $message->from('thepetfamilyteam@gmail.com');
                });

            }catch (Exception $e){
                return back()->with('sentMailFail');
            }
            $report->save();
        }else{
            $report->admin_id = Auth::user()->id;
            $report->status = 3;
            //send mail to user_reporter fail
            try{
                $data = array('name' => $user->name,
                    'des' => $report->description,
                    'product_id'=>$report->product_id,
                    'reportTo_name' => $user_reported->name
                );
                Mail::send('clientViews.emails.notifi_to_reporter_fail', $data, function ($message) use ($email_report){
                    $message->to($email_report)
                        ->subject('The Pet Family - Báo Cáo');
                    $message->from('thepetfamilyteam@gmail.com');
                });
            }catch (Exception $e){
                return back()->with('sentMailFail');
            }
            $report->save();
        }
        alert()->success('Xử Lý Báo Cáo Thành Công!');
        return redirect()->route('getListsReport')->with('message','true');
    }
}
