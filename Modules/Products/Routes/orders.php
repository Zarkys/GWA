<?php

Route::group([
    'middleware' => ['auth'],
    'prefix' => '/order',
], function () {

    //TODO VIEWS
    Route::get('/list/pending', [
        'as' => 'order.list.pending',
        'uses' => 'OrdersController@listPending',
    ]);

    Route::get('/list/attended', [
        'as' => 'order.list.attended',
        'uses' => 'OrdersController@listAttended',
    ]);

    //TODO ORDERS
    Route::post('/list/all/status', [
        'as' => 'order.list.all.status',
        'uses' => 'OrdersController@listAll_status',
    ]);

    Route::post('/order/attended', [
        'as' => 'order.attended',
        'uses' => 'OrdersController@attendedOrder',
    ]);

    Route::post('/cancel', [
        'as' => 'order.cancel',
        'uses' => 'OrdersController@cancelOrder',
    ]);

    //TODO DETAILS
    Route::post('/cant/details', [
        'as' => 'order.cant.details',
        'uses' => 'OrdersController@cantDetails',
    ]);

    Route::post('/cancel/details', [
        'as' => 'order.cancel.details',
        'uses' => 'OrdersController@cancelDetails',
    ]);

});