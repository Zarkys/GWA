<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'typeproductattribute/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.type.product.attribute',
            'uses' => 'Api\TypeProductAttributeController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.type.product.attribute.filteractive',
            'uses' => 'Api\TypeProductAttributeController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.type.product.attribute.filterinactive',
            'uses' => 'Api\TypeProductAttributeController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.type.product.attribute.filterdeleted',
            'uses' => 'Api\TypeProductAttributeController@filterdeleted',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.type.product.attribute.filterby',
            'uses' => 'Api\TypeProductAttributeController@filterby',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.type.product.attribute.findbyid',
            'uses' => 'Api\TypeProductAttributeController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.type.product.attribute.findbyunique',
            'uses' => 'Api\TypeProductAttributeController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.type.product.attribute.save',
            'uses' => 'Api\TypeProductAttributeController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.type.product.attribute.update',
            'uses' => 'Api\TypeProductAttributeController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.type.product.attribute.activate',
            'uses' => 'Api\TypeProductAttributeController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.type.product.attribute.inactivate',
            'uses' => 'Api\TypeProductAttributeController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.type.product.attribute.delete',
            'uses' => 'Api\TypeProductAttributeController@delete',
        ]);
        
    });