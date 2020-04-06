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
        'equipment',
        'state',
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

        return $model_name->info.' (Номер: '.$this->government_number.', '.$this->cylinders.' цилиндров)';
    }

    public function getfullNameAttribute() {
        $model_name = $this->model;

        return $model_name->info;
    }

    public function getGovNumberFullAttribute() {
        return $this->government_number;
    }

    public function getVinFullAttribute() {
        return $this->vin;
    }

    public function getAutoLengthFullAttribute() {
        return $this->auto_length.' км.';
    }

    protected static function booted()
    {
        static::addGlobalScope('currentStation', function ($builder) {
            $builder->currentStation();
        });
    }

    public function scopeCurrentStation($query)
    {
        return $query->whereHas('client');
    }
}
