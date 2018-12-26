<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'archiveassignment/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.archiveassignment',
            'uses' => 'Api\ArchiveAssignmentController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.archiveassignment',
            'uses' => 'Api\ArchiveAssignmentController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.archiveassignment.find',
            'uses' => 'Api\ArchiveAssignmentController@find',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.archiveassignment.filterby',
            'uses' => 'Api\ArchiveAssignmentController@filterby',
        ]);
        Route::post('/', [
            'as'   => 'api.archiveassignment.save',
            'uses' => 'Api\ArchiveAssignmentController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.archiveassignment.update',
            'uses' => 'Api\ArchiveAssignmentController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.archiveassignment.delete',
            'uses' => 'Api\ArchiveAssignmentController@delete',
        ]);
        
    });