<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/product',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'product.list',
        'uses' => 'ProductsController@list',
    ]);

    Route::get('/create', [
        'as' => 'product.create',
        'uses' => 'ProductsController@create',
    ]);

    Route::get('/edit/{id}', [
        'as' => 'product.edit',
        'uses' => 'ProductsController@edit',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'product.list.all',
        'uses' => 'ProductsController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'product.change.status',
        'uses' => 'ProductsController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'product.delete',
        'uses' => 'ProductsController@delete',
    ]);

    Route::post('/store', [
        'as' => 'product.store',
        'uses' => 'ProductsController@store',
    ]);

    Route::post('/consult', [
        'as' => 'product.consult',
        'uses' => 'ProductsController@consult',
    ]);

    Route::post('/update', [
        'as' => 'product.update',
        'uses' => 'ProductsController@update',
    ]);


    //TODO PRODUCT IMAGE
    Route::post('/product/image/delete', [
        'as' => 'product.image.delete',
        'uses' => 'ProductsController@imageDelete',
    ]);


    //TODO CONSULT RESOURCES - PRODUCT
    Route::get('/resources/active', [
        'as' => 'product.resources.active',
        'uses' => 'ProductsController@resourcesActive',
    ]);


});
