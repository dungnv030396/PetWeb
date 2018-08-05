<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderLine(){
        return $this->hasMany(OrderLine::class);
    }
}
