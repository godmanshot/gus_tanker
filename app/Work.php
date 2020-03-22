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
    
    private $writer;

    public function model()
    {
        return $this->hasOne('App\CarModel');
    }
    
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    
    public function car()
    {
        return $this->belongsTo('App\ClientCar');
    }

    public function station()
    {
        return $this->belongsToMany('App\ServiceStation', 'service_station_works');
    }
    
    protected static function booted()
    {
        static::addGlobalScope('currentStation', function ($builder) {
            $builder->currentStation();
        });
    }

    public function scopeCurrentStation($query)
    {
        return $query->whereHas('station', function ($query) {
            $query->where('service_stations.id', station()->id);
        });
    }

    public function write($writer)
    {
        $writer->setWork($this);
        $writer->setStation($this->station()->first());

        return $writer->write();
    }

    public function items()
    {
        return json_decode($this->work_json, true);
    }
    
    public function isInstall() {
        $items = $this->items();

        return $items['install_or_service'] == 'Установка';
    }
    
    public function isService() {
        $items = $this->items();

        return $items['install_or_service'] == 'Сервис';
    }
    
    public function gas_type() {
        $items = $this->items();

        return $items['gas_type'];
    }
    
    public function isLpg() {
        $items = $this->items();

        return $items['gas_type'] == 'LPG';
    }
    
    public function ballon_manufacturer() {
        $items = $this->items();

        return $items['ballon_manufacturer'];
    }
    
    public function ballon_type_cng() {
        $items = $this->items();

        return $items['ballon_type_cng'];
    }
    
    public function ballon_type_lpg() {
        $items = $this->items();

        return $items['ballon_type_lpg'];
    }
    
    public function balloons() {
        $items = $this->items();

        $balloons = [];

        if($items['gas_type'] == "CNG") {

            foreach($items['cng_balloons'] as $balloon) {
                $balloons[] = ['id' => $balloon['Номер'], 'name' => $items['ballon_manufacturer'].', '.$items['gas_type'].', '.$items['ballon_type_cng'].', '.$balloon['Объем'].'л.'];
            }
        } else if($items['gas_type'] == "LPG") {
            $balloons[] = ['id' => $items['balloon_id'], 'name' => $items['ballon_manufacturer'].', '.$items['gas_type'].', '.$items['ballon_type_lpg'].', '.$items['klapan_type_lpg'].', '.($items['ballon_volume'] != 'other' ? $items['ballon_volume'] : $items['ballon_volume-Comment']).'л.'];
        }

        return $balloons;
    }
    
    public function reducer() {
        $items = $this->items();

        $reducer = ['id' => 1, 'name' => $items['gearbox_manufacturer'].', '.$items['gearbox_model']];

        return $reducer;
    }
    
    public function ecu() {
        $items = $this->items();

        $ecu = ['id' => 1, 'name' => $items['ecu_manufacturer'].', '.$items['ecu_model']];

        return $ecu;
    }
    
    public function rails() {
        $items = $this->items();

        $rail = ['id' => 1, 'name' => $items['nozzles_manufacturer'].', '.$items['nozzles_model']];

        return $rail;
    }

    public function warranty_no() {
        return $this->id;
    }

    public function date_install() {
        return $this->updated_at->format('d.m.Y');
    }

    public function cert_no() {
        return $this->id;
    }

    public function company_name() {
        return $this->station[0]->fullName ?? '';
    }

    public function warranty_exp_month() {
        return $this->station[0]->warrantyExpMonthFull ?? '';
    }

    public function warranty_exp_lenght() {
        return $this->station[0]->warrantyExpLenghtFull ?? '';
    }

    public function to_period() {
        return $this->station[0]->toPeriodFull ?? 10;
    }

    public function city() {
        return $this->station[0]->cityNameFull ?? '';
    }

    public function response_person() {
        return $this->station[0]->responsePersonFull ?? '';
    }

    public function warranty_text() {
        return $this->station[0]->warrantyTextFull ?? '';
    }

    public function auto_name() {
        return $this->car->fullName ?? '';
    }

    public function gov_number() {
        return $this->car->govNumberFull ?? '';
    }

    public function vin() {
        return $this->car->vinFull ?? '';
    }

    public function auto_length() {
        return $this->car->autoLengthFull ?? '';
    }


}
