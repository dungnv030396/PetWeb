<?php

namespace App\Http\Controllers;

use App\Comment;
use App\SubComment;
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

    //chưa làm đc
    public function addSingleCommentAjax(Request $request){
        $user = new User();
        if(!$user->isLogin()){
            $response = [
                'status' => 'notLogin',
                'comments' => null
                ];
            //return response()->json($response);
            alert()->error('Quý khách xin vui lòng đăng nhập trước khi bình luận!');
            return view('clientViews.comment.commentAjax',compact('response'));
        }
        $comment = new Comment();
        $result = $comment->addSingleComment($request);
        if (!$result){
            $response = [
                'status' => 'error',
                'comments' => null,
            ];
            //return response()->json($response);
            alert()->error('Có lỗi xảy ra! Quý khách xin vui lòng thử lại');
            return view('clientViews.comment.commentAjax',compact('response'));
        }
        $comments = new Comment();
        $comments = $comments->getCommentsByProductId($request->id,5);
        $response = [
            'status' => 'error',
            'comments' => $comments
        ];
        return view('clientViews.comment.commentAjax',compact('response'));
    }

    public function addReplyComment(Request $request){
        $user = new User();
        if(!$user->isLogin()){
            alert()->error('Quý khách xin vui lòng đăng nhập trước khi bình luận!');
            return redirect()->back()->with('message','false');
        }
        $comment = new SubComment();
        $result = $comment->addReplyComment($request);
        if (!$result){
            alert()->error('Có lỗi xảy ra! Quý khách xin vui lòng thử lại');
            return redirect()->back()->with('message','false');
        }
        alert()->success('Quý khách đã thêm bình luận thành công!');
        return redirect()->back()->with('message','true');
    }
}
