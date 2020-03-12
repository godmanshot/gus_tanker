<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function getInfoAttribute()
    {
        return $this->first_name.' '.$this->last_name.' '.$this->phone;
    }
}
