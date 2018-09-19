<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\TypeCoupons as TypeCoupons;

class TypeCouponsController extends Controller
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
        $typecoupons = TypeCoupons::all();

        // load the view and pass the nerds
        return view('admin.typecoupons.index')
            ->with('typecoupons', $typecoupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.typecoupons.add');
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

        TypeCoupons::create($request->all());

        // get all the nerds
        $typecoupons = TypeCoupons::all();

        return redirect()->route('admin.typecoupons.index')
        				 ->with('success','Type coupon created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = TypeCoupons::find($id);
        return view('admin.typecoupons.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = TypeCoupons::find($id);
        return view('admin.typecoupons.edit',compact('item'));
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

        TypeCoupons::find($id)->update($request->all());

        // get all the nerds
        $typecoupons = TypeCoupons::all();

        return redirect()->route('admin.typecoupons.index')
        				 ->with('success','Type coupon update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        TypeCoupons::find($id)->delete();

        return redirect()->route('admin.typecoupons.index')
        				 ->with('success','Type coupon delete successfully');
    }

}
