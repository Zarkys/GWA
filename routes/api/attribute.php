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
        Route::delete('/change/active/{id}', [
            'as'   => 'api.attribute.activate',
            'uses' => 'Api\AttributeController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.attribute.inactivate',
            'uses' => 'Api\AttributeController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.attribute.delete',
            'uses' => 'Api\AttributeController@delete',
        ]);
        
    });