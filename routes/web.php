<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    $work = \App\Work::find(6);

    $writer = new \App\Work\PdfWorkWriter();
    // $writer = new \App\Work\DocxWorkWriter();

    // $writer = new \App\Work\HtmlWorkWriter();

    return $work->write($writer);
});