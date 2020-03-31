<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    public $fillable = [
        'id',
        'name',
        'modification',
        'manufacturer_id',
        'service_station_id',
    ];
    
    public function manufacturer()
    {
        return $this->hasOne('App\CarManufacturer', 'id', 'manufacturer_id');
    }

    public function getInfoAttribute()
    {
        $manufacturer = $this->manufacturer;

        return $manufacturer->name.' '.$this->name.' '.$this->modification;
    }

    public function station()
    {
        return $this->hasOne('App\ServiceStation');
    }
    
    protected static function booted()
    {
        static::addGlobalScope('currentStation', function ($builder) {
            $builder->currentStation();
        });
    }

    public function scopeCurrentStation($query)
    {
        $station_id = station()->id;

        return $query->where('service_station_id', $station_id)->orWhereNull('service_station_id');
    }
}
