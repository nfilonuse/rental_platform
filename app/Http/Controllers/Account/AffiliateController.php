<?php

namespace HertzApi\Http\Controllers\Account;

use HertzApi\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Http\Request;
use HertzApi\Model\UserAffiliateOrders as UserAffiliateOrders;
use HertzApi\Model\Orders as Orders;

use Auth;

class AffiliateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function mylink()
    {
        $item=Auth::User();
        $item->load('useraffiliate');
        $urllink=URL('/').'?ref='.$item->useraffiliate->referral_id;
        return view('account.users.mylink')->with('item',$item)->with('urllink',$urllink);
    }
/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function mycarsbooked()
    {
        $orders = UserAffiliateOrders::where('user_id',Auth::User()->id)->pluck('order_id')->toArray(); 
        // get all the nerds
        $orders = Orders::whereIn('id',$orders)->where('reservation_payment_option','=',1)->orderby('reservation_date','DESC')->get();
        return view('account.users.mycarsbooked')->with('orders', $orders);;
    }


}
