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
}
