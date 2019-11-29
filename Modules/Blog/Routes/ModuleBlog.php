<?php

//TODO hacer una copia de esta ruta y pegarla dentro del directorio de rutas WEBSITE_PUBLIC
Route::group([
    'namespace' => '\Modules\Blog\Http\Controllers',
    'prefix' => '/web/'
], function () {

    Route::get('/blog', [
        'as' => 'web.blog',
        'uses' => 'PageController@blog'
    ]);

    Route::get('post/{slug}', [
        'as' => 'web.blog.post',
        'uses' => 'PageController@post'
    ]);

    Route::get('category/{slug}', [
        'as' => 'web.blog.category',
        'uses' => 'PageController@category'
    ]);

    Route::get('tag/{slug}', [
        'as' => 'web.blog.tag',
        'uses' => 'PageController@tag'
    ]);

    Route::post('save/comment', [
        'as' => 'web.save.comment',
        'uses' => 'PageController@saveComment'
    ]);
});


