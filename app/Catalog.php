<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Category::class);
    }

    public function getCatalog($catalogIds){
        return Catalog::whereIn('id',$catalogIds)->get();
    }

    public  function getAllCatalog(){
        return Catalog::all();
    }

}