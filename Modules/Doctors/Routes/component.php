<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/doctors/component',
], function () {

    Route::get('/list', [
        'as' => 'doctors.component.list',
        'uses' => 'ComponentController@list',
    ]);

});