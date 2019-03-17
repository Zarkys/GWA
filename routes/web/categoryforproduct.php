<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
          //'middleware' => ['auth'],
        'prefix'     => '/api/1.0/categoryforproduct/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.categoryforproduct',
            'uses' => 'Api\CategoryForProductController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.categoryforproduct.filteractive',
            'uses' => 'Api\CategoryForProductController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.categoryforproduct.filterinactive',
            'uses' => 'Api\CategoryForProductController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.categoryforproduct.filterdeleted',
            'uses' => 'Api\CategoryForProductController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.categoryforproduct.findbyid',
            'uses' => 'Api\CategoryForProductController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.categoryforproduct.findbyunique',
            'uses' => 'Api\CategoryForProductController@findbyunique',
        ]);
        /*Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.categoryforproduct.filterby',
            'uses' => 'Api\categoryforproductController@filterby',
        ]);*/
        Route::post('/', [
            'as'   => 'api.categoryforproduct.save',
            'uses' => 'Api\CategoryForProductController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.categoryforproduct.update',
            'uses' => 'Api\CategoryForProductController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.categoryforproduct.activate',
            'uses' => 'Api\CategoryForProductController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.categoryforproduct.inactivate',
            'uses' => 'Api\CategoryForProductController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.categoryforproduct.delete',
            'uses' => 'Api\CategoryForProductController@delete',
        ]);
        
    });