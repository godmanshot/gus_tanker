<?php

use App\Car;
use App\Client;
use Illuminate\Http\Request;
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
    
    Route::get('/api/clients', function(Request $request) {
        $q = $request->get('q');
        
        $clients = Client::where(function($query) use ($q) {
    
            return $query
                ->where('first_name', 'like', "%$q%")
                ->orWhere('last_name', 'like', "%$q%")
                ->orWhere('phone', 'like', "%$q%")
                ->orWhere('iin', 'like', "%$q%");
    
        })->paginate();

        $clients->getCollection()->transform(function($item, $key)
        {
            return ['id' => $item->id, 'text' => $item->info];
        });

        return $clients;
    });
    
    Route::get('/api/cars/by-client', function(Request $request) {
        $q = $request->get('q');
        
        $clients = Car::where('client_id', $q)->get();

        $clients->transform(function($item, $key)
        {
            return ['id' => $item->id, 'text' => $item->info];
        });

        return $clients;
    });
    
});

