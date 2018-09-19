<?php

namespace HertzApi\Http\Controllers;

use HertzApi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use HertzApi\Model\User as User;
use Auth;

class HomeController extends Controller
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
        return view('users.myprofile',compact('item'));
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

}
