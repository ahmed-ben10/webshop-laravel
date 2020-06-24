<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function orders_products(){
        return $this->hasMany('App\Order_Product');
    }
}
