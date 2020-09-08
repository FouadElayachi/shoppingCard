<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function carts()
    {
        return $this->belongsToMany('App\Cart', 'carts_discounts');
    }

    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }
}
