<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'page/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.page',
            'uses' => 'Api\PageController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.page',
            'uses' => 'Api\PageController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.page.find',
            'uses' => 'Api\PageController@find',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.page.filterby',
            'uses' => 'Api\PageController@filterby',
        ]);
        Route::post('/', [
            'as'   => 'api.page.save',
            'uses' => 'Api\PageController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.page.update',
            'uses' => 'Api\PageController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.page.delete',
            'uses' => 'Api\PageController@delete',
        ]);
        
    });