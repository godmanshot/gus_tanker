<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCar extends Model
{
    public $fillable = [
        'model_id',
        'client_id',
        'year_manufacture',
        'cylinders',
        'vin',
        'government_number',
        'body_number',
        'chassis',
        'data_sheet',
    ];

    public function model()
    {
        return $this->hasOne('App\CarModel', 'id', 'model_id');
    }
    
    public function client()
    {
        return $this->hasOne('App\Client', 'id', 'client_id');
    }

    public function getInfoAttribute()
    {
        $model_name = $this->model;

        return $model_name->info.' (VIN: '.$this->vin.')';
    }
}
