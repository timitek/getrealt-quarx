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
        Route::get('getrealt', 'GetRealTController@index');
    });

    Route::group(['namespace' => 'Timitek\GetRealT\Http\Controllers', 'prefix' => 'quarx/getrealt', 'middleware' => ['web', 'auth', 'quarx']], function () { 
        Route::resource('settings', 'GetRealTSettingsController', ['as' => 'quarx.getrealt', 'except' => ['create', 'show', 'edit', 'update', 'destroy']]);
    });

    Route::group(['namespace' => 'Timitek\GetRealT\Http\Controllers', 'prefix' => 'getrealt', 'middleware' => ['web']], function () { 
        Route::resource('listing', 'GetRealTListingController', ['only' => ['index', 'show']]);
    });

