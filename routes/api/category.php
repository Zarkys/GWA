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
            'as'   => 'api.category.filteractive',
            'uses' => 'Api\CategoryController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.category.filterinactive',
            'uses' => 'Api\CategoryController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.category.filterdeleted',
            'uses' => 'Api\CategoryController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.category.findbyid',
            'uses' => 'Api\CategoryController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.category.findbyunique',
            'uses' => 'Api\CategoryController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.category.save',
            'uses' => 'Api\CategoryController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.category.update',
            'uses' => 'Api\CategoryController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.category.active',
            'uses' => 'Api\CategoryController@active',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.category.inactive',
            'uses' => 'Api\CategoryController@inactive',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.category.delete',
            'uses' => 'Api\CategoryController@delete',
        ]);
        
    });