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
}