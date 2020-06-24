<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products(){
        return $this->hasMany('App\Product');
    }
    public function getRouteKeyName()
    {
        return strtolower('name');
    }
}
