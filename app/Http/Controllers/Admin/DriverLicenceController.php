<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\DriverLicence as DriverLicence;

class DriverLicenceController extends Controller
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
        $driverlicence = DriverLicence::all();

        // load the view and pass the nerds
        return view('admin.driverlicence.index')
            ->with('driverlicence', $driverlicence);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.driverlicence.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
        ]);

        DriverLicence::create($request->all());

        // get all the nerds
        $driverlicence = DriverLicence::all();

        return redirect()->route('admin.driverlicence.index')
        				 ->with('success','Driver licence created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = DriverLicence::find($id);
        return view('admin.driverlicence.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = DriverLicence::find($id);
        return view('admin.driverlicence.edit',compact('item'));
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
            'name' => 'required',
        ]);

        DriverLicence::find($id)->update($request->all());

        // get all the nerds
        $driverlicence = DriverLicence::all();

        return redirect()->route('admin.driverlicence.index')
        				 ->with('success','Driver licence update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        DriverLicence::find($id)->delete();

        return redirect()->route('admin.driverlicence.index')
        				 ->with('success','Driver licence delete successfully');
    }

}
