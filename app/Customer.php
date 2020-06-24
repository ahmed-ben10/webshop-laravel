<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function user(){
        return $this->hasOne('App\User');
    }
}
