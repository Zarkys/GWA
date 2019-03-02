<?php
    Route::group(['middleware' => ['guest']], function () {
        
        Route::get('/', [
            'as'   => 'auth.login',
            'uses' => 'AuthController@login',
        ]);
        
        Route::post('/', [
            'as'   => 'auth.login.post',
            'uses' => 'AuthController@authenticate',
        ]);
        
    });
    
    Route::group([
        'middleware' => ['auth'],
        'prefix'     => '',
    ], function () {
        
        Route::get('/logout', [
            'as'   => 'auth.logout',
            'uses' => 'AuthController@logout',
        ]);
        
    });
