<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceStationUser extends Model
{
    public $fillable = ['service_station_id', 'user_id'];

    public function serviceStation()
    {
        return $this->hasOne('App\ServiceStation', 'id');
    }
    
    public function user()
    {
        return $this->hasOne('Encore\Admin\Auth\Database\Administrator', 'id');
    }
}
