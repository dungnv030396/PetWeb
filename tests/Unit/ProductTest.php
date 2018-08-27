<?php

namespace Tests\Unit;

use App\Comment;
use App\User;
use App\Product;
use App\Category;
use Tests\ModelTestCase;

class ProductTest extends ModelTestCase
{
    
     public function test_product_relation_category()
    {
       
        $p = new Product();
        $c = $p->categories();
        $this->assertBelongsToRelation($c, $p, new Category(),'categories_id');
    }
    public function test_product_relation_comments()
    {
        $p = new Product();
        $c = $p->comments();
        $this->assertHasManyRelation($c, $p, new Comment());
    }
}
