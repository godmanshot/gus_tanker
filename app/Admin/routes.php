<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('clients', ClientController::class);
    $router->resource('car-manufacturers', CarManufacturerController::class);
    $router->resource('car-models', CarModelController::class);
    $router->resource('cars', CarController::class);
    $router->resource('works', WorkController::class);

});
