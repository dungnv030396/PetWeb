<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\User;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reportSupplier(){
            $report = new Report();
            $report->reportSupplier($this);
            return back()->with('reportSuccess','Báo cáo đã được gửi! Chúng tôi sẽ đánh giá và kiểm tra báo cáo của bạn');
        }

    public function reportProduct(){
        $report = new Report();
        $report->reportProduct($this);
        return back()->with('reportSuccess','Báo cáo đã được gửi! Chúng tôi sẽ đánh giá và kiểm tra báo cáo của bạn');
    }
    public function detailWaitingReport(){
        $report = new Report();
        $report_id = \request('id');
        $data = $report->detailWaitingReport($report_id);
        $menu = 'report';
        return view('ModeratorView.detail_waiting_report',compact('menu','data'));
    }
    public function reportProcess(){
        $report = Report::find(\request('id'));
        $button_accept = \request('button');
//        $button_cancel = \request('cancel');
        if($button_accept=='accept'){
            $report->admin_id = Auth::user()->id;
            $report->status = 2;
            $report->save();
        }else{
            $report->admin_id = Auth::user()->id;
            $report->status = 3;
            $report->save();
        }
        alert()->success('Xử Lý Báo Cáo Thành Công!');
        return redirect()->back()->with('message','true');
    }
}
