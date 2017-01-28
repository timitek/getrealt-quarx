<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


    Route::group(['namespace' => 'Timitek\GetRealT\Http\Controllers'], function () {
        
        Route::get('listings', 'ListingController@all');
    
    });

    Route::group(['namespace' => 'Timitek\GetRealT\Http\Controllers', 'prefix' => 'quarx', 'middleware' => ['web', 'auth', 'quarx']], function () { 
       
        Route::resource('getrealt', 'GetRealTController', ['as' => 'quarx', 'except' => ['show']]);
        
    });

