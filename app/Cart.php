<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function discounts()
    {
        return $this->belongsToMany('App\Discount', 'carts_discounts')->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'cart_products');
    }
}
