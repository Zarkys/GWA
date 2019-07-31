<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/attribute',
], function () {

    //TODO CRUD


    Route::post('/store', [
        'as' => 'attribute.store',
        'uses' => 'AttributeController@store',
    ]);

    Route::post('/delete', [
        'as' => 'attribute.delete',
        'uses' => 'AttributeController@delete',
    ]);

});
