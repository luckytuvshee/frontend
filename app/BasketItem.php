<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    public function basket()
    {        
        return $this->belongsTo('App\Basket', 'id');
    }

    public function product()
    {        
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
