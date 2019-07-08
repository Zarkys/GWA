<?php
    
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'Api\AuthController@login');
        Route::post('signup', 'Api\AuthController@signup');
        
        Route::group(['middleware' => 'auth:api'], function() {
            Route::post('logout', 'Api\AuthController@logout');
            Route::get('user', 'Api\AuthController@user');
        });
    });