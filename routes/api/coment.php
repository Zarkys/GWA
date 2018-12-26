<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'coment/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.coment',
            'uses' => 'Api\ComentController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.coment',
            'uses' => 'Api\ComentController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.coment.find',
            'uses' => 'Api\ComentController@find',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.coment.filterby',
            'uses' => 'Api\ComentController@filterby',
        ]);
        Route::post('/', [
            'as'   => 'api.coment.save',
            'uses' => 'Api\ComentController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.coment.update',
            'uses' => 'Api\ComentController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.coment.delete',
            'uses' => 'Api\ComentController@delete',
        ]);
        
    });