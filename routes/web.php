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
            Route::post('/', 'DemandController@createItem')->name('demand.items');
            Route::get('/', 'DemandController@show');
            Route::patch('/', 'DemandController@update');
        });
    });

    Route::prefix('/history')->group(function() {
        Route::get('/', 'HistoryController@index')->name('history');
        Route::prefix('/{id}')->group(function() {
            Route::get('/', 'HistoryController@show')->name('history.items');
        });
    });

});

