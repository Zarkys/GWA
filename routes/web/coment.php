<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
          'middleware' => ['auth'],
        'prefix'     => '/api/1.0/coment/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.coment',
            'uses' => 'Api\ComentController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.coment.filteractive',
            'uses' => 'Api\ComentController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.coment.filterinactive',
            'uses' => 'Api\ComentController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.coment.filterdeleted',
            'uses' => 'Api\ComentController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.coment.findbyid',
            'uses' => 'Api\ComentController@findbyid',
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
        Route::delete('/change/active/{id}', [
            'as'   => 'api.coment.activate',
            'uses' => 'Api\ComentController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.coment.inactivate',
            'uses' => 'Api\ComentController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.coment.delete',
            'uses' => 'Api\ComentController@delete',
        ]);
        
    });