<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
          'middleware' => ['auth'],
        'prefix'     => '/api/1.0/productattribute/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.product.attribute',
            'uses' => 'Api\ProductAttributeController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.product.attribute.filteractive',
            'uses' => 'Api\ProductAttributeController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.product.attribute.filterinactive',
            'uses' => 'Api\ProductAttributeController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.product.attribute.filterdeleted',
            'uses' => 'Api\ProductAttributeController@filterdeleted',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.product.attribute.filterby',
            'uses' => 'Api\ProductAttributeController@filterby',
        ]);
        Route::get('/getattributes/{idproduct}', [
            'as'   => 'api.product.attribute.getattributes',
            'uses' => 'Api\ProductAttributeController@getAttributesValue',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.product.attribute.findbyid',
            'uses' => 'Api\ProductAttributeController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.product.attribute.findbyunique',
            'uses' => 'Api\ProductAttributeController@findbyunique',
        ]);
       
        
        Route::post('/', [
            'as'   => 'api.product.attribute.save',
            'uses' => 'Api\ProductAttributeController@save',
        ]);
        
        Route::put('/updateAttributes/{id}', [
            'as'   => 'api.product.attribute.updateattributes',
            'uses' => 'Api\ProductAttributeController@updateAttributes',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.product.attribute.update',
            'uses' => 'Api\ProductAttributeController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.product.attribute.activate',
            'uses' => 'Api\ProductAttributeController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.product.attribute.inactivate',
            'uses' => 'Api\ProductAttributeController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.product.attribute.delete',
            'uses' => 'Api\ProductAttributeController@delete',
        ]);
        
    });