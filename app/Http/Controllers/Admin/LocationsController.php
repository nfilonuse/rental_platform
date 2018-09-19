<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\Locations as Locations;
use HertzApi\Model\Companies as Companies;

class LocationsController extends Controller
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
        $locations = Locations::take(30)->skip(30)->get();

        // load the view and pass the nerds
        return view('admin.locations.index')
            ->with('locations', $locations);
    }
	public function getdata(Request $request)
	{
/*
		$count=count(Locations::all());

        $locations = Locations::take(30)->skip(30)->get();
		$data['data']=array();
		foreach ($locations as $location)
		{
			$data['data'] =collect($location->toarray())->only(['phone', 'full_name', 'car_number', 'car_marka', 'car_color']);

		}
*/
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.locations.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'area_code' => 'required',
            'country' => 'required|min:2',
            'name' => 'required',
			//'city' => 'required',
			//'state' => 'required|min:2',
			//'address' => 'required',
			//'zip_code' => 'required|min:2',
			//'phone' => 'required|min:10',
			'location_order' => 'required',
        ]);

        Locations::create($request->all());

        // get all the nerds
        $locations = Locations::all();

        return redirect()->route('admin.locations.index')
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
        $item = Locations::find($id);
        return view('admin.locations.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = Locations::find($id);
        return view('admin.locations.edit',compact('item'));
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
            'area_code' => 'required',
            'country' => 'required|min:2',
            'name' => 'required',
			//'city' => 'required',
			//'state' => 'required|min:2',
			//'address' => 'required',
			//'zip_code' => 'required|min:2',
			//'phone' => 'required|min:10',
			'location_order' => 'required',
        ]);

        Locations::find($id)->update($request->all());

        // get all the nerds
        $locations = Locations::all();

        return redirect()->route('admin.locations.index')
        				 ->with('success','Location update successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editcompanies($id)
    {
        $item = Locations::find($id);
        $companies = Companies::all();
        return view('admin.locations.editcompanies',compact('item'),compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatecompanies(Request $request, $id)
    {
        $location=Locations::find($id);

		$location->companies()->sync($request->input('counpany'));;

        return redirect()->route('admin.locations.index')
        				 ->with('success','Company update successfully');
  
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Locations::find($id)->delete();

        return redirect()->route('admin.locations.index')
        				 ->with('success','Location delete successfully');
    }


	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function companies()
    {
        // load the view and pass the nerds
        return view('admin.locations.index')
            ->with('locations', $locations);
    }
}
