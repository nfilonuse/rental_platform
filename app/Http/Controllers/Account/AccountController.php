<?php

namespace HertzApi\Http\Controllers\Account;

use HertzApi\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Http\Request;
use HertzApi\Model\User as User;
use HertzApi\Model\Checkoutinfo as Checkoutinfo;
use HertzApi\Model\Countries as Countries;
use HertzApi\Model\States as States;
use HertzApi\Model\Orders as Orders;

use Auth;

class AccountController extends Controller
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
    public function index()
    {
        return view('account.home');
    }
/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function myprofile()
    {
    	$item=Auth::User();
        return view('account.users.myprofile',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
    	if (isset($request['password'])&&!empty($request['password']))
    	{
	         $this->validate($request, [
    	        'email' => 'required|email|max:255',
        	    'password' => 'required|min:6|confirmed',
	            'first_name' => 'required',
    	        'last_name' => 'required',
        	    'phone' => 'required|min:10',
	        ]);
	 	}
	 	else
	 	{
    		$request['password']=Auth::User()->password;
	         $this->validate($request, [
    	        'email' => 'required|email|max:255',
	            'first_name' => 'required',
    	        'last_name' => 'required',
        	    'phone' => 'required|min:10',
	        ]);
	 	}

   		$request['role_id']=Auth::User()->role_id;
        $request['name']=$request->first_name.' '.$request->last_name;
        $request->password=bcrypt($request->password);

        $user=Auth::User()->update($request->all());

        return redirect()->route('admin.users.myprofile')
        				 ->with('success','Your profile update successfully');
    }


/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function mybillinginfo()
    {
    	$checkoutinfo=Checkoutinfo::where('user_id',Auth::User()->id)->first();
    	$countries_=Countries::orderby('name')->get();
		$countries=array(''=>'Select country type');
		foreach ($countries_ as $country)
		{
			$countries[$country->id]=$country->name;
		}

		$states=array(''=>'Select state type');
    	if ($checkoutinfo)
    	{
    		$states_=States::where('country_id',$checkoutinfo->billing_country_id)->orderby('name')->get();
			foreach ($states_ as $state)
			{
				$states[$state->id]=$state->name;
			}
    	}
        return view('account.users.checkoutinfo')
        			->with('item',$checkoutinfo)
        			->with('countries',$countries)
        			->with('states',$states);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function mybillinginfoupdate(Request $request)
    {
         $this->validate($request, [
            'billing_first_name' => 'required',
   	        'billing_last_name' => 'required',
       	    'billing_phone' => 'required|min:10',
   	        'billing_address' => 'required',

   	        'billing_email' => 'required|email|max:255',
   	        'billing_city' => 'required',

			'billing_country_id' => 'required',
        ]);
   		$request['send_notified']=1;
		$request['billing_token']=Input::get('_token');
   		$request['user_id']=Auth::User()->id;
    	$checkoutinfo=Checkoutinfo::where('user_id',Auth::User()->id)->first();
		if ($checkoutinfo)
		{
			$checkoutinfo->update($request->all());
		}
		else
		{
			Checkoutinfo::create($request->all());
		}

        return redirect()->route('account.users.mybillinginfo')
        				 ->with('success','Your billing information update successfully');
    }

/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function myorders()
    {
        // get all the nerds
        $orders = Orders::where('user_id',Auth::User()->id)->where('reservation_payment_option','=',1)->get();

        // load the view and pass the nerds
        return view('account.users.myorders')
            ->with('orders', $orders);
    }
}
