<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/library',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'library.archive.list',
        'uses' => 'LibraryController@list',
    ]);

    //TODO CRUD
    Route::post('/list/all', [
        'as' => 'library.archive.list.all',
        'uses' => 'LibraryController@listAll',
    ]);

    Route::post('/load/item', [
        'as' => 'library.archive.load.item',
        'uses' => 'LibraryController@loadItem',
    ]);

    Route::post('/item/delete', [
        'as' => 'library.archive.item.delete',
        'uses' => 'LibraryController@itemDelete',
    ]);

});