<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    /*public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_product','id');
    }*/

}
