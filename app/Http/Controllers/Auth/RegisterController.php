<?php

namespace HertzApi\Http\Controllers\Auth;

use HertzApi\Model\User;
use HertzApi\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use HertzApi\Model\Checkoutinfo as Checkoutinfo;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users|confirmed',
            'password' => 'required|min:6|confirmed',
            'first_name' => 'required',
            'last_name' => 'required',
            //'phone' => 'required|min:10',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
		$createuser=User::create([
            'name' => $data['first_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
//            'phone' => $data['phone'],
//            'second_phone' => $data['second_phone'],
            'phone' => '',
            'second_phone' => '',
            'role_id' => 3,
        ]);
		$checkoutinfo=Checkoutinfo::create([
			'user_id'=>$createuser->id,
  	        'billing_first_name' => $data['first_name'],
	   	    'billing_last_name' => $data['last_name'],
      	    'billing_phone' => '',
   	   	    'billing_address' => '',

   	       	'billing_email' => $data['email'],
   	        'billing_city' => '',

			'billing_country_id' => 0,
			'billing_token' => '',

  	        'account_first_name' => $data['first_name'],
	   	    'account_last_name' => $data['last_name'],
      	    'account_phone' => '',
   	   	    'account_address' => '',

   	       	'account_email' => $data['email'],
   	        'account_city' => '',

			'account_country_id' => 0,
		]);

        return $createuser;
    }
    protected function redirectPath()
    {
    	if (session()->has('from'))
   		{
	    	return session()->get('from');
   		}
   		else
    	{
	        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
   		}
    }
}
