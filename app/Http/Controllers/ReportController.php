<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\User;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reportSupplier(){
        $user = new User();
        if(!$user->isLogin()){
            alert()->error('Quý khách xin vui lòng đăng nhập trước khi báo cáo!');
            return redirect()->back()->with('message','false');
        }
            $report = new Report();
            $report->reportSupplier($this);
            return back()->with('reportSuccess','Báo cáo đã được gửi! Chúng tôi sẽ đánh giá và kiểm tra báo cáo của bạn');
        }

    public function reportProduct(){
        $user = new User();
        if(!$user->isLogin()){
            alert()->error('Quý khách xin vui lòng đăng nhập trước khi báo cáo!');
            return redirect()->back()->with('messageReport','false');
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
        $button_value = \request('button');
//        $button_cancel = \request('cancel');
        if($button_value=='accept'){
            $report->admin_id = Auth::user()->id;
            $report->status = 2;
            $report->save();
        }else{
            $report->admin_id = Auth::user()->id;
            $report->status = 3;
            $report->save();
        }
        alert()->success('Xử Lý Báo Cáo Thành Công!');
        return redirect()->route('getListsReport')->with('message','true');
    }
}
