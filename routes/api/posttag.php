<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'posttag/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.post.tag',
            'uses' => 'Api\PostTagController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.post.tag',
            'uses' => 'Api\PostTagController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.post.tag.find',
            'uses' => 'Api\PostTagController@find',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.post.tag.filterby',
            'uses' => 'Api\PostTagController@filterby',
        ]);
        Route::post('/', [
            'as'   => 'api.post.tag.save',
            'uses' => 'Api\PostTagController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.post.tag.update',
            'uses' => 'Api\PostTagController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.post.tag.delete',
            'uses' => 'Api\PostTagController@delete',
        ]);
        
    });