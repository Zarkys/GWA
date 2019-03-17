<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
       //   'middleware' => ['auth'],
        'prefix'     => '/api/1.0/categoryproduct/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.category.product',
            'uses' => 'Api\CategoryProductController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.category.product.filteractive',
            'uses' => 'Api\CategoryProductController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.category.product.filterinactive',
            'uses' => 'Api\CategoryProductController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.category.product.filterdeleted',
            'uses' => 'Api\CategoryProductController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.category.product.findbyid',
            'uses' => 'Api\CategoryProductController@findbyid',
        ]);
       /* Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.category.product.findbyunique',
            'uses' => 'Api\categoryproductController@findbyunique',
        ]);*/
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.category.product.filterby',
            'uses' => 'Api\CategoryProductController@filterby',
        ]);
        Route::post('/', [
            'as'   => 'api.category.product.save',
            'uses' => 'Api\CategoryProductController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.category.product.update',
            'uses' => 'Api\CategoryProductController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.category.product.activate',
            'uses' => 'Api\CategoryProductController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.category.product.inactivate',
            'uses' => 'Api\CategoryProductController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.category.product.delete',
            'uses' => 'Api\CategoryProductController@delete',
        ]);
        
    });