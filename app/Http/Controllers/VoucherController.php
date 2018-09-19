<?php

namespace HertzApi\Http\Controllers;

use Illuminate\Http\Request;
use HertzApi\Model\User as User;
use Auth;
use HertzApi\Model\Orders as Orders;

class VoucherController extends Controller
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
    public function index($company_id,$order_id)
    {
		
		$order=Orders::where('id',$order_id)->with(['rate'=>function($query){
            return $query->with('packages');
        }])->first();
		$row=$order->toarray();
		$row['reservation_plocation_name']=$order->plocation->name;
        $row['reservation_dlocation_name']=$order->dlocation->name;
        $row["voucher_description"]=$order->rate->name.": ";
        foreach ($order->rate->packages as $package)
        {
            $row["voucher_description"].=$package->description."\n";
        }
		$row["reservation_total_amount_word"]=Orders::convert_number_to_words($row["reservation_total_amount"]);
        //print_r($row);
        //exit;
        return view('vouchers.company_'.$company_id)->with('order',$order)->with('params',$row);
    }

}
