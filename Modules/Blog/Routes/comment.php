<?php

//TODO ROUTE ADMIN
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/blog/comment',
], function () {

    //TODO VIEWS
    Route::get('/list', [
        'as' => 'blog.comment.list',
        'uses' => 'CommentController@list',
    ]);

    //TODO CRUD
    Route::get('/list/all', [
        'as' => 'blog.comment.list.all',
        'uses' => 'CommentController@listAll',
    ]);

    Route::post('/change/status', [
        'as' => 'blog.comment.change.status',
        'uses' => 'CommentController@changeStatus',
    ]);

});