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
    Route::group([
        'middleware' => ['auth'],
    ], function () {
        
        //ADMIN
        Route::get('/home', [
            'as'   => 'admin.home',
            'uses' => 'HomeController@home',
        ]);
        //ADMIN - BLOG
        Route::get('/posts', 'HomeController@posts')->name('posts');
        Route::get('/pages', 'HomeController@pages')->name('pages');
        Route::get('/comments', 'HomeController@comments')->name('comments');
        //ADMIN - CATALOG
        Route::get('/products', 'HomeController@products')->name('products');
        Route::get('/products/new', 'HomeController@productsnew')->name('productsnew');
        Route::get('/products/update/{idelement}', 'HomeController@productsupdate')->name('productsupdate');
        //ADMIN - TYPE PRODUCTS
        Route::get('/typeproducts', 'HomeController@typeproducts')->name('typeproducts');
        Route::get('/typeproducts/new', 'HomeController@typeproductsnew')->name('typeproductsnew');
        Route::get('/typeproducts/update/{idelement}', 'HomeController@typeproductsupdate')->name('typeproductsupdate');
        //ADMIN - ATTRIBUTES
        Route::get('/attributes', 'HomeController@attributes')->name('attributes');
        Route::get('/attributes/new', 'HomeController@attributesnew')->name('attributesnew');
        Route::get('/attributes/update/{idelement}', 'HomeController@attributesupdate')->name('attributesupdate');
        //ADMIN - TEXTS
        Route::get('/texts', 'HomeController@texts')->name('texts');
        Route::get('/texts/new', 'HomeController@textsnew')->name('textsnew');
        Route::get('/texts/update/{idelement}', 'HomeController@textsupdate')->name('textsupdate');
        //ADMIN - SECTIONS
        Route::get('/sections', 'HomeController@sections')->name('sections');
        Route::get('/sections/new', 'HomeController@sectionsnew')->name('sectionsnew');
        Route::get('/sections/update/{idelement}', 'HomeController@sectionsupdate')->name('sectionsupdate');
        //ADMIN - CONFIG
        Route::get('/config', 'HomeController@config')->name('config');
        Route::get('/about', 'HomeController@about')->name('about');
        

        //CONTACTS
        Route::get('/contacts', 'HomeController@contacts')->name('contacts');
         //CONFIGS
        // Route::get('/profile', 'HomeController@config')->name('config');


       
        
    });






