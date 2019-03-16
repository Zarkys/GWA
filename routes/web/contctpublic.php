<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
      
       'prefix'     => '/api/1.0/contact/',
    ], function () {
        
        Route::post('/', [
            'as'   => 'api.contact.save',
            'uses' => 'Api\ContactController@save',
        ]);
        
    });