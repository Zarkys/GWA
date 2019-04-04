<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        
        return view('home');
    }

    public function login()
    {
        return view('login');
    }

    public function posts()
    {
        return view('blog/posts/posts');
    }
    public function postnew()
    {
        return view('blog/posts/post_new');
    }
    public function postupdate()
    {
        return view('blog/posts/post_update');
    }
    //ARCHIVE
    public function archive()
    {
        return view('multimedia/multimedia/archives');
    }
    public function archivenew()
    {
        return view('multimedia/multimedia/archives_new');
    }
    public function archiveupdate()
    {
        return view('multimedia/multimedia/archives_update');
    }
    public function archive_folder()
    {
        return view('multimedia/multimedia/archive_folder');
    }
    //CATEGORY
    public function categories()
    {
        return view('blog/categories/categories');
    }
    public function categoriesnew()
    {
        return view('blog/categories/categories_new');
    }
    public function categoriesupdate()
    {
        return view('blog/categories/categories_update');
    }
    //TAG
    public function tags()
    {
        return view('blog/tags/tags');
    }
    public function tagsnew()
    {
        return view('blog/tags/tags_new');
    }
    public function tagsupdate()
    {
        return view('blog/tags/tags_update');
    }
    public function pages()
    {
        return view('blog/pages/pages');
    }
    public function comments()
    {
        return view('blog/comments/comments');
    }
    //PRODUCTS
    public function products()
    {
        return view('catalog/products/products');
    }
    public function productsnew()
    {
        return view('catalog/products/product_new');
    }
    public function productsupdate()
    {
        return view('catalog/products/product_update');
    }
    //TYPEPRODUCTS
    public function typeproducts()
    {
        return view('catalog/typeproducts/type_products');
    }
    public function typeproductsnew()
    {
        return view('catalog/typeproducts/type_product_new');
    }
    public function typeproductsupdate()
    {
        return view('catalog/typeproducts/type_product_update');
    }
    //ATTRIBUTES
    public function attributes()
    {
        return view('catalog/attributes/attributes');
    }
    public function attributesnew()
    {
        return view('catalog/attributes/attributes_new');
    }
    public function attributesupdate()
    {
        return view('catalog/attributes/attributes_update');
    }
    //CATEGORIES FOR PRODUCTS
    public function categoriesforproducts()
    {
        return view('catalog/categoriesforproducts/categoriesforproducts');
    }
    public function categoriesforproductsnew()
    {
        return view('catalog/categoriesforproducts/categoriesforproducts_new');
    }
    public function categoriesforproductsupdate()
    {
        return view('catalog/categoriesforproducts/categoriesforproducts_update');
    }
    //SECTION
    public function sections()
    {
        return view('config_web/sections/sections');
    }
    public function sectionsnew()
    {
        return view('config_web/sections/sectionnew');
    }
    public function sectionsupdate()
    {
        return view('config_web/sections/sectionupdate');
    }
     //TEXT
     public function texts()
     {
         return view('config_web/texts/texts');
     }
     public function textsnew()
     {
         return view('config_web/texts/textnew');
     }
     public function textsupdate()
     {
         return view('config_web/texts/textupdate');
     }
     //CONTACTS
     public function contacts()
     {
         return view('config_web/contacts/contacts');
     } 
     //CATEGORY
    public function users()
    {
        return view('user/users/users');
    }
    public function usersnew()
    {
        return view('user/users/users_new');
    }
    public function usersupdate()
    {
        return view('user/users/users_update');
    }    
     //TEXT
     public function config()
     {
         return view('config_web/configs/config');
     }
     public function about()
     {
         return view('config_web/help/about');
     }
     public function profile()
     {
         return view('config_web/users/profile');
     }

    

    
}
