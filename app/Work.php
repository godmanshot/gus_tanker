<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    const STATUS_CREATE = 0;
    const STATUS_START = 1;
    const STATUS_READY = 2;

    public $fillable = [
        'client_id',
        'car_id',
        'price',
        'prepaid',
        'additional_information',
        'work_json',
        'status',
        'ready_time',
        'pay_type',
    ];
    
    private $writer;

    public function getStatusNameAttribute()
    {
        if($this->status == static::STATUS_CREATE) {
            return "Не в работе";
        } else if($this->status == static::STATUS_START) {
            return "В работе";
        } else if($this->status == static::STATUS_READY) {
            return "Закончено";
        }
    }

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
    
    public function gbo_type() {
        $items = $this->items();

        return $items['gbo_type'];
    }
    
    public function isLpg() {
        $items = $this->items();

        return $items['gas_type'] == 'LPG';
    }
    
    public function ballon_manufacturer() {
        $items = $this->items();

        return $items['ballon_manufacturer'];
    }
    
    public function manufacturer_country() {
        $items = $this->items();

        return $items['manufacturer_country'];
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
            $balloons[] = ['id' => $items['balloon_id'], 'name' => $items['ballon_manufacturer'].', '.$items['gas_type'].', '.$items['ballon_type_lpg'].(!empty($items['klapan_type_lpg']) ? ', '.$items['klapan_type_lpg'] : '').', '.($items['ballon_volume'] != 'other' ? $items['ballon_volume'] : $items['ballon_volume-Comment']).'л.'];
        }

        return $balloons;
    }
    
    public function balloonsWithoutManufacturerAndType() {
        $items = $this->items();

        $balloons = [];

        if($items['gas_type'] == "CNG") {

            foreach($items['cng_balloons'] as $balloon) {
                $balloons[] = ['id' => $balloon['Номер'], 'name' => $items['gas_type'].', '.$items['ballon_type_cng'].', '.$balloon['Объем'].'л.'];
            }
        } else if($items['gas_type'] == "LPG") {
            $balloons[] = ['id' => $items['balloon_id'], 'name' => $items['gas_type'].', '.$items['ballon_type_lpg'].(!empty($items['klapan_type_lpg']) ? ', '.$items['klapan_type_lpg'] : '').', '.($items['ballon_volume'] != 'other' ? $items['ballon_volume'] : $items['ballon_volume-Comment']).'л.'];
        }

        return $balloons;
    }
    
    public function reducer() {
        $items = $this->items();

        $reducer = ['id' => ($items['gearbox_id'] ?? '-'), 'name' => $items['gearbox_manufacturer'].', '.$items['gearbox_model']];

        return $reducer;
    }
    
    public function ecu() {
        $items = $this->items();

        $ecu = ['id' => ($items['ecu_id'] ?? '-'), 'name' => $items['ecu_manufacturer'].', '.$items['ecu_model']];

        return $ecu;
    }
    
    public function rails() {
        $items = $this->items();

        $rail = ['id' => ($items['nozzles_id'] ?? '-'), 'name' => $items['nozzles_manufacturer'].', '.$items['nozzles_model']];

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
        return $this->station[0]->name ?? '';
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

    public function car_year() {
        return $this->car->year_manufacture ?? '';
    }

    public function car_body_number() {
        return $this->car->body_number ?? '';
    }

    public function vin() {
        return $this->car->vinFull ?? '';
    }

    public function auto_length() {
        return $this->car->autoLengthFull ?? '';
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

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public static function statisticsByMonth($month = 6)
    {
        $work = Work::selectRaw("SUM(price) as sum, DATE_FORMAT(created_at,'%Y.%m') as month")->groupBy(\Illuminate\Support\Facades\DB::raw("DATE_FORMAT(created_at,'%Y.%m')"))->orderBy(\Illuminate\Support\Facades\DB::raw("DATE_FORMAT(created_at,'%Y.%m')"))->limit($month);
        $_sum_months = $work->withoutGlobalScope('currentStation')->get()->keyBy('month');
        
        $sum_months = [];

        $now = now();

        for($i = 0; $i < $month; $i++) {
            $_month = $now->subMonth(1)->format("Y.m");
            $sum_months[$_month] = isset($_sum_months[$_month]) ? (int)$_sum_months[$_month]->sum : 0;
        }

        return $sum_months;
    }
}
