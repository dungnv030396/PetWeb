<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Arr;
use function Sodium\add;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    /*public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_product','id');
    }*/

    public function getProductsByCatalogID($catalog_id,$number_record)
    {
        $cate = new Category();
        $cata = new Catalog();
        $cata = Catalog::find($catalog_id);
        $categories = $cate->getCategoriesInOneCatalog($cata);
        $idCategoryArray = array();
        foreach ($categories as $category) {
            $idCategoryArray[] = $category->id;
        }
        $listProduct = Product::where([
                ['delete_flag','=','0'],
                ['quantity', '>', 0]
        ])->whereIn('category_id', $idCategoryArray)->latest()->paginate($number_record);
        return $listProduct;
    }

    public function getNewProducts($number_record)
    {
        $listProduct = Product::where([
            ['delete_flag','=','0'],
            ['quantity', '>', 0]
        ])->limit($number_record)->latest()->get();
        return $listProduct;
    }

    public function getSaleProducts(){
        return Product::where([
            ['delete_flag','=','0'],
            ['quantity', '>', 0],
            ['discount', '>', 0]
        ])->paginate(8);
    }

    public function getProductById($id){
        return Product::find($id);
    }

    public function getProductDetailById($id){
        $product = Product::find($id);
        $category = $product->category;
        $catalog = Category::find($category->id)->catalog;
        $supplier = $product->user;
        return [
            'product' => $product,
            'category' => $category,
            'catalog' => $catalog,
            'supplier' => $supplier
        ];
    }

    public function getProductsByCategoryId($id,$number_record){
        return Product::where([['category_id', '=', $id],['delete_flag','=',0],['discount','>',0]])->latest()->paginate($number_record);
    }


}
