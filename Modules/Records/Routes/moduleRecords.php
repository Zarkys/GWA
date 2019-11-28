<?php

//TODO hacer una copia de esta ruta y pegarla dentro del directorio de rutas WEBSITE_PUBLIC
Route::group([
    'namespace' => '\Modules\Records\Http\Controllers',
    'prefix' => '/web/'
], function () {

    Route::get('/records/list', [
        'as' => 'web.records.list',
        'uses' => 'WebController@list',
    ]);

});



