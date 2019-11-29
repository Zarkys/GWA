<?php

//TODO hacer una copia de esta ruta y pegarla dentro del directorio de rutas WEBSITE_PUBLIC
Route::group([
    'namespace' => '\Modules\Products\Http\Controllers',
    'prefix' => '/web/'
], function () {

    Route::get('/products/list', [
        'as' => 'web.product.index',
        'uses' => 'WebController@productsAll',
    ]);

    Route::get('/category/slug/{slug}', [
        'as' => 'web.product.category.slug',
        'uses' => 'WebController@categorySlug',
    ]);

});

