<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    public function orders(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}