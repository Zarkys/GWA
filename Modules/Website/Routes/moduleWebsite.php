<?php

//TODO hacer una copia de esta ruta y pegarla dentro del directorio de rutas WEBSITE_PUBLIC
Route::group([
    'namespace' => '\Modules\Website\Http\Controllers',
], function () {

    Route::get('/web/website/text/filterby/{item}/{id}', [
        'as' => 'web.website.text.filterby',
        'uses' => 'WebController@filterby',
    ]);

    Route::post('/web/website/text/filter/by', [
        'as' => 'web.website.text.filter.by.post',
        'uses' => 'WebController@filterby_post',
    ]);

});

