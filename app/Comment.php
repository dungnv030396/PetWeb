<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addSingleComment($request){
        try{
            $customer = new User();
            $customer = $customer->getCurrentUser();
            $comment = new Comment();
            $comment->user_id = $customer->id;
            $comment->product_id = $request->productId;
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

    public function getCommentsByProductId($product_id,$number_record){
        $comments = Comment::where([['product_id', '=', $product_id], ['delete_flag', '=', 0]])->latest()->paginate($number_record,['*'],'p4');
        return $comments;
    }

}