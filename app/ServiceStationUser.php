<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceStationUser extends Model
{
    public function serviceStation()
    {
        return $this->hasOne('App\ServiceStation', 'id');
    }
    
    public function user()
    {
        return $this->hasOne('Encore\Admin\Auth\Database\Administrator', 'id');
    }
}
