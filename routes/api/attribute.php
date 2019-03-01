<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'attribute/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.attribute',
            'uses' => 'Api\AttributeController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.attribute.filteractive',
            'uses' => 'Api\AttributeController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.attribute.filterinactive',
            'uses' => 'Api\AttributeController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.attribute.filterdeleted',
            'uses' => 'Api\AttributeController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.attribute.findbyid',
            'uses' => 'Api\AttributeController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.attribute.findbyunique',
            'uses' => 'Api\AttributeController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.attribute.save',
            'uses' => 'Api\AttributeController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.attribute.update',
            'uses' => 'Api\AttributeController@update',
        ]);     
        Route::put('/change/{id}', [
            'as'   => 'api.attribute.change',
            'uses' => 'Api\AttributeController@change',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.attribute.delete',
            'uses' => 'Api\AttributeController@delete',
        ]);
        
    });