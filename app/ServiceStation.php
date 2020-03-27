<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceStation extends Model
{
    public $fillable = [
        'name',
        'full_name',
        'id_of_company',
        'boss_otk',
        'image',
        'phone',
        'address',
        'currency',
        'timezone',
        'warranty_exp_month',
        'warranty_exp_lenght',
        'to_period',
        'city_name',
        'response_person',
        'warranty_text',
    ];

    public function clients()
    {
        return $this->belongsToMany('App\Client', 'service_station_clients');
    }

    public function works()
    {
        return $this->belongsToMany('App\Work', 'service_station_works');
    }


    public function getWarrantyExpMonthFullAttribute() {
        return $this->warranty_exp_month;
    }

    public function getWarrantyExpLenghtFullAttribute() {
        return $this->warranty_exp_lenght;
    }

    public function getToPeriodFullAttribute() {
        return $this->to_period;
    }

    public function getCityNameFullAttribute() {
        return $this->city_name;
    }

    public function getResponsePersonFullAttribute() {
        return $this->response_person;
    }

    public function getWarrantyTextFullAttribute() {
        return $this->warranty_text;
    }

}
