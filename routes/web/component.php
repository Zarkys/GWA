<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/component',
], function () {

    Route::get('/list', [
        'as' => 'component.list',
        'uses' => 'ComponentController@list',
    ]);

});