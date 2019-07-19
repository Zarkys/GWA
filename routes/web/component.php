<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/componentmodule',
], function () {

    Route::get('/list', [
        'as' => 'component.list',
        'uses' => 'Api\ComponentController@list',
    ]);

});