<?php

namespace App\Http\Controllers;

use App\Product;
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
        $oderColunm = $request->input('order.0.column') ?: 13;
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
}
