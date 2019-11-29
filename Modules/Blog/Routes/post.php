<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/blog/post',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'blog.post.list',
        'uses' => 'PostController@list',
    ]);
    Route::get('/create', [
        'as' => 'blog.post.create',
        'uses' => 'PostController@create',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'blog.post.edit',
        'uses' => 'PostController@edit',
    ]);

    //TODO CRUD
    Route::post('/store', [
        'as' => 'blog.post.store',
        'uses' => 'PostController@store',
    ]);

    Route::get('/list/all', [
        'as' => 'blog.post.list.all',
        'uses' => 'PostController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'blog.post.change.status',
        'uses' => 'PostController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'blog.post.delete',
        'uses' => 'PostController@delete',
    ]);

    Route::post('/consult', [
        'as' => 'blog.post.consult',
        'uses' => 'PostController@consult',
    ]);

    Route::post('/update', [
        'as' => 'blog.post.update',
        'uses' => 'PostController@update',
    ]);

});

//TODO OLD

//    Route::group([
//         // 'middleware' => ['auth'],
//        'prefix'     => '/api/1.0/post/',
//    ], function () {
//
//        Route::get('/', [
//            'as'   => 'api.post',
//            'uses' => 'Api\PostController@index',
//        ]);
//        Route::get('/active', [
//            'as'   => 'api.post.filteractive',
//            'uses' => 'Api\PostController@filteractive',
//        ]);
//        Route::get('/inactive', [
//            'as'   => 'api.post.filterinactive',
//            'uses' => 'Api\PostController@filterinactive',
//        ]);
//        Route::get('/deleted', [
//            'as'   => 'api.post.filterdeleted',
//            'uses' => 'Api\PostController@filterdeleted',
//        ]);
//        Route::get('/{id}', [
//            'as'   => 'api.post.findbyid',
//            'uses' => 'Api\PostController@findbyid',
//        ]);
//        Route::get('/filterby/{item}/{id}', [
//            'as'   => 'api.post.filterby',
//            'uses' => 'Api\PostController@filterby',
//        ]);
//        Route::get('/findbyunique/{item}/{string}', [
//            'as'   => 'api.post.findbyunique',
//            'uses' => 'Api\PostController@findbyunique',
//        ]);

//        Route::put('/{id}', [
//            'as'   => 'api.post.update',
//            'uses' => 'Api\PostController@update',
//        ]);
//        Route::delete('/change/active/{id}', [
//            'as'   => 'api.post.activate',
//            'uses' => 'Api\PostController@activate',
//        ]);
//        Route::delete('/change/inactive/{id}', [
//            'as'   => 'api.post.inactivate',
//            'uses' => 'Api\PostController@inactivate',
//        ]);
//        Route::delete('/change/delete/{id}', [
//            'as'   => 'api.post.delete',
//            'uses' => 'Api\PostController@delete',
//        ]);
//
//    });