<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function subdistrict()
    {        
        return $this->hasMany('App\Subdistrict', 'district_id');
    }

    public function city()
    {        
        return $this->belongsTo('App\City');
    }
}
