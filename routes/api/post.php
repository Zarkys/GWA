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
            'as'   => 'api.post.filteractive',
            'uses' => 'Api\PostController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.post.filterinactive',
            'uses' => 'Api\PostController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.post.filterdeleted',
            'uses' => 'Api\PostController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.post.findbyid',
            'uses' => 'Api\PostController@findbyid',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.post.filterby',
            'uses' => 'Api\PostController@filterby',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.post.findbyunique',
            'uses' => 'Api\PostController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.post.save',
            'uses' => 'Api\PostController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.post.update',
            'uses' => 'Api\PostController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.post.activate',
            'uses' => 'Api\PostController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.post.inactivate',
            'uses' => 'Api\PostController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.post.delete',
            'uses' => 'Api\PostController@delete',
        ]);
        
    });