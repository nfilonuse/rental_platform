<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\Packages as Packages;

class PackagesController extends Controller
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
        $packages = Packages::all();

        // load the view and pass the nerds
        return view('admin.packages.index')
            ->with('packages', $packages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.packages.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'description' => 'required',
            'smallname' => 'required',
            'name' => 'required',
            'package_order' => 'required|integer',
        ]);

		if (isset($request['defaultcheck'])) $request['defaultcheck']=1; else $request['defaultcheck']=0;
		if (isset($request['is_additional_details'])) $request['is_additional_details']=1; else $request['is_additional_details']=0;
        Packages::create($request->all());

        // get all the nerds
        $packages = Packages::all();

        return redirect()->route('admin.packages.index')
        				 ->with('success','Package created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Packages::find($id);
        return view('admin.packages.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = Packages::find($id);
        return view('admin.packages.edit',compact('item'));
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
            'description' => 'required',
            'smallname' => 'required',
            'name' => 'required',
        ]);
		if (isset($request['defaultcheck'])) $request['defaultcheck']=1; else $request['defaultcheck']=0;
		if (isset($request['is_additional_details'])) $request['is_additional_details']=1; else $request['is_additional_details']=0;
        
        Packages::find($id)->update($request->all());

        // get all the nerds
        $packages = Packages::all();

        return redirect()->route('admin.packages.index')
        				 ->with('success','Package update successfully');
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
        return view('admin.packages.editcompanies',compact('item'),compact('companies'));
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
        				 ->with('success','Package update successfully');
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
        Packages::find($id)->delete();

        return redirect()->route('admin.packages.index')
        				 ->with('success','Package delete successfully');
    }


	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function companies()
    {
        // load the view and pass the nerds
        return view('admin.packages.index')
            ->with('packages', $packages);
    }
}
