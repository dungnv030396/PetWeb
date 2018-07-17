<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\Category;
use App\Catalog;
use function foo\func;
use Session;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex(){
        $products = Catalog::find(1)->products;
    	$slide= Slide::all();
    	//$new_product=Product::where('delete_flag',0)->paginate(8);
    	//$sanpham_khuyenmai=Product::where('promotion_price','<>',0)->paginate(4);
    	// return view('page.trangchu',['slide'=>$slide]);
    	return view('clientViews.trangchu',compact('slide','products'));
    }

    public function getLoaiSp($type){
        $sp_theoloai=Product::where('id_type',$type)->get();
        $sp_khac=Product::where('id_type','<>',$type)->paginate(3);
        $loai=ProductType::all();
        $loai_sp=ProductType::where('id',$type)->first();
    	return view('clientViews.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChiTiet(Request $req){
        $sanpham=Product::where('id',$req->id)->first();
        $sp_tuongtu=Product::where('id_type',$sanpham->id_type)->paginate(3);
        $sanpham_moi=Product::where('new',1)->paginate(9);
    	return view('clientViews.chitiet_sanpham',compact('sanpham','sp_tuongtu','sanpham_moi'));
    }

    public function getLienHe(){
    	return view('clientViews.lienhe');
    }

    public function getGioiThieu(){
    	return view('clientViews.gioi_thieu');
    }

    public function getAddtocart(Request $req,$id){
        $product=Product::find($id);
        $oldcart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->add($product,$id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDelItemCart($id){
        $oldcart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getCheckout(){
        return view('clientViews.dat_hang');
    }

    public function postCheckout(Request $req){
        $cart=Session::get('cart');
        dd($cart);
        $customer=new Customer;
        $customer->name=$req->name;
        $customer->gender=$req->gender;
        $customer->email=$req->email;
        $customer->address=$req->address;
        $customer->phonenumber=$req->phone;
        $customer->notes=$req->notes;
        $customer->save();

        $bill=new Bill;
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$req->payment;
        $bill->note=$req->notes;
        $bill->save();

        foreach ($cart['items'] as $key => $value) {
            $bill_detail=new BillDetail;
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price=($value['price']/value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()>with('thongbao','Đặt hàng thành công');
        
    }
}
