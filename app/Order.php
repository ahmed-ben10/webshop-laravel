<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function orders_products(){
        return $this->hasMany('App\Order_Product');
    }
    public function timer($delivery_time){
        $now = new \DateTime('now');
        return  (strtotime($delivery_time) - strtotime($now->format('H:i')))  / 60;
    }
}
