<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\StatusCoupons as StatusCoupons;

class StatusCouponsController extends Controller
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
        $statuscoupons = StatusCoupons::all();

        // load the view and pass the nerds
        return view('admin.statuscoupons.index')
            ->with('statuscoupons', $statuscoupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.statuscoupons.add');
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

        StatusCoupons::create($request->all());

        // get all the nerds
        $statuscoupons = StatusCoupons::all();

        return redirect()->route('admin.statuscoupons.index')
        				 ->with('success','Status coupon created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = StatusCoupons::find($id);
        return view('admin.statuscoupons.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = StatusCoupons::find($id);
        return view('admin.statuscoupons.edit',compact('item'));
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

        StatusCoupons::find($id)->update($request->all());

        // get all the nerds
        $statuscoupons = StatusCoupons::all();

        return redirect()->route('admin.statuscoupons.index')
        				 ->with('success','Status coupon update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        StatusCoupons::find($id)->delete();

        return redirect()->route('admin.statuscoupons.index')
        				 ->with('success','Status coupon delete successfully');
    }

}
