<?php

//TODO hacer una copia de esta ruta y pegarla dentro del directorio de rutas WEBSITE_PUBLIC
Route::group([
    'namespace' => '\Modules\Doctors\Http\Controllers',
    'prefix' => '/web/'
], function () {

    Route::get('/doctors/list', [
        'as' => 'web.list.doctors',
        'uses' => 'WebController@listDoctors'
    ]);

    Route::get('/specialty/list', [
        'as' => 'web.list.specialty',
        'uses' => 'WebController@listSpecialty'
    ]);

});


