<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'product/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.product',
            'uses' => 'Api\ProductController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.product.filteractive',
            'uses' => 'Api\ProductController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.product.filterinactive',
            'uses' => 'Api\ProductController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.product.filterdeleted',
            'uses' => 'Api\ProductController@filterdeleted',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.product.filterby',
            'uses' => 'Api\ProductController@filterby',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.product.findbyid',
            'uses' => 'Api\ProductController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.product.findbyunique',
            'uses' => 'Api\ProductController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.product.save',
            'uses' => 'Api\ProductController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.product.update',
            'uses' => 'Api\ProductController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.product.activate',
            'uses' => 'Api\ProductController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.product.inactivate',
            'uses' => 'Api\ProductController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.product.delete',
            'uses' => 'Api\ProductController@delete',
        ]);
        
    });