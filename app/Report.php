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
                'other' => 'required|between:1,200'
            ],[
                'other.between' => 'Nội dung báo cáo không quá 200 kí tự',
            ]);
            $description = trim(request('other'),' ');
        }else{
            $description = trim(request('report'),' ');
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
                'other' => 'required|between:1,200'
            ],[
                'other.between' => 'Nội dung báo cáo không quá 200 kí tự',
            ]);
            $description = trim(request('other'),' ');
        }else{
            $description = trim(request('report'),' ');
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
