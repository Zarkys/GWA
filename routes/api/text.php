<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'text/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.text',
            'uses' => 'Api\TextController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.text.filteractive',
            'uses' => 'Api\TextController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.text.filterinactive',
            'uses' => 'Api\TextController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.text.filterdeleted',
            'uses' => 'Api\TextController@filterdeleted',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.text.filterby',
            'uses' => 'Api\TextController@filterby',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.text.findbyid',
            'uses' => 'Api\TextController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.text.findbyunique',
            'uses' => 'Api\TextController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.text.save',
            'uses' => 'Api\TextController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.text.update',
            'uses' => 'Api\TextController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.text.activate',
            'uses' => 'Api\TextController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.text.inactivate',
            'uses' => 'Api\TextController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.text.delete',
            'uses' => 'Api\TextController@delete',
        ]);
        
    });