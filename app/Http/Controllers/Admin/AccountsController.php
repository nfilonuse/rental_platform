<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\Accounts as Accounts;
use HertzApi\Model\Companies as Companies;

class AccountsController extends Controller
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
        $accounts = Accounts::all();

        // load the view and pass the nerds
        return view('admin.accounts.index')
            ->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		$companies_=Companies::all();
		$companies=array(''=>'Select company');
		foreach ($companies_ as $company)
		{
			$companies[$company->id]=$company->name;
		}
        return view('admin.accounts.add')->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'account_number' => 'required',
//            'account_password' => 'required',
//            'account_res_source' => 'required',
            'company_id' => 'required',
        ]);

        Accounts::create($request->all());

        // get all the nerds
        $accounts = Accounts::all();

        return redirect()->route('admin.accounts.index')
        				 ->with('success','Account created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Accounts::find($id);
        return view('admin.accounts.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = Accounts::find($id);
		$companies_=Companies::all();
		$companies=array(''=>'Select company');
		foreach ($companies_ as $company)
		{
			$companies[$company->id]=$company->name;
		}
        return view('admin.accounts.edit',compact('item'))->with('companies', $companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'account_number' => 'required',
//            'account_password' => 'required',
//            'account_res_source' => 'required',
            'company_id' => 'required',
        ]);

        Accounts::find($id)->update($request->all());

        // get all the nerds
        $accounts = Accounts::all();

        return redirect()->route('admin.accounts.index')
        				 ->with('success','Account update successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editcompanies($id)
    {
        $item = Rates::find($id);
        $companies = Companies::all();
        return view('admin.accounts.editcompanies',compact('item'),compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatecompanies(Request $request, $id)
    {
/*
         $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
        ]);

        Rates::find($id)->update($request->all());

        // get all the nerds
        $rates = Rates::all();

        return redirect()->route('admin.rates.index')
        				 ->with('success','Account update successfully');
*/  
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Accounts::find($id)->delete();

        return redirect()->route('admin.accounts.index')
        				 ->with('success','Account delete successfully');
    }


	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function companies()
    {
        // load the view and pass the nerds
        return view('admin.accounts.index')
            ->with('accounts', $accounts);
    }
}
