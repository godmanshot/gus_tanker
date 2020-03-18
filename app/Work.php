<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public $fillable = [
        'client_id',
        'car_id',
        'price',
        'prepaid',
        'additional_information',
        'work_json',
    ];

    public function model()
    {
        return $this->hasOne('App\CarModel');
    }
    
    public function client()
    {
        return $this->hasOne('App\Client');
    }

    public function station()
    {
        return $this->belongsToMany('App\ServiceStation', 'service_station_works');
    }

    public function scopeByStation($query, ServiceStation $station)
    {
        return $query->whereHas('station', function ($query) use ($station) {
            $query->where('service_stations.id', $station->id);
        });
    }

    public function scopeCurrentStation($query)
    {
        return $query->whereHas('station', function ($query) {
            $query->where('service_stations.id', station()->id);
        });
    }
    
    protected static function booted()
    {
        static::addGlobalScope('currentStation', function ($builder) {
            $builder->currentStation();
        });
    }
}
