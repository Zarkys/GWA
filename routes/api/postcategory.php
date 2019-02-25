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
            'as'   => 'api.post.category.filteractive',
            'uses' => 'Api\PostCategoryController@filteractive',
        ]);
        Route::get('/inactive', [
            'as'   => 'api.post.category.filterinactive',
            'uses' => 'Api\PostCategoryController@filterinactive',
        ]);
        Route::get('/deleted', [
            'as'   => 'api.post.category.filterdeleted',
            'uses' => 'Api\PostCategoryController@filterdeleted',
        ]);
        Route::get('/{id}', [
            'as'   => 'api.post.category.findbyid',
            'uses' => 'Api\PostCategoryController@findbyid',
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
        Route::delete('/change/inactive/{id}', [
            'as'   => 'api.post.category.inactivate',
            'uses' => 'Api\PostCategoryController@inactivate',
        ]);
        Route::delete('/change/active/{id}', [
            'as'   => 'api.post.category.activate',
            'uses' => 'Api\PostCategoryController@activate',
        ]);
        Route::delete('/change/delete/{id}', [
            'as'   => 'api.post.category.delete',
            'uses' => 'Api\PostCategoryController@delete',
        ]);
        
    });