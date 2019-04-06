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
        //ADMIN - ARCHIVE
        Route::get('/archive_folder', 'HomeController@archive_folder')->name('archive_folder');
        Route::get('/library', 'HomeController@archive')->name('archive');
        Route::get('/archive/new', 'HomeController@archivenew')->name('archivenew');
        Route::get('/archive/update/{idelement}', 'HomeController@archiveupdate')->name('archiveupdate');
        //ADMIN - BLOG
        Route::get('/pages', 'HomeController@pages')->name('pages');
        Route::get('/posts', 'HomeController@posts')->name('posts');
        Route::get('/posts/new', 'HomeController@postnew')->name('postnew');
        Route::get('/posts/update/{idelement}', 'HomeController@postupdate')->name('postupdate');
        //ADMIN - POST-CATEGORY
        Route::get('/categories', 'HomeController@categories')->name('categories');
        Route::get('/categories/new', 'HomeController@categoriesnew')->name('categoriesnew');
        Route::get('/categories/update/{idelement}', 'HomeController@categoriesupdate')->name('categoriesupdate');
         //ADMIN - POST-TAG
        Route::get('/tags', 'HomeController@tags')->name('tags');
        Route::get('/tags/new', 'HomeController@tagsnew')->name('tagsnew');
        Route::get('/tags/update/{idelement}', 'HomeController@tagsupdate')->name('tagsupdate');
        //ADMIN - PAGE-COMMENT
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
        //ADMIN - CATEGORIES FOR PRODUCTS
        Route::get('/categoriesforproducts', 'HomeController@categoriesforproducts')->name('categoriesforproducts');
        Route::get('/categoriesforproducts/new', 'HomeController@categoriesforproductsnew')->name('categoriesforproductsnew');
        Route::get('/categoriesforproducts/update/{idelement}', 'HomeController@categoriesforproductsupdate')->name('categoriesforproductsupdate');
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
        Route::get('/profile', 'HomeController@profile')->name('profile');
        

        //CONTACTS
        Route::get('/contacts', 'HomeController@contacts')->name('contacts');
        //ADMIN - SECTIONS
        Route::get('/users', 'HomeController@users')->name('users');
        Route::get('/users/new', 'HomeController@usersnew')->name('usersnew');
        Route::get('/users/update/{idelement}', 'HomeController@usersupdate')->name('usersupdate');
         //CONFIGS
        // Route::get('/profile', 'HomeController@config')->name('config');


       
        
    });






