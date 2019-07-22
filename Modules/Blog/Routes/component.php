<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/blog/component',
], function () {

    Route::get('/list', [
        'as' => 'blog.component.list',
        'uses' => 'ComponentController@list',
    ]);

});
