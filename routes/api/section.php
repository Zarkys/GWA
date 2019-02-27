<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'section/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.section',
            'uses' => 'Api\SectionController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.section.filteractive',
            'uses' => 'Api\SectionController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.section.filterinactive',
            'uses' => 'Api\SectionController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.section.filterdeleted',
            'uses' => 'Api\SectionController@filterdeleted',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.section.filterby',
            'uses' => 'Api\SectionController@filterby',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.section.findbyid',
            'uses' => 'Api\SectionController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.section.findbyunique',
            'uses' => 'Api\SectionController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.section.save',
            'uses' => 'Api\SectionController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.section.update',
            'uses' => 'Api\SectionController@update',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.section.activate',
            'uses' => 'Api\SectionController@activate',
        ]);
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.section.inactivate',
            'uses' => 'Api\SectionController@inactivate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.section.delete',
            'uses' => 'Api\SectionController@delete',
        ]);
        
    });