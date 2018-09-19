<?php

namespace HertzApi\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
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
        return view('hotel.index');
    }

    public function step1()
    {
        return view('hotel.step1');
    }

    public function step2()
    {
        return view('hotel.step2');
    }
}
