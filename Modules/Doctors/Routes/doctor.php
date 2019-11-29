<?php

//TODO ROUTE ADMIN
Route::group([
    //'middleware' => ['auth'],
    'prefix' => '/doctors/doctor',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'doctors.doctor.list',
        'uses' => 'DoctorController@list',
    ]);
    Route::get('/create', [
        'as' => 'doctors.doctor.create',
        'uses' => 'DoctorController@create',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'doctors.doctor.edit',
        'uses' => 'DoctorController@edit',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'doctors.doctor.list.all',
        'uses' => 'DoctorController@listAll',
    ]);
    Route::get('/list/active', [
        'as' => 'doctors.doctor.list.active',
        'uses' => 'DoctorController@listActive',
    ]);
    Route::get('/findbyunique/{item}/{string}', [
        'as' => 'doctors.doctor.findbyunique',
        'uses' => 'DoctorController@findbyunique',
    ]);

    Route::post('/change/status', [
        'as' => 'doctors.doctor.change.status',
        'uses' => 'DoctorController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'doctors.doctor.delete',
        'uses' => 'DoctorController@delete',
    ]);

    Route::post('/store', [
        'as' => 'doctors.doctor.store',
        'uses' => 'DoctorController@store',
    ]);

    Route::post('/consult', [
        'as' => 'doctors.doctor.consult',
        'uses' => 'DoctorController@consult',
    ]);

    Route::post('/update', [
        'as' => 'doctors.doctor.update',
        'uses' => 'DoctorController@update',
    ]);

});

