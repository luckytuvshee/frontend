<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypeGroup extends Model
{
    public function type()
    {        
        return $this->hasMany('App\ProductType', 'type_group_id');
    }
}
