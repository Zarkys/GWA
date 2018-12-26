<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'category/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.category',
            'uses' => 'Api\CategoryController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.category',
            'uses' => 'Api\CategoryController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.category.find',
            'uses' => 'Api\CategoryController@find',
        ]);
        Route::post('/', [
            'as'   => 'api.category.save',
            'uses' => 'Api\CategoryController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.category.update',
            'uses' => 'Api\CategoryController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.category.delete',
            'uses' => 'Api\CategoryController@delete',
        ]);
        
    });