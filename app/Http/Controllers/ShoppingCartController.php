<?php

namespace HertzApi\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cookie;
use DateTime;
use Parser;
use Mail;
use Illuminate\Support\Facades\Input as Input;
use HertzApi\Model\Coupons as Coupons;
use HertzApi\Model\Packages as Packages;
use HertzApi\Model\CarService as CarService;
use HertzApi\Model\Rates as Rates;
use HertzApi\Model\Companies as Companies;
use HertzApi\Model\Checkoutinfo as Checkoutinfo;
use HertzApi\Model\Countries as Countries;
use HertzApi\Model\States as States;
use HertzApi\Model\Locations as Locations;
use HertzApi\Model\Orders as Orders;
use HertzApi\Model\PaymentService as PaymentService;
use HertzApi\Model\UserAffiliate;
use HertzApi\Model\UserAffiliateOrders as UserAffiliateOrders;
use Session;


class ShoppingCartController extends Controller
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
    public function index(Request $request)
    {
		Cookie::queue(
		    Cookie::forget('goguest')
		);
    	if (cookie('goguest', 0, 0))
		$item = Cookie::get('cartitems');

		if (!empty($item))
		{
			$item=(array)json_decode($item);
			$item['selectcar']=(array)$item['selectcar'];
			$item['company']=(array)$item['company'];
			$item['account']=(array)$item['account'];
			$item['rate']=(array)$item['rate'];
			$item['backdata']=(array)$item['backdata'];
			$data=$item['backdata'];
			Session::put('cartitems',json_encode($item));
	        return view('cart.index')
							->with('item',$item)
							->with('data',$data)
							->withCookie(cookie('goguest'));
		}
		else
		{
	        return view('cart.empty');
		}
    }
    public function addcoupon(Request $request)
    {
		$item = Session::get('cartitems');
		//$item = Cookie::get('cartitems');
		if (empty($item))
		{
	        return view('cart.empty');
		}
		$coupon=Coupons::where('number',$request->get('coupon_code'))->first();
		if (!empty($coupon))
		{
			$item=(array)json_decode($item);
			$item['selectcar']=(array)$item['selectcar'];
			$item['company']=(array)$item['company'];
			$item['account']=(array)$item['account'];
			$item['rate']=(array)$item['rate'];
			$item['backdata']=(array)$item['backdata'];
			if ($item['reservation_total_discont']=$coupon->get_discount_amount($item['reservation_total_amount']))
			{
				$item['coupon_id']=$coupon->id;
			}
			else
			{

			}
			Session::put('cartitems',json_encode($item));

	        return redirect()->route('web.rentcar.show')
		    				 ->with('success','Add to cart successfully')
							 ->withCookie(cookie('cartitems', json_encode($item), 1440));
		}
		else
		{
	        return redirect()->route('web.rentcar.show')
		    				 ->with('couponerror','Wrong code. Please, try again.');
		}
	}
    public function add(Request $request)
    {
		$user_id=0;
    	$item=Auth::User();
		if (!empty($item))
			$user_id=$item->id;
		$data=(array)json_decode(Input::get('infodata'));
		$selectcar=(array)$data['selectcar'];
		$newdata=array();
		$newdata['checkout_detail_id']=0;
		$newdata['user_id']=$user_id;
		$newdata['voucher_number']=0;
		$newdata['company_id']=$selectcar['company']->id;
		$newdata['agent_id']=0;
		$newdata['rate_id']=$data['rate']->id;
		$newdata['account_id']=$data['account']->id;
		$newdata['coupon_id']=0;
		$newdata['reservation_number']='';
		$newdata['record_loc']=$selectcar['reference_id'];
		
		$newdata['rate_code']=$selectcar['rate_code'];
		$newdata['car_class_code']=$selectcar['car_model'];
		
/*
		$newdata['reservation_first_name']=Input::get('reservation_first_name');
		$newdata['reservation_last_name']=Input::get('reservation_last_name');
		$newdata['reservation_phone_number']=Input::get('reservation_phone_number');
		$newdata['reservation_country']=Input::get('reservation_country');
*/
		$newdata['reservation_first_name']='';
		$newdata['reservation_last_name']='';
		$newdata['reservation_phone_number']='';
		$newdata['reservation_country']='';


		$location_pickup=Locations::where('area_code',$data['location-pickup-value'])->first();
		$newdata['reservation_plocation_id']=$location_pickup->id;
		$newdata['reservation_pdate']=date('Y-m-d',strtotime($data['date-pickup-value']));
		$newdata['reservation_ptime']=date('H:i',strtotime($data['date-pickup-value']));

		$newdata['reservation_country']=$location_pickup->country;
		
		$location_dropoff=Locations::where('area_code',$data['location-dropoff-value'])->first();
		$newdata['reservation_dlocation_id']=$location_dropoff->id;
		$newdata['reservation_ddate']=date('Y-m-d',strtotime($data['date-dropoff-value']));
		$newdata['reservation_dtime']=date('H:i',strtotime($data['date-dropoff-value']));


		$newdata['reservation_for_days']=$selectcar['car_for_days'];
		$newdata['reservation_currency_code']=$selectcar['car_currency_code'];
		$newdata['reservation_total_amount']=$selectcar['total-price'];
		$newdata['reservation_total_discont']=0;
		$newdata['reservation_weekly_amount']=$selectcar['weekly-price'];
		$newdata['reservation_daily_amount']=$selectcar['daily-price'];
		
		unset($data['selectcar']->company);
		unset($data['selectcar']->packages);
		unset($data['selectcar']->rate);

		
		
		$newdata['selectcar']=(array)$data['selectcar'];
		$newdata['company']=(array)$data['company'];
		$newdata['account']=(array)$data['account'];
		$newdata['rate']=(array)$data['rate'];
		unset($data['selectcar']);
		unset($data['company']);
		unset($data['account']);
		unset($data['rate']);
		$newdata['backdata']=$data;
		Session::put('cartitems',json_encode($item));
        return redirect()->route('web.rentcar.show')
        				 ->with('success','Add to cart successfully')
						 //->withCookie(cookie('backdata', json_encode($data), 1440))
						 ->withCookie(cookie('cartitems', json_encode($newdata), 1440))
						 ;
    }

    public function golikeguest(Request $request)
    {
		return redirect()->route('web.rentcar.billing')->withCookie(cookie('goguest', 1, 1440));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function billing(Request $request)
    {
		$goguest = Cookie::get('goguest');
    	if (Auth::guest()&&!empty($goguest))
    	{
			$item = Session::get('cartitems');
			//$item = Cookie::get('cartitems');
			if (!empty($item))
			{
				$item=(array)json_decode($item);
				$item['selectcar']=(array)$item['selectcar'];
				$item['company']=(array)$item['company'];
				$item['account']=(array)$item['account'];
				$item['rate']=(array)$item['rate'];
				$item['backdata']=(array)$item['backdata'];
				$item['isguest']=1;
				$data=(array)$item['backdata'];
				$checkoutinfo=null;
		    	$countries_=Countries::orderby('name')->get();
				$countries=array(''=>'Select country');
				foreach ($countries_ as $country)
				{
					$countries[$country->id]=$country->name;
				}

				$states=array(''=>'Select state');
		    	if ($checkoutinfo)
		    	{
		    		$states_=States::where('country_id',$checkoutinfo->billing_country_id)->orderby('name')->get();
					foreach ($states_ as $state)
					{
						$states[$state->id]=$state->name;
					}
		    	}

		        return view('cart.billing')
								->with('item',$item)
								->with('data',$data)
								->with('isguest',1)
								->with('countries',$countries)
								->with('states',$states)
								->with('checkoutinfo',$checkoutinfo);
			}
			else
			{
		        return redirect()->route('web.rentcar.show');
			}
    	}
    	else if (Auth::User())
    	{
			$item = Session::get('cartitems');
			//$item = Cookie::get('cartitems');
			if (!empty($item))
			{
				$item=(array)json_decode($item);
				$item['selectcar']=(array)$item['selectcar'];
				$item['company']=(array)$item['company'];
				$item['account']=(array)$item['account'];
				$item['rate']=(array)$item['rate'];
				$item['backdata']=(array)$item['backdata'];
				$item['isguest']=0;
				$data=(array)$item['backdata'];
				$checkoutinfo=Checkoutinfo::where('user_id',Auth::User()->id)->first();
		    	$countries_=Countries::orderby('name')->get();
				$countries=array(''=>'Select country');
				foreach ($countries_ as $country)
				{
					$countries[$country->id]=$country->name;
				}

				$states=array(''=>'Select state');
		    	if ($checkoutinfo)
		    	{
		    		$states_=States::where('country_id',$checkoutinfo->billing_country_id)->orderby('name')->get();
					foreach ($states_ as $state)
					{
						$states[$state->id]=$state->name;
					}
		    	}

		        return view('cart.billing')
								->with('item',$item)
								->with('data',$data)
								->with('isguest',0)
								->with('countries',$countries)
								->with('states',$states)
								->with('checkoutinfo',$checkoutinfo);
			}
			else
			{
		        return redirect()->route('web.rentcar.show');
			}
    	}
    	else
    	{
	        return redirect()->route('login')->withCookie(cookie('backurl', route('web.rentcar.billing'), 60));
    	}
    }
	public function addbilling(Request $request)
	{
		$item = Session::get('cartitems');
		//$item = Cookie::get('cartitems');
		if (empty($item))
		{
	        return redirect()->route('web.rentcar.show');
		}
		else
		{
			if (Input::get('useaccountinfo'))
			{
				 $this->validate($request, [
    				'account_first_name' => 'required',
   	    			'account_last_name' => 'required',
    	   			'account_phone' => 'required|min:10',
   	    			'account_address' => 'required',

   	        		'account_email' => 'required|email|max:255',
   					'account_city' => 'required',

					'account_country_id' => 'required',
    			]);
				$request['billing_first_name']=Input::get('account_first_name');
				$request['billing_last_name']=Input::get('account_last_name');
				$request['billing_phone']=Input::get('account_phone');
				$request['billing_address']=Input::get('account_address');

				$request['billing_company']=Input::get('account_company');
				$request['billing_art']=Input::get('account_art');
				$request['billing_email']=Input::get('account_email');
				$request['billing_city']=Input::get('account_city');

				$request['billing_country_id']=Input::get('account_country_id');
				$request['billing_state_id']=Input::get('account_state_id');

				$request['billing_zip_code']=Input::get('account_zip_code');
			}
			else
			{
				 $this->validate($request, [
    				'account_first_name' => 'required',
   	    			'account_last_name' => 'required',
    	   			'account_phone' => 'required|min:10',
   	    			'account_address' => 'required',

   	        		'account_email' => 'required|email|max:255',
   					'account_city' => 'required',

					'account_country_id' => 'required',

    				'billing_first_name' => 'required',
   	    			'billing_last_name' => 'required',
    	   			'billing_phone' => 'required|min:10',
   	    			'billing_address' => 'required',

   	        		'billing_email' => 'required|email|max:255',
   					'billing_city' => 'required',

					'billing_country_id' => 'required',
    			]);
			}
   			$request['send_notified']=(Input::get('send_notified')?1:0);
    	    if (Auth::guest())
    	    {
	   			$request['user_id']=0;
	   			$request['billing_token']=Input::get('_token');
			   $checkoutinfo=Checkoutinfo::where('billing_token',Input::get('_token'))->first();

    	    }
    	    else
    	    {
	   			$request['user_id']=Auth::User()->id;
	   			$request['billing_token']=Input::get('_token');
    			$checkoutinfo=Checkoutinfo::where('user_id',Auth::User()->id)->first();
    	    }
			if ($checkoutinfo)
			{
				$checkoutinfo->update($request->all());
			}
			else
			{
				$checkoutinfo=Checkoutinfo::create($request->all());
			}
			$country=Countries::where('id',Input::get('billing_country_id'))->first();
			$state=States::where('id',Input::get('billing_state_id'))->first();
			$acc_country=Countries::where('id',Input::get('account_country_id'))->first();
			$acc_state=States::where('id',Input::get('account_state_id'))->first();
			$item=(array)json_decode($item);
			$item['checkout_detail_id']=$checkoutinfo->id;
			$item['reservation_email']=Input::get('billing_email');
			$item['selectcar']=(array)$item['selectcar'];
			$item['company']=(array)$item['company'];
			$item['account']=(array)$item['account'];
			$item['rate']=(array)$item['rate'];
			$item['backdata']=(array)$item['backdata'];
			$goguest = Cookie::get('goguest');
    		if (Auth::guest()&&!empty($goguest))
    		{
				$item['isguest']=1;
			}
			else
			{
				$item['isguest']=0;
			}

			$billing=array(
        		"billing_first_name"=>Input::get('billing_first_name'),
				"billing_last_name"=>Input::get('billing_last_name'),
				"billing_company"=>Input::get('billing_company'),
				"billing_phone"=>Input::get('billing_phone'),
				"billing_address"=>Input::get('billing_address'),
				"billing_email"=>Input::get('billing_email'),
				"billing_art"=>Input::get('billing_art'),
				"billing_city"=>Input::get('billing_city'),
				"billing_country"=>($country?$country->name:''),
				"billing_state"=>($state?$state->name:''),
				"billing_zip_code"=>Input::get('billing_zip_code'),
        		"account_first_name"=>Input::get('account_first_name'),
				"account_last_name"=>Input::get('account_last_name'),
				"account_company"=>Input::get('account_company'),
				"account_phone"=>Input::get('account_phone'),
				"account_address"=>Input::get('account_address'),
				"account_email"=>Input::get('account_email'),
				"account_art"=>Input::get('account_art'),
				"account_city"=>Input::get('account_city'),
				"account_country"=>($acc_country?$acc_country->name:''),
				"account_state"=>($acc_state?$acc_state->name:''),
				"account_zip_code"=>Input::get('account_zip_code'),

			);
			
			$item['billing']=$billing;
			
			Session::put('cartitems',json_encode($item));
	        return redirect()->route('web.rentcar.pay')
		    				 ->with('success','Add to cart successfully')
							 ->withCookie(cookie('cartitems', json_encode($item), 1440));

		}

	}
    public function pay(Request $request)
    {
		$item = Session::get('cartitems');
		if (!empty($item))
		{
			$item=(array)json_decode($item);
			$years=array(''=>'Year');
			$monthes=array(''=>'Month');
			for ($i=date('Y');$i<=date('Y')+20;$i++)
			{
				$years[$i]=$i;
			}
			for ($i=1;$i<=12;$i++)
			{
				$dateObj   = DateTime::createFromFormat('!m', $i);
				$monthes[$i]=$dateObj->format('F');
			}
			$item['selectcar']=(array)$item['selectcar'];
			$item['company']=(array)$item['company'];
			$item['account']=(array)$item['account'];
			$item['rate']=(array)$item['rate'];
			$item['backdata']=(array)$item['backdata'];
			$item['billing']=(array)$item['billing'];
			$data=(array)$item['backdata'];
	        return view('cart.pay')
							->with('clientToken',PaymentService::get_token_BT())
							->with('years',$years)
							->with('monthes',$monthes)
							->with('item',$item)
							->with('data',$data);
		}
		else
		{
	        return redirect()->route('web.rentcar.show');
		}
    }


    public function paymantproccess(Request $request)
    {
		$item = Session::get('cartitems');
		//$item = Cookie::get('cartitems');
		if (!empty($item))
		{
			$item=(array)json_decode($item);
			$item['selectcar']=(array)$item['selectcar'];
			$item['company']=(array)$item['company'];
			$item['account']=(array)$item['account'];
			$item['rate']=(array)$item['rate'];
			$item['backdata']=(array)$item['backdata'];
			$item['billing']=(array)$item['billing'];
			$data=(array)$item['backdata'];
			//$description="Company Name:  ".$item['company']['name']."\nRate Code: ".$item['rate']['name']."\nPickup Date: ".$data['date-pickup-value-show']."\nDropoff Date: ".$data['date-dropoff-value-show']."\nReservation for Days: ".$item['reservation_for_days']."\n";
			$description="Company Name:  ".$item['company']['name']."\nRate Code: ".$item['rate']['name']."\nPickup Date: ".$data['date-pickup-value-show']."\nDropoff Date: ".$data['date-dropoff-value-show']."\nReservation for Days: ".$item['reservation_for_days']."\n";
			$amount=number_format($item['reservation_total_amount']-$item['reservation_total_discont'],2);
			$amount=number_format($amount,2,".","");;
			$currency="USD";
			$referral_id = Cookie::get('referral_id');
			//print_r($referral_id);
			//exit;
			
			$paymentservice=new PaymentService($request);
			$paymentservice->setproduct($amount,$currency,$description);
			$response=$paymentservice->processBT($request['payment_method_nonce']);
			//if (1==1) 
			if ($response->isSuccessful()) 
			{
				$item['referral_id']='';
				$item['reservation_payment_option']=1;
				$item['reservation_date']=date('Y-m-d H:i:s');
				$item['reservation_first_name']=$item['billing']['account_first_name'];
				$item['reservation_last_name']=$item['billing']['account_last_name'];
				$item['reservation_phone_number']=$item['billing']['account_phone'];
						
				$order=Orders::create($item);
				Orders::makevaucher($order);

				$data=Array(
					'account_number' => $order->account->account_number,
					'RATE_CODE' => $item['selectcar']['rate_code'],
					'COMPANY_NAME' => $order->company->name,
					'company_id' => $order->company->id,
					'CAR_TYPE' => $item['selectcar']['code'],
					'VOUCHER_NUMBER' => $order->voucher_number,
					'LOYALTY' => '',
					'OPERATOR_NBR'=>$order->account->account_number,
					'IATA_NUMBER'=>$order->account->iata_number,
					'FIRST_NAME' => $order->reservation_first_name,
					'LAST_NAME' => $order->reservation_last_name,
					'PICKUP_DATETIME' => $order->reservation_pdate.'T'.$order->reservation_ptime.':00',
					'PICKUP_CITYCODE' => $order->plocation->area_code,
					'DROPOFF_DATETIME' => $order->reservation_ddate.'T'.$order->reservation_dtime.':00',
					'DROPOFF_CITYCODE' => $order->dlocation->area_code,
					'car_company_id' => $order->company->id,
					'RequestorID_ID' => $order->record_loc,
					'car_company_webservice_url'=> 	'',
				);
				$results=CarService::BookingCar($order->company->id,$data);

				if ($results['error'])
				{
					$order->sendbookerror();
			        return redirect()->route('web.rentcar.unsuccessbooking')->with('errors',$results['error_text'])->with('order_id',$order->id);
				}
				else
				{
					if (!empty($referral_id))
					{
						$order->referral_id=$referral_id;
					}

					$order->reservation_buy=1;
					$order->reservation_buy_date=date('Y-m-d H:i:s');
					$order->reservation_number=$results['result']['confirmation_number'];
					$order->save();
					$referral_id = Cookie::get('referral_id');

					if (!empty($referral_id))
					{
						$affiliate_user=UserAffiliate::where('referral_id',$referral_id)->first();

						UserAffiliateOrders::create([
							'user_id'=>$affiliate_user->user_id,
							'order_id'=>$order->id,
							'commission'=>$affiliate_user->commission_car,
							'commission_amount'=>$amount,
						]);

						Cookie::queue(
							Cookie::forget('referral_id')
						);
				
					}
					$order->sendsuccess();
				}

		        return redirect()->route('web.rentcar.success')->with('order_id',$order->id);
			} 
			elseif ($response->isRedirect()) 
			{
			    $response->redirect(); // this will automatically forward the customer
			} 
			else 
			{
				$item['reservation_date']=date('Y-m-d H:i:s');
				$order=Orders::create($item);
				$order->sendpayerror();
		        return redirect()->route('web.rentcar.unsuccess')->with('errors',$response->getMessage());
			}
		}
		else
		{
	        return redirect()->route('web.rentcar.show');
		}
    }
	public function success(Request $request)
	{
		Cookie::queue(
		    Cookie::forget('cartitems')
		);
		$order_id = $request->session()->get('order_id');
		$request->session()->reflash();
		//$order_id = 10;
		
		$order=Orders::find($order_id);
        return view('cart.successpage')->with('order',$order)->withCookie(cookie('cartitems'));
	}

	public function unsuccess(Request $request)
	{
		$errors = $request->session()->get('errors'); 
		$request->session()->reflash();

		//$errors=$request->get('errors');
	    return view('cart.unsuccesspage')->with('errors',$errors);
	}

	public function unsuccessbooking(Request $request)
	{
		$errors = $request->session()->get('errors'); 
		$order_id = $request->session()->get('order_id'); 
		$request->session()->reflash();
		//$errors=$request->get('errors');
	    return view('cart.unsuccessbookingpage')->with('errors',$errors)->with('order_id',$order_id);
	}
}
