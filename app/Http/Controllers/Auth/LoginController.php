<?php

namespace HertzApi\Http\Controllers\Auth;

use Cookie;
use HertzApi\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

	public function showLoginForm()
    {
		$backurl = Cookie::get('backurl');
		if ($backurl)
		{
   	        session()->put('from', $backurl);
		}
		else
		{
   	        session()->put('from', url()->previous());
		}
        return view('auth.login');
    }

    public function authenticated($request,$user)
    {
    	if (session()->has('from'))
   		{
	    	$backurl=session()->get('from');
   		}
   		else
    	{
   			$backurl='/account';
   		}
        return redirect($backurl);
    }
}
