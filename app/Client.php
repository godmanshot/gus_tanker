<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $fillable = [
        'first_name',
        'last_name',
        'iin',
        'phone',
        'address'
    ];

    public function getInfoAttribute()
    {
        return $this->first_name.' '.$this->last_name.' '.$this->phone;
    }

    public function station()
    {
        return $this->belongsToMany('App\ServiceStation', 'service_station_clients');
    }

    public function cars()
    {
        return $this->hasMany('App\ClientCar');
    }
    
    protected static function booted()
    {
        static::addGlobalScope('currentStation', function ($builder) {
            $builder->currentStation();
        });
    }

    public function scopeCurrentStation($query)
    {
        return $query->whereHas('station', function ($query) {
            $query->where('service_stations.id', station()->id);
        });
    }
}
