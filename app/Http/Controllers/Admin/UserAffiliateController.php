<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;
use HertzApi\Http\Controllers\Controller;

use HertzApi\Model\Roles;
use HertzApi\Model\User;
use HertzApi\Model\UserAffiliate;
use HertzApi\Model\UserAffiliateOrders;
use HertzApi\Model\Orders;

class UserAffiliateController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the nerds
        $users = User::where('role_id',Roles::getAffiliateRole())->with('useraffiliate')->get();

        // load the view and pass the nerds
        return view('admin.usersaffiliate.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    	$roles_=Roles::all();
		$roles=array(''=>'Select role type');
		foreach ($roles_ as $role)
		{
			$roles[$role->id]=$role->name;
		}
        return view('admin.usersaffiliate.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|min:10',
            'commission_car' => 'required',
            'referral_id' => 'required',
        ]);

        $request['name']=$request->first_name.' '.$request->last_name;
        $request['role_id']=Roles::getAffiliateRole();
        $request['password']=bcrypt($request->password);
        $user=User::create($request->all());
        if ($user)
        {
            UserAffiliate::create([
                'user_id'=> $user->id,
                'commission_car'=> $request->commission_car,
                'commission_hotel'=> 0,
                'referral_id'=> $request->referral_id,
            ]);
        }

        return redirect()->route('admin.usersaffiliate.index')
        				 ->with('success','Location created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = User::find($id);
        return view('admin.usersaffiliate.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    	$roles_=Roles::all();
		$roles=array(''=>'Select role type');
		foreach ($roles_ as $role)
		{
			$roles[$role->id]=$role->name;
		}
        $item = User::find($id);
        return view('admin.usersaffiliate.edit',compact('item'),compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
    	if (isset($request['password'])&&!empty($request['password']))
    	{
	         $this->validate($request, [
    	        'email' => 'required|email|max:255',
        	    'password' => 'required|min:6|confirmed',
	            'first_name' => 'required',
    	        'last_name' => 'required',
        	    'phone' => 'required|min:10',
        	    'commission_car' => 'required',
        	    'referral_id' => 'required',
	        ]);
	        $request['password']=bcrypt($request->password);
    		//$request['password']=User::find($id)->password;
	 	}
	 	else
	 	{
    		$request['password']=User::find($id)->password;
	         $this->validate($request, [
    	        'email' => 'required|email|max:255',
	            'first_name' => 'required',
    	        'last_name' => 'required',
        	    'phone' => 'required|min:10',
        	    'commission_car' => 'required',
        	    'referral_id' => 'required',
	        ]);
	 	}

        $request['name']=$request->first_name.' '.$request->last_name;

        User::find($id)->update($request->all());

        $useraffilet=UserAffiliate::where('user_id',$id)->orderBy('id', 'DESC')->first();
        if ($useraffilet->commission_car!=$request->commission_car||$useraffilet->referral_id!=$request->referral_id)
        {
                UserAffiliate::create([
                    'user_id'=> $id,
                    'commission_car'=> $request->commission_car,
                    'commission_hotel'=> 0,
                    'referral_id'=> $request->referral_id,
                ]);
        }


        return redirect()->route('admin.usersaffiliate.index')
        				 ->with('success','Location update successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        UserAffiliate::where('user_id',$id)->delete();

        return redirect()->route('admin.usersaffiliate.index')
        				 ->with('success','User delete successfully');
    }

    /**
     * Report the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function report($id)
    {
        $orders = UserAffiliateOrders::where('user_id',$id)->pluck('order_id')->toArray(); 
        // get all the nerds
        $orders = Orders::whereIn('id',$orders)->where('reservation_payment_option','=',1)->orderby('reservation_date','DESC')->get();
        return view('admin.usersaffiliate.reportcarsbooked')->with('orders', $orders);;
    }

}
