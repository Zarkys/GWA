<?php

Route::post('/web/sliders/list', [
    'as' => 'web.slider.list',
    'uses' => 'WebController@list',
]);