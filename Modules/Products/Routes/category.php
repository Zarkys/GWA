<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/product/category',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'product.category.list',
        'uses' => 'CategoryController@list',
    ]);

    Route::get('/create', [
        'as' => 'product.category.create',
        'uses' => 'CategoryController@create',
    ]);

    Route::get('/edit/{id}', [
        'as' => 'product.category.edit',
        'uses' => 'CategoryController@edit',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'product.category.list.all',
        'uses' => 'CategoryController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'product.category.change.status',
        'uses' => 'CategoryController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'product.category.delete',
        'uses' => 'CategoryController@delete',
    ]);

    Route::post('/store', [
        'as' => 'product.category.store',
        'uses' => 'CategoryController@store',
    ]);

    Route::post('/consult', [
        'as' => 'product.category.consult',
        'uses' => 'CategoryController@consult',
    ]);

    Route::post('/update', [
        'as' => 'product.category.update',
        'uses' => 'CategoryController@update',
    ]);

});