<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/blog/category',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'blog.category.list',
        'uses' => 'CategoryController@list',
    ]);

    Route::get('/create', [
        'as' => 'blog.category.create',
        'uses' => 'CategoryController@create',
    ]);

    Route::get('/edit/{id}', [
        'as' => 'blog.category.edit',
        'uses' => 'CategoryController@edit',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'blog.category.list.all',
        'uses' => 'CategoryController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'blog.category.change.status',
        'uses' => 'CategoryController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'blog.category.delete',
        'uses' => 'CategoryController@delete',
    ]);

    Route::post('/store', [
        'as' => 'blog.category.store',
        'uses' => 'CategoryController@store',
    ]);

    Route::post('/consult', [
        'as' => 'blog.category.consult',
        'uses' => 'CategoryController@consult',
    ]);

    Route::post('/update', [
        'as' => 'blog.category.update',
        'uses' => 'CategoryController@update',
    ]);

//    TODO OLD
//    Route::get('/active', [
//        'as' => 'api.category.filteractive',
//        'uses' => 'Api\CategoryController@filteractive',
//    ]);
//    Route::get('/inactive', [
//        'as' => 'api.category.filterinactive',
//        'uses' => 'Api\CategoryController@filterinactive',
//    ]);
//    Route::get('/deleted', [
//        'as' => 'api.category.filterdeleted',
//        'uses' => 'Api\CategoryController@filterdeleted',
//    ]);
//    Route::get('/{id}', [
//        'as' => 'api.category.findbyid',
//        'uses' => 'CategoryController@findbyid',
//    ]);
//    Route::get('/findbyunique/{item}/{string}', [
//        'as' => 'api.category.findbyunique',
//        'uses' => 'Api\CategoryController@findbyunique',
//    ]);
//    Route::get('/filterby/{item}/{id}', [
//        'as' => 'api.category.filterby',
//        'uses' => 'Api\CategoryController@filterby',
//    ]);
//    Route::put('/{id}', [
//        'as' => 'api.category.update',
//        'uses' => 'Api\CategoryController@update',
//    ]);

//    Route::delete('/change/delete/{id}', [
//        'as' => 'api.category.delete',
//        'uses' => 'Api\CategoryController@delete',
//    ]);

});