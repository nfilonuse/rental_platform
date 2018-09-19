<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\Areas as Areas;

class AreasController extends Controller
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
        $areas = Areas::all();

        // load the view and pass the nerds
        return view('admin.areas.index')
            ->with('areas', $areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.areas.add');
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

        Areas::create($request->all());

        // get all the nerds
        $areas = Areas::all();

        return redirect()->route('admin.areas.index')
        				 ->with('success','Area created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Areas::find($id);
        return view('admin.areas.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = Areas::find($id);
        return view('admin.areas.edit',compact('item'));
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

        Areas::find($id)->update($request->all());

        // get all the nerds
        $areas = Areas::all();

        return redirect()->route('admin.areas.index')
        				 ->with('success','Area update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Areas::find($id)->delete();

        return redirect()->route('admin.areas.index')
        				 ->with('success','Area delete successfully');
    }

}
