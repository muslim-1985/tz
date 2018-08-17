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
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.pages.home');
    }
    public function charts()
    {
        return view('theme.pages.charts');
        //return view('home');
    }
    public function tables()
    {
        return view('theme.pages.tables');
        //return view('home');
    }
}
