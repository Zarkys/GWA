<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'tag/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.tag',
            'uses' => 'Api\TagController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.tag.filteractive',
            'uses' => 'Api\TagController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.tag.filterinactive',
            'uses' => 'Api\TagController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.tag.filterdeleted',
            'uses' => 'Api\TagController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.tag.findbyid',
            'uses' => 'Api\TagController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.tag.findbyunique',
            'uses' => 'Api\TagController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.tag.save',
            'uses' => 'Api\TagController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.tag.update',
            'uses' => 'Api\TagController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.tag.activate',
            'uses' => 'Api\TagController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.tag.inactivate',
            'uses' => 'Api\TagController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.tag.delete',
            'uses' => 'Api\TagController@delete',
        ]);
        
    });