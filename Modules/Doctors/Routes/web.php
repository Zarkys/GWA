<?php

Route::group([
    'middleware' => ['auth'],
], function () {

    Route::get('/doctors', [
        'as' => 'doctors.index',
        'uses' => 'DoctorController@index'
    ]);

});
