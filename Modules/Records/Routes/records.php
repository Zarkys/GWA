<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/records',
], function () {

    //TODO VIEWS
    Route::get('/create', [
        'as' => 'records.archive.create',
        'uses' => 'ArchiveController@create',
    ]);

    //TODO CRUD
    Route::post('/store', [
        'as' => 'records.archive.store',
        'uses' => 'ArchiveController@store',
    ]);

});