<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/blog/tag',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'blog.tag.list',
        'uses' => 'TagController@list',
    ]);
    Route::get('/create', [
        'as' => 'blog.tag.create',
        'uses' => 'TagController@create',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'blog.tag.edit',
        'uses' => 'TagController@edit',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'blog.tag.list.all',
        'uses' => 'TagController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'blog.tag.change.status',
        'uses' => 'TagController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'blog.tag.delete',
        'uses' => 'TagController@delete',
    ]);

    Route::post('/store', [
        'as' => 'blog.tag.store',
        'uses' => 'TagController@store',
    ]);

    Route::post('/consult', [
        'as' => 'blog.tag.consult',
        'uses' => 'TagController@consult',
    ]);

    Route::post('/update', [
        'as' => 'blog.tag.update',
        'uses' => 'TagController@update',
    ]);

});

//TODO ROUTES OLD

//    use Illuminate\Http\Request;
//
//    Route::group([
//        'middleware' => ['auth'],
//        'prefix'     => '/api/1.0/tag/',
//    ], function () {
//
//        Route::get('/', [
//            'as'   => 'api.tag',
//            'uses' => 'Api\TagController@index',
//        ]);
//        Route::get('/active', [
//            'as'   => 'api.tag.filteractive',
//            'uses' => 'Api\TagController@filteractive',
//        ]);
//        Route::get('/inactive', [
//            'as'   => 'api.tag.filterinactive',
//            'uses' => 'Api\TagController@filterinactive',
//        ]);
//        Route::get('/deleted', [
//            'as'   => 'api.tag.filterdeleted',
//            'uses' => 'Api\TagController@filterdeleted',
//        ]);
//        Route::get('/{id}', [
//            'as'   => 'api.tag.findbyid',
//            'uses' => 'Api\TagController@findbyid',
//        ]);
//        Route::get('/findbyunique/{item}/{string}', [
//            'as'   => 'api.tag.findbyunique',
//            'uses' => 'Api\TagController@findbyunique',
//        ]);
//        Route::post('/', [
//            'as'   => 'api.tag.save',
//            'uses' => 'Api\TagController@save',
//        ]);
//        Route::put('/{id}', [
//            'as'   => 'api.tag.update',
//            'uses' => 'Api\TagController@update',
//        ]);
//        Route::delete('/change/active/{id}', [
//            'as'   => 'api.tag.activate',
//            'uses' => 'Api\TagController@activate',
//        ]);
//        Route::delete('/change/inactive/{id}', [
//            'as'   => 'api.tag.inactivate',
//            'uses' => 'Api\TagController@inactivate',
//        ]);
//        Route::delete('/change/delete/{id}', [
//            'as'   => 'api.tag.delete',
//            'uses' => 'Api\TagController@delete',
//        ]);
//
//    });