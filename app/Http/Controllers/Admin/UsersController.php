<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\User as User;
use HertzApi\Model\Roles as Roles;
use HertzApi\Model\Companies as Companies;

class UsersController extends Controller
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
        $users = User::where('role_id','<>',Roles::getAffiliateRole())->get();

        // load the view and pass the nerds
        return view('admin.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    	$roles_=Roles::where('id','<>',4)->get();
		$roles=array(''=>'Select role type');
		foreach ($roles_ as $role)
		{
			$roles[$role->id]=$role->name;
		}
        return view('admin.users.add',compact('roles'));
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
        ]);

        $request['name']=$request->first_name.' '.$request->last_name;
        $request['password']=bcrypt($request->password);
        User::create($request->all());

        // get all the nerds
        $users = User::all();

        return redirect()->route('admin.users.index')
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
        return view('admin.users.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    	$roles_=Roles::where('id','<>',4)->get();
		$roles=array(''=>'Select role type');
		foreach ($roles_ as $role)
		{
			$roles[$role->id]=$role->name;
		}
        $item = User::find($id);
        return view('admin.users.edit',compact('item'),compact('roles'));
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
	        ]);
	 	}

        $request['name']=$request->first_name.' '.$request->last_name;

        $user=User::find($id)->update($request->all());

        // get all the nerds
        $users = User::all();

        return redirect()->route('admin.users.index')
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

        return redirect()->route('admin.users.index')
        				 ->with('success','User delete successfully');
    }


}
