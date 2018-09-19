<?php

namespace HertzApi\Http\Controllers;

use Illuminate\Http\Request;

use Cookie;
use Illuminate\Support\Facades\Input as Input;
use HertzApi\Model\Packages as Packages;
use HertzApi\Model\Orders as Orders;
use HertzApi\Model\CarService as CarService;
use HertzApi\Model\Rates as Rates;
use HertzApi\Model\Companies as Companies;
use HertzApi\Model\Locations as Locations;
use HertzApi\Model\DriverLicence as DriverLicence;
use Illuminate\Cookie\CookieJar;

class CarController extends Controller
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
		$time["00:30"]="12:30 am";
		$time["01:00"]="01:00 am";
		$time["01:30"]="01:30 am";
		$time["02:00"]="02:00 am";

		$time["02:30"]="02:30 am";
		$time["03:00"]="03:00 am";
		$time["03:30"]="03:30 am";
		$time["04:00"]="04:00 am";
		$time["04:30"]="04:30 am";
		$time["05:00"]="05:00 am";

		$time["05:30"]="05:30 am";
		$time["06:00"]="06:00 am";
		$time["06:30"]="06:30 am";
		$time["07:00"]="07:00 am";
		$time["07:30"]="07:30 am";
		$time["08:00"]="08:00 am";

		$time["08:30"]="08:30 am";
		$time["09:00"]="09:00 am";
		$time["09:30"]="09:30 am";
		$time["10:00"]="10:00 am";
		$time["10:30"]="10:30 am";
		$time["11:00"]="11:00 am";

		$time["11:30"]="11:30 am";
		$time["12:00"]="12:00 pm";
		$time["12:30"]="12:30 pm";
		$time["13:00"]="01:00 pm";
		$time["13:30"]="01:30 pm";
		$time["14:00"]="02:00 pm";

		$time["14:30"]="02:30 pm";
		$time["15:00"]="03:00 pm";
		$time["15:30"]="03:30 pm";
		$time["16:00"]="04:00 pm";
		$time["16:30"]="04:30 pm";
		$time["17:00"]="05:00 pm";

		$time["17:30"]="05:30 pm";
		$time["18:00"]="06:00 pm";
		$time["18:30"]="06:30 pm";
		$time["19:00"]="07:00 pm";
		$time["19:30"]="07:30 pm";
		$time["20:00"]="08:00 pm";

		$time["20:30"]="08:30 pm";
		$time["21:00"]="09:00 pm";
		$time["21:30"]="09:30 pm";
		$time["22:00"]="10:00 pm";
		$time["22:30"]="10:30 pm";
		$time["23:00"]="11:00 pm";
		$time["23:30"]="11:30 pm";

    	$driverlicence=DriverLicence::orderBy('dl_order')->get()->toarray();
    	$packages=Packages::orderBy('package_order')->get()->toarray();
		$data=array();
		$item = Cookie::get('cartitems');
		if (!empty($item))
		{
			$item=(array)json_decode($item);
			$data['backdata']=(array)$item['backdata'];
		}

		Cookie::queue(
		    Cookie::forget('cartitems')
		);

		//print_r($data);
		//exit;
        return view('car.step1')->with('driverlicence',$driverlicence)
							    ->with('packages',$packages)
							    ->with('data',$data)
							    ->with('times',$time)
								->withCookie(cookie('cartitems'));
    }

    public function cookadd(Request $request)
    {
		$location_pickup=Locations::where('area_code',Input::get('location-pickup-value'))->first();
		$location_dropoff=Locations::where('area_code',Input::get('location-dropoff-value'))->first();
		$newdata=array();
        $data=array(
        	'location-pickup'=>$location_pickup->name,
        	'location-dropoff'=>$location_dropoff->name,
        	'location-pickup-value'=>Input::get('location-pickup-value'),
        	'location-dropoff-value'=>Input::get('location-dropoff-value'),
        	'date-pickup-value'=>Input::get('date-pickup-value'),
        	'date-dropoff-value'=>Input::get('date-dropoff-value'),
        	'date-pickup-value-show'=>date('F d, h:i A',strtotime(Input::get('date-pickup-value'))),
        	'date-dropoff-value-show'=>date('F d, h:i A',strtotime(Input::get('date-dropoff-value'))),
        	'driverlicence'=>Input::get('driverlicence'),
        	'packages'=>Input::get('packages'),
        );
		//print_r($data);
		$newdata['backdata']=$data;
        return redirect()->route('web.rentcar.search')
						 ->withCookie(cookie('cartitems', json_encode($newdata), 1440));

	}
    public function search(Request $request)
    {

	$item = Cookie::get('cartitems');
	if (!empty($item))
	{
		$item=(array)json_decode($item);
		$item=(array)$item['backdata'];
		$newdata['backdata']=$item;
		$data=$item;
		$data['lpackages']=Packages::orderBy('package_order')->get()->toarray();
    		$data['lcompanies']=Companies::orderBy('id')->get()->toarray();
        	return view('car.step3',compact('data'))->withCookie(cookie('cartitems', json_encode($newdata), 1440));
	}
	else
	        return redirect()->route('web.rentcar.index');

    }

    public function step4(Request $request)
    {

		$data=(array)json_decode(Input::get('infodata'));
		$infocar=(array)json_decode(Input::get('infocar'));

		$company_id=$infocar['company']->id;
		$company=Companies::find($company_id);

		$rate=Rates::find($infocar['rate']->id);
		$account=$rate->accounts->where('company_id',$company_id)->first();

		$data['selectcar']=$infocar;
		$data['company']=collect($company)->only(['id', 'name'])->toarray();
		$data['account']=collect($account)->only(['id', 'account_number'])->toarray();
		$data['rate']=collect($rate)->only(['id', 'name', 'code'])->toarray();
//		unset($data['cars']);
//		print_r($data);
//		exit;
        return view('car.step4',compact('data'));
    }
}
