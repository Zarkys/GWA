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
            'as'   => 'api.archiveassignment.filteractive',
            'uses' => 'Api\ArchiveAssignmentController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.archiveassignment.filterinactive',
            'uses' => 'Api\ArchiveAssignmentController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.archiveassignment.filterdeleted',
            'uses' => 'Api\ArchiveAssignmentController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.archiveassignment.findbyid',
            'uses' => 'Api\ArchiveAssignmentController@findbyid',
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
        Route::delete('/change/active/{id}', [
            'as'   => 'api.archiveassignment.activate',
            'uses' => 'Api\ArchiveAssignmentController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.archiveassignment.inactivate',
            'uses' => 'Api\ArchiveAssignmentController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.archiveassignment.delete',
            'uses' => 'Api\ArchiveAssignmentController@delete',
        ]);
        
    });