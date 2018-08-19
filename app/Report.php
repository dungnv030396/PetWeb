<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Report extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function reportSupplier($th)
    {
        $report = new Report();
        if ($description = request('report') == '1') {
            $th->validate(request(), [
                'other' => 'required|between:1,200'
            ], [
                'other.between' => 'Nội dung báo cáo không quá 200 kí tự',
                'other.required' => 'Không được để trống phần nội dung'
            ]);
            $description = trim(request('other'), ' ');
        } else {
            $description = trim(request('report'), ' ');
        }
        $report->user_id = Auth::user()->id;
        $report->reportTo_id = request('id');
        $report->description = $description;
        $report->save();
    }

    public function reportProduct($th)
    {
        $report = new Report();

        if ($description = request('report') == '1') {
            $th->validate(request(), [
                'other' => 'required|between:1,200'
            ], [
                'other.between' => 'Nội dung báo cáo không quá 200 kí tự',
                'other.required' => 'Không được để trống phần nội dung'
            ]);
            $description = trim(request('other'), ' ');
        } else {
            $description = trim(request('report'), ' ');
        }
        $report->user_id = Auth::user()->id;
        $report->reportTo_id = request('supplier_id');
        $report->product_id = request('product_id');
//        var_dump(request('product_id'));
//        dd(request('product_id'));
        $report->description = $description;
        $report->save();
    }

    public function getListReportsWaitAjax($start, $length, $search, $oderColunm, $oderSortType, $draw)
    {
        $columns = [
            0 => 'id',
//            1 => 'status',
//            2 => 'user_id',
//            3 => 'admin_id',
//            4 => 'reportTo_id',
            5 => 'created_at'
        ];
        $totalReport = Report::count();
        if (empty($search)) {
            $reports = Report::where('status', 1)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalReport;
        } else {
            $reports = Report::where('admin_id', 'like', "%$search%")
                ->orwhere('product_id', 'like', "%$search%")
                ->orwhere('reportTo_id', 'like', "%$search%")
                ->orwhere('user_id', 'like', "%$search%")
                ->where('status', '=', 1)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $reports->count();
        }
        $data = array();
        if ($reports) {
            foreach ($reports as $report) {
                $nestedData = array();
                $nestedData['id'] = $report->id;
                $nestedData['status'] = $report->status;
                $nestedData['user_name'] = User::find($report->user_id)->name;
                $nestedData['reportTo_name'] = User::find($report->reportTo_id)->name;
                $nestedData['product_id'] = $report->product_id;
                $nestedData['created_at'] = $report->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['detailReport'] = '<a href="' . route('detailWaitingReport', $report->id) . '">Xem Chi Tiết</a>';
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalReport),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }

    public function detailWaitingReport($report_id)
    {
        $report = Report::find($report_id);
        $product = Product::find($report->product_id);
        $user = User::find($report->user_id);
        return [
            'report' => $report,
            'product' => $product,
            'user' => $user
        ];
    }
    public function getListProcessedReportsAjax($start, $length, $search, $oderColunm, $oderSortType, $draw){
        $columns = [
            0 => 'id',
//            1 => 'status',
//            2 => 'user_id',
//            3 => 'admin_id',
//            4 => 'reportTo_id',
            6 => 'created_at'
        ];
        $totalReport = Report::count();
        if (empty($search)) {
            $reports = Report::where('status','=',2)
                ->orwhere('status','=',3)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalReport;
        } else {
            $reports = Report::where('admin_id', 'like', "%$search%")
                ->orwhere('product_id', 'like', "%$search%")
                ->orwhere('reportTo_id', 'like', "%$search%")
                ->orwhere('user_id', 'like', "%$search%")
                ->where('status', '=', 2)
                ->orwhere('status','=',3)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $reports->count();
        }
        $data = array();
        if ($reports) {
            foreach ($reports as $report) {
                $nestedData = array();
                $nestedData['id'] = $report->id;
                $nestedData['status'] = $report->status;
//                $nestedData['admin_id'] = $report->admin_id;
                $nestedData['admin_name'] = User::find($report->admin_id)->name;
//                $nestedData['user_id'] = $report->user_id;
                $nestedData['user_name'] = User::find($report->user_id)->name;
//                $nestedData['reportTo_id'] = $report->reportTo_id;
                $nestedData['reportTo_name'] = User::find($report->reportTo_id)->name;
                $nestedData['product_id'] = $report->product_id;
//                $nestedData['description'] = $report->description;
                $nestedData['created_at'] = $report->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['detailReport'] = '<a href="' . route('detailWaitingReport', $report->id) . '">Xem Chi Tiết</a>';
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalReport),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }
}
