<?php

namespace App\Providers;

use App\ServiceStation;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Получение СТО взависимости от пользователя, авторизация обязательна
         */
        $this->app->bind(ServiceStation::class, function ($app) {
            $station = \App\ServiceStationUser::where('user_id', Admin::user()->id)->first();

            if(!$station) {
                throw new \Exception("У данного пользователя отсутствует СТО", 1);
                
            }

            return $station->serviceStation;
        });

        /**
         * Подключение хелперов
         */
        foreach (glob(app_path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
