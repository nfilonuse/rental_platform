<?php

namespace HertzApi\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
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
        return view('pages.contactus');
        //return view('help.index');
    }
}
