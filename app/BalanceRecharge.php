<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceRecharge extends Model
{
    public $fillable = [
        'service_station_id',
        'price',
        'uuid',
        'status',
        'paybox_id',
    ];
    
    public function station()
    {
        return $this->hasOne('App\ServiceStation', 'id', 'service_station_id');
    }
}
