<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\Coupons as Coupons;
use HertzApi\Model\TypeCoupons as TypeCoupons;
use HertzApi\Model\TypeRentals as TypeRentals;
use HertzApi\Model\StatusCoupons as StatusCoupons;

class CouponsController extends Controller
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
        $coupons = Coupons::all();

        // load the view and pass the nerds
        return view('admin.coupons.index')
            ->with('coupons', $coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		$typecoupons_=TypeCoupons::all();
		$typecoupons=array(''=>'Select coupon type');
		foreach ($typecoupons_ as $typecoupon)
		{
			$typecoupons[$typecoupon->id]=$typecoupon->name;
		}

		$typerentals_=TypeRentals::all();
		$typerentals=array(''=>'Select rental type');
		foreach ($typerentals_ as $typerental)
		{
			$typerentals[$typerental->id]=$typerental->name;
		}

		$statuscoupons_=StatusCoupons::all();
		$statuscoupons=array(''=>'Select coupon status');
		foreach ($statuscoupons_ as $statuscoupon)
		{
			$statuscoupons[$statuscoupon->id]=$statuscoupon->name;
		}

        return view('admin.coupons.add')
			->with('statuscoupons', $statuscoupons)
			->with('typecoupons', $typecoupons)
			->with('typerentals', $typerentals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'type_rental_id' => 'required',
            'type_coupon_id' => 'required',
            'status_coupon_id' => 'required',
            'number' => 'required',
            'amount' => 'required',
        ]);
		$request['usecoupone']=0;
        Coupons::create($request->all());

        // get all the nerds
        $coupons = Coupons::all();

        return redirect()->route('admin.coupons.index')
        				 ->with('success','Coupon created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Coupons::find($id);
        return view('admin.coupons.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $item = Coupons::find($id);

		$typecoupons_=TypeCoupons::all();
		$typecoupons=array(''=>'Select coupon type');
		foreach ($typecoupons_ as $typecoupon)
		{
			$typecoupons[$typecoupon->id]=$typecoupon->name;
		}

		$typerentals_=TypeRentals::all();
		$typerentals=array(''=>'Select rental type');
		foreach ($typerentals_ as $typerental)
		{
			$typerentals[$typerental->id]=$typerental->name;
		}

		$statuscoupons_=StatusCoupons::all();
		$statuscoupons=array(''=>'Select coupon status');
		foreach ($statuscoupons_ as $statuscoupon)
		{
			$statuscoupons[$statuscoupon->id]=$statuscoupon->name;
		}

        return view('admin.coupons.edit',compact('item'))
			->with('statuscoupons', $statuscoupons)
			->with('typecoupons', $typecoupons)
			->with('typerentals', $typerentals);
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
            'type_rental_id' => 'required',
            'type_coupon_id' => 'required',
            'status_coupon_id' => 'required',
            'number' => 'required',
            'amount' => 'required',
        ]);
		$request['usecoupone']=Coupons::find($id)->usecoupone;

        Coupons::find($id)->update($request->all());

        // get all the nerds
        $coupons = Coupons::all();

        return redirect()->route('admin.coupons.index')
        				 ->with('success','Coupon update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Coupons::find($id)->delete();

        return redirect()->route('admin.coupons.index')
        				 ->with('success','Coupon delete successfully');
    }

}
