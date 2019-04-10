<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        //  'middleware' => ['auth'],
        'prefix'     => '/api/1.0/page/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.page',
            'uses' => 'Api\PageController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.page.filteractive',
            'uses' => 'Api\PageController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.page.filterinactive',
            'uses' => 'Api\PageController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.page.filterdeleted',
            'uses' => 'Api\PageController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.page.findbyid',
            'uses' => 'Api\PageController@findbyid',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.page.filterby',
            'uses' => 'Api\PageController@filterby',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.page.findbyunique',
            'uses' => 'Api\PageController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.page.save',
            'uses' => 'Api\PageController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.page.update',
            'uses' => 'Api\PageController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.page.activate',
            'uses' => 'Api\PageController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.page.inactivate',
            'uses' => 'Api\PageController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.page.delete',
            'uses' => 'Api\PageController@delete',
        ]);
        
    });