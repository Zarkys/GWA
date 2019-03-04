<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class LandingController extends Controller
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
    public function index()
    {
        return view('website_public/index');
    }
    public function know()
    {

        return view('website_public/know');
    }
    public function catalog()
    {
        
        return view('website_public/catalog');
    }
    public function catalog_detail()
    {
        return view('website_public/catalog_detail');
    }
    
    public function contact()
    {
        return view('website_public/contact');
    }
    public function changue_lang($lang)
    {
       
        session(['lang' => $lang]);
        //dd(session('lang'));
        return response()->json($lang, 200);
    }
    
    
}
