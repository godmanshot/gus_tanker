<?php

namespace App\Providers;

use App\Work;
use App\Client;
use App\ServiceStation;
use App\ServiceStationUser;
use App\Observers\WorkObserver;
use Encore\Admin\Facades\Admin;
use App\Observers\ClientObserver;
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
        $this->app->singleton(ServiceStation::class, function ($app) {
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
        Client::observe(ClientObserver::class);
        Work::observe(WorkObserver::class);
    }
}
