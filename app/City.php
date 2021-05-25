<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function district()
    {        
        return $this->hasMany('App\District', 'city_id');
    }
}
