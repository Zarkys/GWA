<?php

use Illuminate\Http\Request;

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/api/1.0/user/',
], function () {

    Route::get('/', [
        'as' => 'api.user',
        'uses' => 'Api\UserController@index',
    ]);

    Route::get('/get_user', [
        'as' => 'api.user.update',
        'uses' => 'Api\UserController@get_user',
    ]);

    Route::get('/active', [
        'as' => 'api.user.active',
        'uses' => 'Api\UserController@indexActive',
    ]);

    Route::get('/{id}', [
        'as' => 'api.user.find',
        'uses' => 'Api\UserController@find',
    ]);

    Route::put('/update_password', [
        'as' => 'api.user.update',
        'uses' => 'Api\UserController@updatePassword',
    ]);

    Route::put('/update_name', [
        'as' => 'api.user.update',
        'uses' => 'Api\UserController@updateName',
    ]);

    Route::post('/', [
        'as' => 'api.user.save',
        'uses' => 'Api\UserController@store',
    ]);

    Route::put('/{id}', [
        'as' => 'api.user.update',
        'uses' => 'Api\UserController@update',
    ]);

    Route::delete('/change/active/{id}', [
        'as' => 'api.user.activate',
        'uses' => 'Api\UserController@activate',
    ]);

    Route::delete('/change/inactive/{id}', [
        'as' => 'api.user.inactivate',
        'uses' => 'Api\UserController@inactivate',
    ]);

    Route::post('/delete', [
        'as' => 'api.user.delete',
        'uses' => 'Api\UserController@delete',
    ]);

    Route::post('/change/active', [
        'as' => 'api.user.change.active',
        'uses' => 'Api\UserController@changeStatus',
    ]);

});
