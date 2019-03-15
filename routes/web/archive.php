<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
          'middleware' => ['auth'],
        'prefix'     => '/api/1.0/archive/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.archive',
            'uses' => 'Api\ArchiveController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.archive.filteractive',
            'uses' => 'Api\ArchiveController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.archive.filterinactive',
            'uses' => 'Api\ArchiveController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.archive.filterdeleted',
            'uses' => 'Api\ArchiveController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.archive.findbyid',
            'uses' => 'Api\ArchiveController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.archive.findbyunique',
            'uses' => 'Api\ArchiveController@findbyunique',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.archive.filterby',
            'uses' => 'Api\ArchiveController@filterby',
        ]);
        Route::post('/', [
            'as'   => 'api.archive.save',
            'uses' => 'Api\ArchiveController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.archive.update',
            'uses' => 'Api\ArchiveController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.archive.activate',
            'uses' => 'Api\ArchiveController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.archive.inactivate',
            'uses' => 'Api\ArchiveController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.archive.delete',
            'uses' => 'Api\ArchiveController@delete',
        ]);
        
    });