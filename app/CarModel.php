<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    
    public function manufacturer()
    {
        return $this->hasOne('App\CarManufacturer', 'id', 'manufacturer_id');
    }

    public function getInfoAttribute()
    {
        $manufacturer = $this->manufacturer;

        return $manufacturer->name.' '.$this->name;
    }
}
