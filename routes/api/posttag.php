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
            'as'   => 'api.post.tag.filteractive',
            'uses' => 'Api\PostTagController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.post.tag.filterinactive',
            'uses' => 'Api\PostTagController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.post.tag.filterdeleted',
            'uses' => 'Api\PostTagController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.post.tag.findbyid',
            'uses' => 'Api\PostTagController@findbyid',
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
        Route::delete('/change/active/{id}', [
            'as'   => 'api.post.tag.activate',
            'uses' => 'Api\PostTagController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.post.tag.inactivate',
            'uses' => 'Api\PostTagController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.post.tag.delete',
            'uses' => 'Api\PostTagController@delete',
        ]);
        
    });