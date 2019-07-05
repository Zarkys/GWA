<?php

Route::group([
    'middleware' => ['auth'],
], function () {

    Route::get('/blog', [
        'as' => 'blog.index',
        'uses' => 'BlogController@index'
    ]);

});
