<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function pages()
    {
        return view('blog/pages/pages');
    }
    public function comments()
    {
        return view('blog/comments/comments');
    }
    public function products()
    {
        return view('catalog/products/products');
    }
    public function typeproducts()
    {
        return view('catalog/typeproducts/type_products');
    }
    public function attributes()
    {
        return view('catalog/attributes/attributes');
    }
    public function texts()
    {
        return view('landing/texts');
    }

    
}
