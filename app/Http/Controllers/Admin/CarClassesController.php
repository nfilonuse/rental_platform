<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;
use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\CarClasses as CarClasses;

class CarClassesController extends Controller
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
        $carclasses = CarClasses::all();

        // load the view and pass the nerds
        return view('admin.carclasses.index')
            ->with('carclasses', $carclasses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.carclasses.add');
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

        CarClasses::create($request->all());

        // get all the nerds
        $carclasses = CarClasses::all();

        return redirect()->route('admin.carclasses.index')
        				 ->with('success','Type rental created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = CarClasses::find($id);
        return view('admin.carclasses.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = CarClasses::find($id);
        return view('admin.carclasses.edit',compact('item'));
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

        CarClasses::find($id)->update($request->all());

        // get all the nerds
        $carclasses = CarClasses::all();

        return redirect()->route('admin.carclasses.index')
        				 ->with('success','Type rental update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        CarClasses::find($id)->delete();

        return redirect()->route('admin.carclasses.index')
        				 ->with('success','Type rental delete successfully');
    }

}
