<?php


Route::group([
    'prefix' => 'auth',
], function () {

    Route::post('/login', [
        'as' => 'api.auth.login',
        'uses' => 'Api\AuthController@login',
    ]);
    Route::post('/register', [
        'as' => 'api.auth.register',
        'uses' => 'Api\AuthController@register',
    ]);


    Route::group([
        'middleware' => 'auth:api'
    ], function () {

        Route::post('/logout', [
            'as' => 'api.auth.logout',
            'uses' => 'Api\AuthController@logout',
        ]);

    });

});

