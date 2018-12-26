<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
        'middleware' => [
            'api',
        ],
        'prefix'     => 'postcategory/',
    ], function () {
        
        Route::get('/', [
            'as'   => 'api.post.category',
            'uses' => 'Api\PostCategoryController@index',
        ]);
        Route::get('/active', [
            'as'   => 'api.post.category',
            'uses' => 'Api\PostCategoryController@indexactive',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.post.category.find',
            'uses' => 'Api\PostCategoryController@find',
        ]);
        Route::get('/filterby/{item}/{id}', [
            'as'   => 'api.post.category.filterby',
            'uses' => 'Api\PostCategoryController@filterby',
        ]);
        Route::post('/', [
            'as'   => 'api.post.category.save',
            'uses' => 'Api\PostCategoryController@save',
        ]);
        Route::put('/{id}', [
            'as'   => 'api.post.category.update',
            'uses' => 'Api\PostCategoryController@update',
        ]);
        Route::delete('/{id}', [
            'as'   => 'api.post.category.delete',
            'uses' => 'Api\PostCategoryController@delete',
        ]);
        
    });