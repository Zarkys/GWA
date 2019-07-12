<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/website/section',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'website.section.list',
        'uses' => 'SectionController@list',
    ]);
    Route::get('/create', [
        'as' => 'website.section.create',
        'uses' => 'SectionController@create',
    ]);
    Route::get('/edit/{id}', [
        'as' => 'website.section.edit',
        'uses' => 'SectionController@edit',
    ]);

    //TODO CRUD
    Route::post('/store', [
        'as' => 'website.section.store',
        'uses' => 'SectionController@store',
    ]);

    Route::get('/list/all', [
        'as' => 'website.section.list.all',
        'uses' => 'SectionController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'website.section.change.status',
        'uses' => 'SectionController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'website.section.delete',
        'uses' => 'SectionController@delete',
    ]);

    Route::post('/consult', [
        'as' => 'website.section.consult',
        'uses' => 'SectionController@consult',
    ]);

    Route::post('/update', [
        'as' => 'website.section.update',
        'uses' => 'SectionController@update',
    ]);

});