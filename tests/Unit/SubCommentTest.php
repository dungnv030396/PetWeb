<?php

namespace Tests\Unit;
use App\SubComment;
use App\Comment;
use App\User;
use App\Product;
use Tests\ModelTestCase;

class SubCommentTest extends ModelTestCase
{
    
    public function test_subcomments_relation_user()
    {
       
        $c = new SubComment();
        $u = $c->user();
        $this->assertBelongsToRelation($u, $c, new User(),'user_id');
    }
     public function test_subcomments_relation_comment()
    {
       
        $c = new SubComment();
        $p = $c->comment();
        $this->assertBelongsToRelation($p, $c, new Comment(),'comment_id');
    }
}
