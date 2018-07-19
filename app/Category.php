<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function catalogs()
    {
        return $this->belongsTo(Catalog::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function catalog()
    {
        return $this->hasOne(Catalog::class,'id','catalog_id');
    }

    public function getCategoriesInOneCatalog(Catalog $catalog){
        return Catalog::find($catalog->id)->categories;
    }

}