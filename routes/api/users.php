<?php

    use Illuminate\Http\Request;

    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'user/',
    ], function () {

        Route::get('/', [
            'as'   => 'api.user',
            'uses' => 'Api\UserController@index',
        ]);

        Route::get('/active', [
            'as'   => 'api.user.active',
            'uses' => 'Api\UserController@indexActive',
        ]);

        Route::get('/{id}', [
            'as'   => 'api.user.find',
            'uses' => 'Api\UserController@find',
        ]);

        Route::post('/', [
            'as'   => 'api.user.save',
            'uses' => 'Api\UserController@store',
        ]);

        Route::put('/{id}', [
            'as'   => 'api.user.update',
            'uses' => 'Api\UserController@update',
        ]);

        Route::put('/update_password/{id}', [
            'as'   => 'api.user.update',
            'uses' => 'Api\UserController@updatePassword',
        ]);

        Route::put('/update_name/{id}', [
            'as'   => 'api.user.update',
            'uses' => 'Api\UserController@updateName',
        ]);

        Route::delete('/{id}', [
            'as'   => 'api.user.delete',
            'uses' => 'Api\UserController@delete',
        ]);

    });