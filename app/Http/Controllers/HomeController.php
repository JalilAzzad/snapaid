<?php

namespace App\Http\Controllers;

use App\CausesCategory;
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

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
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


    /**
     * Show the application faq page.
     *
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {
        return view('home.faq');
    }
}
