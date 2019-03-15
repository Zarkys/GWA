<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//LANDING PAGE ROUTES
Route::get('/', 'LandingController@index')->name('index');

Route::get('/conocenos', 'LandingController@know')->name('know');
Route::get('/catalogo', 'LandingController@catalog')->name('catalog');
Route::get('/catalogo/{idelement}', 'LandingController@catalog_detail')->name('catalog_detail');

Route::get('/contacto', 'LandingController@contact')->name('contact');

Route::get('/changue_lang/{lang}', [
    'as'   => 'api.changue.lang',
    'uses' => 'LandingController@changue_lang',
]);

