<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public function carts()
    {
        return $this->belongsToMany('App\Cart', 'carts_discounts');
    }
}
