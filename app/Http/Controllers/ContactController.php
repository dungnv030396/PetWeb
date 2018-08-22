<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
//    protected $fillable = ['body'];//
    public function create(){
        $contact = new Contact();
        $res = $contact->creavteContact($this);
//        dd($res);
        if(!$res){
            alert()->success('Đã gửi thư thành công!');
            return back()->with('sendContactSuccess','Đã gửi thư thành công! chúng tôi sẽ cố gắng phản hồi lại một cách nhanh nhất');
        }else{
            alert()->error('Gặp lỗi! Mong bạn xem lại thông tin cung cấp');
            return back()->with('sendContactError','null');

        }
    }
}
