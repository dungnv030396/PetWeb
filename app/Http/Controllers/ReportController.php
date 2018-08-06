<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
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
}
