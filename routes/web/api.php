<?php
    
    use Illuminate\Http\Request;
    
    Route::group([
          'middleware' => ['auth'],
        'prefix'     => 'app/',
    ], function () {
        
        Route::post('device', [
            'as'   => 'api.device',
            'uses' => 'Api\ApiController@device',
        ]);
        
        Route::post('event', [
            'as'   => 'api.event',
            'uses' => 'Api\ApiController@event',
        ]);
        
//        Route::post('associate/event_device', [
//            'as'   => 'api.event',
//            'uses' => 'Api\ApiController@associate_event_device',
//        ]);
        
    });
        

        
    
