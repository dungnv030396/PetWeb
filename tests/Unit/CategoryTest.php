<?php

namespace Tests\Unit;

use App\Catalog;
use App\Category;
use App\Product;
use Tests\ModelTestCase;

class CategoryTest extends ModelTestCase
{
    
    public function test_category_relation_product()
    {
        $p = new Category();
        $c = $p->products();
        $this->assertHasManyRelation($c, $p, new Product());
    }
     public function test_category_relation_catalog()
    {
        $p = new Category();
        $c = $p->catalogs();
        $this->assertBelongsToRelation($c, $p, new Catalog(),'catalogs_id');
    }
}
