<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Report extends Model
{
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function reportSupplier($th){
        $report = new Report();

        if($description =request('report')=='1'){
            $th->validate(request(),[
                'other' => 'required|min:6|max:200'
            ],[
                'other.max' => 'Nội dung báo cáo không quá 200 kí tự',
                'other.min' => 'Nội dung báo cáo không ít hơn 6 kí tự'
            ]);
            $description = request('other');
        }else{
            $description = request('report');
        }
        $report->user_id = Auth::user()->id;
        $report->reportTo_id = request('id');
        $report->description = $description;
        $report->save();
    }
    public function reportProduct($th){
        $report = new Report();

        if($description =request('report')=='1'){
            $th->validate(request(),[
                'other' => 'required|max:2'
            ],[
                'other.max' => 'Nội dung báo cáo không quá 200 kí tự',
                'other.min' => 'Nội dung báo cáo không ít hơn 6 kí tự'
            ]);
            $description = request('other');
        }else{
            $description = request('report');
        }
        $report->user_id = Auth::user()->id;
        $report->reportTo_id = request('supplier_id');
        $report->product_id = request('product_id');
        var_dump(request('product_id'));
//        dd(request('product_id'));
        $report->description = $description;
        $report->save();
    }
}
