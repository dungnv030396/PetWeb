<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\User;
class CommentController extends Controller
{
    public function addSingleComment(Request $request){
        $user = new User();
        if(!$user->isLogin()){
            alert()->error('Quý khách xin vui lòng đăng nhập trước khi bình luận!');
            return redirect()->back()->with('message','false');
        }
        $comment = new Comment();
        $result = $comment->addSingleComment($request);
        if (!$result){
            alert()->error('Có lỗi xảy ra! Quý khách xin vui lòng thử lại');
            return redirect()->back()->with('message','false');
        }
        alert()->success('Quý khách đã thêm bình luận thành công!');
        return redirect()->back()->with('message','true');
    }
}
