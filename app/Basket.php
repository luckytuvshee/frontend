<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public function basket_item()
    {        
        return $this->hasMany('App\BasketItem', 'basket_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function order()
    {        
        return $this->belongsTo('App\Order');
    }
}
