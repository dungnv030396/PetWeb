<?php

namespace App\Http\Controllers;

use App\OrderLine;
use App\Product;
use App\Report;
use App\SupplierRegister;
use Illuminate\Http\Request;
use App\User;
use App\Order;

class DatatableController extends Controller
{
    //get all order pass to moderator
    public  function getOrders(Request $request){
        $orderObj = new Order();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $search = trim($search,' ');
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        try{
            $output = $orderObj->getOrdersAjax($start,$length,$search,$oderColunm,$oderSortType,$draw);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }
	
	public function getUsers(Request $request){
		//print_r($request->all());
		$columns = array(
			0 => 'name',
			1 => 'email',
			2 => 'created_at',
			3 => 'action'
		);
		
		$totalData = User::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$posts = User::offset($start)
					->limit($limit)
					->orderBy($order,$dir)
					->get();
			$totalFiltered = User::count();
		}else{
			$search = $request->input('search.value');
			$posts = User::where('name', 'like', "%{$search}%")
							->orWhere('email','like',"%{$search}%")
							->orWhere('created_at','like',"%{$search}%")
							->offset($start)
							->limit($limit)
							->orderBy($order, $dir)
							->get();
			$totalFiltered = User::where('name', 'like', "%{$search}%")
							->orWhere('email','like',"%{$search}%")
							->count();
		}		
					
		
		$data = array();
		
		if($posts){
			foreach($posts as $r){
				$nestedData['name'] = $r->name;
				$nestedData['email'] = $r->email;
				$nestedData['created_at'] = date('d-m-Y H:i:s',strtotime($r->created_at));
				$nestedData['action'] = '
					<a href="#!" class="btn btn-warning btn-xs">Edit</a>
					<a href="#!" class="btn btn-danger btn-xs">Delete</a>
				';
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			=> intval($request->input('draw')),
			"recordsTotal"	=> intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			=> $data
		);
		
		echo json_encode($json_data);
	}

	public function getSupplierPosts(Request $request){
        $productObj = new Product();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        try{
            $output = $productObj->getProductsAjax($start,$length,$search,$oderColunm,$oderSortType,$draw);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function orderProductsAjax(Request $request){
        $productObj = new Product();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        try{
            $output = $productObj->getOrderProductsAjax($start,$length,$search,$oderColunm,$oderSortType,$draw);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function getListsReport(Request $request){
        $reportObj = new Report();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        try{
            $output = $reportObj->getListReportsWaitAjax($start,$length,$search,$oderColunm,$oderSortType,$draw);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function getListsProcessedReport(Request $request){
        $reportObj = new Report();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        try{
            $output = $reportObj->getListProcessedReportsAjax($start,$length,$search,$oderColunm,$oderSortType,$draw);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function getOrdersWarehouse(Request $request){
        $orderObj = new Order();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        $warehouse_id = $request->warehouse_id;
        try{
            $output = $orderObj->getOrdersWarehouseAjax($start,$length,$search,$oderColunm,$oderSortType,$draw,$warehouse_id);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function productToWarehouse(Request $request){
        $orderObj = new OrderLine();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        $warehouse_id = $request->warehouse_id;
        try{
            $output = $orderObj->productToWarehouseAjax($start,$length,$search,$oderColunm,$oderSortType,$draw,$warehouse_id);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }
    public function getListRegistrations(Request $request){
        $supplierObj = new SupplierRegister();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        try{
            $output = $supplierObj->getListRegistrationFormsAjax($start,$length,$search,$oderColunm,$oderSortType,$draw);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function getListUsers(Request $request){
        $user = new User();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        try{
            $output = $user->getListUsersAjax($start,$length,$search,$oderColunm,$oderSortType,$draw);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function getListUsersBlocked(Request $request){
        $user = new User();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 5;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        try{
            $output = $user->getListUsersBlockedAjax($start,$length,$search,$oderColunm,$oderSortType,$draw);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function supplier_financeDataAjax(Request $request){
        $orderLineObj = new OrderLine();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        $startDate = $request->input('startDate')?:(new \DateTime('now'))->modify('+7 hours')->format('m-d-Y');
        $endDate = $request->input('endDate')?:(new \DateTime('now'))->modify('+7 hours')->format('m-d-Y');
        $status_id = $request->input('statusId') ?: 0;
        try{
            $output = $orderLineObj->getSupplier_financeAjax($start,$length,$search,$oderColunm,$oderSortType,$draw,$startDate,$endDate,$status_id);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    public function store_financeDataAjax(Request $request){
        $ordereObj = new Order();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        $startDate = $request->input('startDate')?:(new \DateTime('now'))->modify('+7 hours')->format('m-d-Y');
        $endDate = $request->input('endDate')?:(new \DateTime('now'))->modify('+7 hours')->format('m-d-Y');
        $moderator_id = $request->input('moderator_id') ?: 0;
        try{
            $output = $ordereObj->getStore_financeAjax($start,$length,$search,$oderColunm,$oderSortType,$draw,$startDate,$endDate,$moderator_id);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

    //at supplier management view
    public function getSupplier_financeDataAjax(Request $request){
        $orderLineObj = new OrderLine();
        $start = $request->input('start') ?: 0;
        $length = $request->input('length') ?: 10;
        $search = $request->input('search.value') ?: "";
        $oderColunm = $request->input('order.0.column') ?: 0;
        $oderSortType = $request->input('order.0.dir') ?: 'desc';
        $draw = $request->draw ?: 0;
        $startDate = $request->input('startDate')?:(new \DateTime('now'))->modify('+7 hours')->format('m-d-Y');
        $endDate = $request->input('endDate')?:(new \DateTime('now'))->modify('+7 hours')->format('m-d-Y');
        $status_id = $request->input('statusId') ?: 0;
        try{
            $output = $orderLineObj->getSupplier_financeDataAjax($start,$length,$search,$oderColunm,$oderSortType,$draw,$startDate,$endDate,$status_id);
        }catch(\Exception $ex){
            $output = array(
                "draw"            => intval(0),
                "recordsTotal"    => intval(0),
                "recordsFiltered" => intval(0),
                "data"            => array($start.",".$length.",".$search.",".$oderColunm.",".$oderSortType.",".$draw),
            );
        }
        echo json_encode($output);
    }

}
