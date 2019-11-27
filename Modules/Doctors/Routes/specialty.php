<?php

//TODO ROUTE ADMIN
Route::group([
    // 'middleware' => ['auth'],
    'prefix' => '/doctors/specialty',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'doctors.specialty.list',
        'uses' => 'SpecialtyController@list',
    ]);
    Route::get('/create', [
        'as' => 'doctors.specialty.create',
        'uses' => 'SpecialtyController@create',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'doctors.specialty.edit',
        'uses' => 'SpecialtyController@edit',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'doctors.specialty.list.all',
        'uses' => 'SpecialtyController@listAll',
    ]);
    Route::get('/list/active', [
        'as' => 'doctors.specialty.list.active',
        'uses' => 'SpecialtyController@listActive',
    ]);

    Route::get('/findbyunique/{item}/{string}', [
        'as' => 'doctors.specialty.findbyunique',
        'uses' => 'SpecialtyController@findbyunique',
    ]);

    Route::post('/change/status', [
        'as' => 'doctors.specialty.change.status',
        'uses' => 'SpecialtyController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'doctors.specialty.delete',
        'uses' => 'SpecialtyController@delete',
    ]);

    Route::post('/store', [
        'as' => 'doctors.specialty.store',
        'uses' => 'SpecialtyController@store',
    ]);

    Route::post('/consult', [
        'as' => 'doctors.specialty.consult',
        'uses' => 'SpecialtyController@consult',
    ]);

    Route::post('/update', [
        'as' => 'doctors.specialty.update',
        'uses' => 'SpecialtyController@update',
    ]);

});

