<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'archive/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.archive',
            'uses' => 'Api\ArchiveController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.archive',
            'uses' => 'Api\ArchiveController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.archive.find',
            'uses' => 'Api\ArchiveController@find',
        ]);
        Route::post('/', [
            'as'   => 'api.archive.save',
            'uses' => 'Api\ArchiveController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.archive.update',
            'uses' => 'Api\ArchiveController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.archive.delete',
            'uses' => 'Api\ArchiveController@delete',
        ]);
        
    });