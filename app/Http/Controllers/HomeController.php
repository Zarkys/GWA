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
      // dd(Auth::user(), session()->get('permissions'));
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
     //TEXT
     public function config()
     {
         return view('config_web/configs/config');
     }
    

    
}
