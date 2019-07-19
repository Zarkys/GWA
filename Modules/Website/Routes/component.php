<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/component',
], function () {

    Route::get('/list', [
        'as' => 'website.component.list',
        'uses' => 'ComponentController@list',
    ]);

});