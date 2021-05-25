<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = true;

    public function status()
    {
        return $this->hasOne('App\OrderStatus', 'id', 'order_status_id');
    }

    public function shipment()
    {        
        return $this->hasOne('App\Shipment', 'id', 'order_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function basket()
    {
        return $this->hasOne('App\Basket', 'id', 'basket_id');
    }
}
