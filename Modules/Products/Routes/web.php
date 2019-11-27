<?php

Route::group([
    'prefix' => '/products',
], function () {

    Route::get('/', [
        'as' => 'products.index',
        'uses' => 'WebController@index',
    ]);

});
