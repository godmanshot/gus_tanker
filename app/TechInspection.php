<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechInspection extends Model
{
    public $fillable = [
        'number_ti',
        'comment',
        'time_ti',
        'car_id'
    ];
    
    public function car()
    {
        return $this->belongsTo('App\ClientCar');
    }
    
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function scopeByManufacturer($query, $manufacturer)
    {
        return $query->whereHas('car', function ($query) use ($manufacturer) {
            $query->whereHas('model', function ($query) use ($manufacturer) {
                $query->where('manufacturer_id', $manufacturer);
            });
        });
    }

    public function scopeByModel($query, $model)
    {
        return $query->whereHas('car', function ($query) use ($model) {
            $query->where('model_id', $model);
        });
    }

    public function scopeByCylinders($query, $cylinders)
    {
        return $query->whereHas('car', function ($query) use ($cylinders) {
            $query->where('cylinders', $cylinders);
        });
    }
}
