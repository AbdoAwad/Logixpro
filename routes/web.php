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

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('/demands')->group(function() {
        Route::get('/', 'DemandController@index')->name('demand');
        Route::post('/', 'DemandController@create');
        
        Route::prefix('/{id}')->group(function() {
            Route::delete('/', 'DemandController@delete')->name('demand.items');
            Route::get('/', 'DemandController@view');
            Route::patch('/', 'DemandController@update');
        });
    });

});

