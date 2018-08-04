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
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }

    /*public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_product','id');
    }*/

    public function getProductsByType($catalog_id, $category_id, $number_record)
    {
        if (is_null($catalog_id)) {
            return redirect()->back();
        } else {
            $link = '';
            $catalog = Catalog::find($catalog_id);
            $link .= $catalog->name;
            if (is_null($category_id)) {
                $products = $this->getProductsByCatalogID($catalog_id, $number_record);
                return ['products' => $products,
                    'link' => $link
                ];
            } else {
                $category = Category::find($category_id);
                $link .= " / " . $category->name;
                $products = $this->getProductsByCategoryId($category_id, $number_record);
                return ['products' => $products,
                    'link' => $link
                ];
            }
        }

    }

    public function getProductsByCatalogID($catalog_id, $number_record)
    {
        $cate = new Category();
        $cata = Catalog::find($catalog_id);
        $categories = $cate->getCategoriesInOneCatalog($cata);
        $idCategoryArray = array();
        foreach ($categories as $category) {
            $idCategoryArray[] = $category->id;
        }
        $listProduct = Product::where([
            ['delete_flag', '=', '0'],
            ['quantity', '>', 0]
        ])->whereIn('category_id', $idCategoryArray)->latest()->paginate($number_record,['*'], 'p1');
        return $listProduct;
    }

    public function getNewProducts($number_record)
    {
        $listProduct = Product::where([
            ['delete_flag', '=', '0'],
            ['quantity', '>', 0]
        ])->limit($number_record)->latest()->get();
        return $listProduct;
    }

    public function getSaleProducts($number_record)
    {
        return Product::where([
            ['delete_flag', '=', '0'],
            ['quantity', '>', 0],
            ['discount', '>', 0]
        ])->paginate($number_record, ['*'], 'p2');
    }


    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function getProductDetailById($id)
    {
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

    public function getProductsByCategoryId($id, $number_record)
    {
        return Product::where([['category_id', '=', $id], ['delete_flag', '=', 0], ['quantity', '>', 0]])->latest()->paginate($number_record,['*'],'p3');
    }

    public function getProductsBySupplierId($id,$number_record){
        return Product::where([['user_id', '=', $id], ['delete_flag', '=', 0], ['quantity', '>', 0]])->latest()->paginate($number_record);
    }


}
