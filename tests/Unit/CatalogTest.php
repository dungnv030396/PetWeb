<?php
use App\Catalog;
use App\Category;
use App\Product;
use Tests\ModelTestCase;

class CatalogTest extends ModelTestCase
{
    
    public function test_catalog_relation_category()
    {
        $p = new Catalog();
        $c = $p->categories();
        $this->assertHasManyRelation($c, $p, new Category());
    }
    
    public function test_getCatalog()
    {
     	$catalog= DB::table('catalogs')->where('id', 1)->get();
     	//$catalog->id=1;$catalog->name='Vật nuôi';
     	$this->assertEquals('Vật nuôi',$catalog[0]->name);
    }
}
