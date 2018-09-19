<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;
use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\Sipps as Sipps;
use HertzApi\Model\CarDors as CarDors;
use HertzApi\Model\CarClasses as CarClasses;
use HertzApi\Model\Companies as Companies;

class SippsController extends Controller
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
        $sipps = Sipps::all();

        // load the view and pass the nerds
        return view('admin.sipps.index')
            ->with('sipps', $sipps);
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

        $cardors_=CarDors::all();
		$cardors=array(''=>'Select car dor');
		foreach ($cardors_ as $cardor)
		{
			$cardors[$cardor->id]=$cardor->name;
		}

		$carclasses_=CarClasses::all();
		$carclasses=array(''=>'Select car class');
		foreach ($carclasses_ as $carclasse)
		{
			$carclasses[$carclasse->id]=$carclasse->name;
		}
        return view('admin.sipps.add')
                ->with('companies', $companies)
                ->with('cardors', $cardors)
                ->with('carclasses', $carclasses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'car_model' => 'required',
        ]);

        Sipps::create($request->all());

        // get all the nerds
        $sipps = Sipps::all();

        return redirect()->route('admin.sipps.index')
        				 ->with('success','Type sipp created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
		$companies_=Companies::all();
		$companies=array(''=>'Select company');
		foreach ($companies_ as $company)
		{
			$companies[$company->id]=$company->name;
		}

		$cardors_=CarDors::all();
		$cardors=array(''=>'Select car dor');
		foreach ($cardors_ as $cardor)
		{
			$cardors[$cardor->id]=$cardor->name;
		}

		$carclasses_=CarClasses::all();
		$carclasses=array(''=>'Select car class');
		foreach ($carclasses_ as $carclasse)
		{
			$carclasses[$carclasse->id]=$carclasse->name;
		}

        $item = Sipps::find($id);
        return view('admin.sipps.show')
                ->with('item', $item)
                ->with('companies', $companies)
                ->with('cardors', $cardors)
                ->with('carclasses', $carclasses);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
		$companies_=Companies::all();
		$companies=array(''=>'Select company');
		foreach ($companies_ as $company)
		{
			$companies[$company->id]=$company->name;
		}

		$cardors_=CarDors::all();
		$cardors=array(''=>'Select car dor');
		foreach ($cardors_ as $cardor)
		{
			$cardors[$cardor->id]=$cardor->name;
		}

		$carclasses_=CarClasses::all();
		$carclasses=array(''=>'Select car class');
		foreach ($carclasses_ as $carclasse)
		{
			$carclasses[$carclasse->id]=$carclasse->name;
		}
        $item = Sipps::find($id);
        return view('admin.sipps.edit')
                ->with('item', $item)
                ->with('companies', $companies)
                ->with('cardors', $cardors)
                ->with('carclasses', $carclasses);
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
            'car_model' => 'required',
        ]);

        Sipps::find($id)->update($request->all());

        // get all the nerds
        $sipps = Sipps::all();

        return redirect()->route('admin.sipps.index')
        				 ->with('success','Type sipp update successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editcompanies($id)
    {
        $item = Sipps::find($id);
        $companies = Companies::all();
        return view('admin.sipps.editcompanies',compact('item'),compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatecompanies(Request $request, $id)
    {
        $rate=Sipps::find($id);

		$rate->companies()->sync($request->input('companies'));;

        return redirect()->route('admin.sipps.index')
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
        Sipps::find($id)->delete();

        return redirect()->route('admin.sipps.index')
        				 ->with('success','Type sipp delete successfully');
    }

}
