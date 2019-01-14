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
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.category.filterby',
            'uses' => 'Api\CategoryController@filterby',
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
            'as'   => 'api.category.activate',
            'uses' => 'Api\CategoryController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.category.inactivate',
            'uses' => 'Api\CategoryController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.category.delete',
            'uses' => 'Api\CategoryController@delete',
        ]);
        
    });