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


    Route::group(['namespace' => 'Timitek\GetRealT\Http\Controllers\FrontEnd'], function () {
        Route::get('listings', 'ListingsController@all');
        Route::get('listings/{id}', 'ListingsController@show');

    });

    Route::group(['namespace' => 'Timitek\GetRealT\Http\Controllers\Quarx', 'prefix' => 'quarx', 'middleware' => ['web', 'auth', 'quarx']], function () { 
        Route::get('getrealt', 'GetRealTController@index');
        Route::resource('getrealt/settings', 'GetRealTSettingsController', ['as' => 'quarx.getrealt', 'except' => ['create', 'show', 'edit', 'update', 'destroy']]);
        Route::resource('getrealt/contact', 'GetRealTContactController', ['as' => 'quarx.getrealt', 'except' => ['create', 'show', 'edit', 'update', 'destroy']]);
    });

    Route::group(['namespace' => 'Timitek\GetRealT\Http\Controllers\Api', 'prefix' => 'getrealt', 'middleware' => ['web']], function () { 
        Route::post('listings/sendLead', 'ListingsApiController@sendLead');
        Route::resource('listings', 'ListingsApiController', ['only' => ['index', 'show']]);
    });

