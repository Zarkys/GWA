<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
          'middleware' => ['auth'],
        'prefix'     => '/api/1.0/contact/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.contact',
            'uses' => 'Api\ContactController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.contact.filteractive',
            'uses' => 'Api\ContactController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.contact.filterinactive',
            'uses' => 'Api\ContactController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.contact.filterdeleted',
            'uses' => 'Api\ContactController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.contact.findbyid',
            'uses' => 'Api\ContactController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.contact.findbyunique',
            'uses' => 'Api\ContactController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.contact.save',
            'uses' => 'Api\ContactController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.contact.update',
            'uses' => 'Api\ContactController@update',
        ]);     
        Route::put('/change/{id}', [
            'as'   => 'api.contact.change',
            'uses' => 'Api\ContactController@change',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.contact.delete',
            'uses' => 'Api\ContactController@delete',
        ]);
        
    });