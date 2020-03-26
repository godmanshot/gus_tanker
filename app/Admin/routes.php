<?php

use App\ClientCar;
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
    $router->resource('client-cars', CarController::class);
    $router->resource('works', WorkController::class);
    $router->resource('service-stations', StationController::class);
    $router->resource('tech-inspections', TechInspectionController::class);
    
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
    
    Route::get('/api/client-cars/by-client', function(Request $request) {
        $q = $request->get('q');
        
        $clients = ClientCar::where('client_id', $q)->get();

        $clients->transform(function($item, $key)
        {
            return ['id' => $item->id, 'text' => $item->info];
        });

        return $clients;
    });
    
    Route::get('/works/{work}/documents', function(Request $request, \App\Work $work) {
        $writer = new \App\Work\PdfWorkWriter();
        // $writer = new \App\Work\DocxWorkWriter();
        // $writer = new \App\Work\HtmlWorkWriter();
    
        return $work->write($writer);
    })->name('works.documents');
    

    Route::get('/works/{work}/status', function(Request $request, \App\Work $work) {
        $request->validate([
            'status' => 'required|in:0,1,2'
        ]);

        $work->status = $request->status;

        if($request->status == \App\Work::STATUS_CREATE) {
            $work->ready_time = null;
        } elseif($request->status == \App\Work::STATUS_START) {
            $work->ready_time = null;
        } elseif($request->status == \App\Work::STATUS_READY) {
            $work->ready_time = now();
        }
        
        $work->save();

        return back();
    })->name('works.status');
    
});

