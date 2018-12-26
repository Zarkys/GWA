<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'post/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.post',
            'uses' => 'Api\PostController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.post',
            'uses' => 'Api\PostController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.post.find',
            'uses' => 'Api\PostController@find',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.post.filterby',
            'uses' => 'Api\PostController@filterby',
        ]);
        Route::post('/', [
            'as'   => 'api.post.save',
            'uses' => 'Api\PostController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.post.update',
            'uses' => 'Api\PostController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.post.delete',
            'uses' => 'Api\PostController@delete',
        ]);
        
    });