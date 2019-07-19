<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/website/text',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'website.text.list',
        'uses' => 'TextController@list',
    ]);
    Route::get('/create', [
        'as' => 'website.text.create',
        'uses' => 'TextController@create',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'website.text.edit',
        'uses' => 'TextController@edit',
    ]);

    //TODO CRUD
    Route::post('/store', [
        'as' => 'website.text.store',
        'uses' => 'TextController@store',
    ]);

    Route::get('/list/all', [
        'as' => 'website.text.list.all',
        'uses' => 'TextController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'website.text.change.status',
        'uses' => 'TextController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'website.text.delete',
        'uses' => 'TextController@delete',
    ]);

    Route::post('/consult', [
        'as' => 'website.text.consult',
        'uses' => 'TextController@consult',
    ]);

    Route::post('/update', [
        'as' => 'website.text.update',
        'uses' => 'TextController@update',
    ]);

});