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


Route::get('/goadmin', 'HomeController@login')->name('login');




//ADMIN
Route::get('/home', 'HomeController@home')->name('home');
//ADMIN - BLOG
Route::get('/posts', 'HomeController@posts')->name('posts');
Route::get('/pages', 'HomeController@pages')->name('pages');
Route::get('/comments', 'HomeController@comments')->name('comments');
//ADMIN - CATALOG
Route::get('/products', 'HomeController@products')->name('products');
Route::get('/typeproducts', 'HomeController@typeproducts')->name('typeproducts');
Route::get('/attributes', 'HomeController@attributes')->name('attributes');
Route::get('/texts', 'HomeController@texts')->name('texts');
//USER
Route::get('/profile', 'HomeController@profile')->name('profile');


//LANDING PAGE ROUTES
Route::get('/', 'LandingController@index')->name('index');


