<?php

    use Illuminate\Http\Request;

    Route::group([
        'middleware' => ['auth'],
        'prefix'     => '/api/1.0/rol/',
    ], function () {

        Route::get('/', [
            'as'   => 'api.rol',
            'uses' => 'Api\RolController@index',
        ]);

    });