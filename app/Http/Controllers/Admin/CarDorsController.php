<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;
use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\CarDors as CarDors;

class CarDorsController extends Controller
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
        $cardors = CarDors::all();

        // load the view and pass the nerds
        return view('admin.cardors.index')
            ->with('cardors', $cardors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.cardors.add');
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

        CarDors::create($request->all());

        // get all the nerds
        $cardors = CarDors::all();

        return redirect()->route('admin.cardors.index')
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
        $item = CarDors::find($id);
        return view('admin.cardors.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = CarDors::find($id);
        return view('admin.cardors.edit',compact('item'));
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

        CarDors::find($id)->update($request->all());

        // get all the nerds
        $cardors = CarDors::all();

        return redirect()->route('admin.cardors.index')
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
        CarDors::find($id)->delete();

        return redirect()->route('admin.cardors.index')
        				 ->with('success','Type rental delete successfully');
    }

}
