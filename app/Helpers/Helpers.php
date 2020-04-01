<?php

use App\ServiceStation;

if (!function_exists('station')) {
    
    /**
     * Получиние СТО из контейнера
     * Расположение в файле AppServiceProvider.php
     */
    function station() {
        return resolve(ServiceStation::class);
    }
    
    /**
     * Форматирование цены
     */
    function currency($price = 0) {
        $station_currency = station()->currency;
        return $price.' '.$station_currency;
    }
}