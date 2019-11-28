<?php

//TODO hacer una copia de esta ruta y pegarla dentro del directorio de rutas WEBSITE_PUBLIC
Route::group([
    'namespace' => '\Modules\Sliders\Http\Controllers',
], function () {

    Route::get('/sliders/list', [
        'as' => 'web.slider.list',
        'uses' => 'WebController@list',
    ]);

});



