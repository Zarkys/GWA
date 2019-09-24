<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/website/image',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'website.image.list',
        'uses' => 'ImageController@list',
    ]);
    Route::get('/create', [
        'as' => 'website.image.create',
        'uses' => 'ImageController@create',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'website.image.edit',
        'uses' => 'ImageController@edit',
    ]);

    //TODO CRUD
    Route::post('/store', [
        'as' => 'website.image.store',
        'uses' => 'ImageController@store',
    ]);

    Route::get('/list/all', [
        'as' => 'website.image.listAll',
        'uses' => 'ImageController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'website.image.change.status',
        'uses' => 'ImageController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'website.image.delete',
        'uses' => 'ImageController@delete',
    ]);

    Route::post('/consult', [
        'as' => 'website.image.consult',
        'uses' => 'ImageController@consult',
    ]);

    Route::post('/update', [
        'as' => 'website.image.update',
        'uses' => 'ImageController@update',
    ]);

    //TODO CONSULT RESOURCES - PRODUCT
    Route::get('/resources/active', [
        'as' => 'website.image.resources.active',
        'uses' => 'ImageController@resourcesActive',
    ]);

});