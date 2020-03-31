<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarManufacturer extends Model
{
    public $fillable = [
        'id',
        'name',
    ];

    public function models()
    {
        return $this->hasMany('App\CarModel', 'manufacturer_id', 'id');
    }

    public function scopeByModel($query, $model)
    {
        return $query->whereHas('models', function($query) use ($model) {
            $query->where('id', $model);
        });
    }

    public function getInfoAttribute()
    {
        return $this->name;
    }
}
