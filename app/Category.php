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

}