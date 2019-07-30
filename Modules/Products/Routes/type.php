<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/product/type',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'product.type.list',
        'uses' => 'TypeController@list',
    ]);

    Route::get('/create', [
        'as' => 'product.type.create',
        'uses' => 'TypeController@create',
    ]);

    Route::get('/edit/{id}', [
        'as' => 'product.type.edit',
        'uses' => 'TypeController@edit',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'product.type.list.all',
        'uses' => 'TypeController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'product.type.change.status',
        'uses' => 'TypeController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'product.type.delete',
        'uses' => 'TypeController@delete',
    ]);

    Route::post('/store', [
        'as' => 'product.type.store',
        'uses' => 'TypeController@store',
    ]);

    Route::post('/consult', [
        'as' => 'product.type.consult',
        'uses' => 'TypeController@consult',
    ]);

    Route::post('/update', [
        'as' => 'product.type.update',
        'uses' => 'TypeController@update',
    ]);

});