<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'typeproduct/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.type.product',
            'uses' => 'Api\TypeProductController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.type.product.filteractive',
            'uses' => 'Api\TypeProductController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.type.product.filterinactive',
            'uses' => 'Api\TypeProductController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.type.product.filterdeleted',
            'uses' => 'Api\TypeProductController@filterdeleted',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.type.product.filterby',
            'uses' => 'Api\TypeProductController@filterby',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.type.product.findbyid',
            'uses' => 'Api\TypeProductController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.type.product.findbyunique',
            'uses' => 'Api\TypeProductController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.type.product.save',
            'uses' => 'Api\TypeProductController@save',
        ]);
        Route::put('/change/{id}', [
            'as'   => 'api.type.product.change',
            'uses' => 'Api\TypeProductController@change',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.type.product.update',
            'uses' => 'Api\TypeProductController@update',
        ]);
      
      
        Route::delete('/{id}', [
            'as'   => 'api.type.product.delete',
            'uses' => 'Api\TypeProductController@delete',
        ]);
        
    });