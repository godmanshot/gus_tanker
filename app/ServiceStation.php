<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceStation extends Model
{
    public function clients()
    {
        return $this->belongsToMany('App\Client', 'service_station_clients');
    }

    public function works()
    {
        return $this->belongsToMany('App\Work', 'service_station_works');
    }
}
