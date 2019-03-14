<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'configweb/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.config.web',
            'uses' => 'Api\ConfigWebController@index',
        ]);
        Route::get('counters/', [
            'as'   => 'api.config.web',
            'uses' => 'Api\ConfigWebController@counters',
        ]);
        Route::get('/active', [
            'as'   => 'api.config.web.filteractive',
            'uses' => 'Api\ConfigWebController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.config.web.filterinactive',
            'uses' => 'Api\ConfigWebController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.config.web.filterdeleted',
            'uses' => 'Api\ConfigWebController@filterdeleted',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.config.web.filterby',
            'uses' => 'Api\ConfigWebController@filterby',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.config.web.findbyid',
            'uses' => 'Api\ConfigWebController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.config.web.findbyunique',
            'uses' => 'Api\ConfigWebController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.config.web.save',
            'uses' => 'Api\ConfigWebController@save',
        ]);
        Route::put('/change/{id}', [
            'as'   => 'api.config.web.change',
            'uses' => 'Api\ConfigWebController@change',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.config.web.update',
            'uses' => 'Api\ConfigWebController@update',
        ]);
      
      
        Route::delete('/{id}', [
            'as'   => 'api.config.web.delete',
            'uses' => 'Api\ConfigWebController@delete',
        ]);
        
    });