<?php

namespace Tests\Unit;

use App\Comment;
use App\SubComment;
use App\User;
use App\Product;
use Tests\ModelTestCase;

class CommentTest extends ModelTestCase
{
    
    public function test_comments_relation_user()
    {
       
        $c = new Comment();
        $u = $c->user();
        $this->assertBelongsToRelation($u, $c, new User(),'user_id');
    }
     public function test_comments_relation_product()
    {
       
        $c = new Comment();
        $p = $c->product();
        $this->assertBelongsToRelation($p, $c, new Product(),'product_id');
    }
     public function test_comments_relation_subcomments()
    {       
        $u = new Comment();
        $c = $u->subComments();
        $this->assertHasManyRelation($c, $u, new SubComment());
    }
}
