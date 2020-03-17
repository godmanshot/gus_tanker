<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
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
