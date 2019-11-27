<?php

Route::group([
    'middleware' => [
        'auth',
        'permission:' . \App\Http\Models\Enums\Permissions::$login
    ],
], function () {

    Route::get('/profile/asd', [
        'as' => 'profile.view',
        'uses' => 'Api\ProfileController@profile',
    ]);

    Route::post('/profile/update/password', [
        'as' => 'profile.update.password',
        'uses' => 'Api\ProfileController@updatePassword',
    ]);


});
