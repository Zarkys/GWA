<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/sliders',
], function () {

    //TODO UPLOAD
    Route::get('/image/list', [
        'as' => 'sliders.image.list',
        'uses' => 'ArchiveController@list',
    ]);

    Route::get('/image/create', [
        'as' => 'sliders.image.create',
        'uses' => 'ArchiveController@create',
    ]);

    Route::get('/image/edit/{id}', [
        'as' => 'sliders.image.edit',
        'uses' => 'ArchiveController@edit',
    ]);

    //TODO CRUD
    Route::post('/image/store', [
        'as' => 'sliders.image.store',
        'uses' => 'ArchiveController@store',
    ]);

    Route::post('/consult', [
        'as' => 'sliders.image.consult',
        'uses' => 'ArchiveController@consult',
    ]);

    Route::post('/update', [
        'as' => 'sliders.image.update',
        'uses' => 'ArchiveController@update',
    ]);

    Route::post('/image/list/all', [
        'as' => 'sliders.image.list.all',
        'uses' => 'ArchiveController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'sliders.image.change.status',
        'uses' => 'ArchiveController@changeStatus',
    ]);

    Route::post('/item/delete', [
        'as' => 'sliders.image.item.delete',
        'uses' => 'ArchiveController@itemDelete',
    ]);

});