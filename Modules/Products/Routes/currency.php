<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/product/currency',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'product.currency.list',
        'uses' => 'CurrencyController@list',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'product.currency.list.all',
        'uses' => 'CurrencyController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'product.currency.change.status',
        'uses' => 'CurrencyController@changeStatus',
    ]);

    Route::post('/delete', [
        'as' => 'product.currency.delete',
        'uses' => 'CurrencyController@delete',
    ]);
    
});