<?php

Route::group([
    'middleware' => ['auth'],
], function () {

    Route::get('/website', [
        'as' => 'website.index',
        'uses' => 'WebsiteController@index'
    ]);

});

