<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'tag/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.tag',
            'uses' => 'Api\TagController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.tag',
            'uses' => 'Api\TagController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.tag.find',
            'uses' => 'Api\TagController@find',
        ]);
        Route::post('/', [
            'as'   => 'api.tag.save',
            'uses' => 'Api\TagController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.tag.update',
            'uses' => 'Api\TagController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.tag.delete',
            'uses' => 'Api\TagController@delete',
        ]);
        
    });