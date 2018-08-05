<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addReplyComment($request){
        try{
            $customer = new User();
            $customer = $customer->getCurrentUser();
            $comment = new SubComment();
            $comment->user_id = $customer->id;
            $comment->comment_id = $request->commentId;
            if(!empty($request->uploadMedia)){
                $comment->media_link = $request->uploadMedia;
            }
            $comment->description = $request->addComment;
            $comment->save();
        }catch (\Exception $e){
            return false;
        }
        return true;
    }

}