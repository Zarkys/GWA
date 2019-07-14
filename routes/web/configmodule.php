<?php
    
    use Illuminate\Http\Request;
   
    Route::group([
          'middleware' => ['auth'],
        'prefix'     => '/api/1.0/configmodule/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.config.module',
            'uses' => 'Api\ConfigModuleController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.config.module.filteractive',
            'uses' => 'Api\ConfigModuleController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.config.module.filterinactive',
            'uses' => 'Api\ConfigModuleController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.config.module.filterdeleted',
            'uses' => 'Api\ConfigModuleController@filterdeleted',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.config.module.filterby',
            'uses' => 'Api\ConfigModuleController@filterby',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.config.module.findbyid',
            'uses' => 'Api\ConfigModuleController@findbyid',
        ]);
        Route::get('/findbyunique/{item}/{string}', [
            'as'   => 'api.config.module.findbyunique',
            'uses' => 'Api\ConfigModuleController@findbyunique',
        ]);
        Route::post('/', [
            'as'   => 'api.config.module.save',
            'uses' => 'Api\ConfigModuleController@save',
        ]);
        Route::put('/change/{id}', [
            'as'   => 'api.config.module.change',
            'uses' => 'Api\ConfigModuleController@change',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.config.module.update',
            'uses' => 'Api\ConfigModuleController@update',
        ]);
      
      
        Route::delete('/{id}', [
            'as'   => 'api.config.module.delete',
            'uses' => 'Api\ConfigModuleController@delete',
        ]);
        
    });