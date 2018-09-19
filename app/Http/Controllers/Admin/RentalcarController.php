<?php

namespace HertzApi\Http\Controllers\Admin;

use HertzApi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use HertzApi\Model\User as User;
use HertzApi\Model\Orders as Orders;
use HertzApi\Model\CarService as CarService;

use Auth;

class RentalcarController extends Controller
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
    public function cancelres()
    {
		$success='';
		$errors='';
		if (\Session::has('success'))
			$success=\Session::get('success');
		if (\Session::has('errors'))
			$errors=\Session::get('errors');
        return view('admin.rentalcaraction.cancelres')->with('errors',$errors)->with('success',$success);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updatecancelres(Request $request)
    {
		$order=Orders::where('reservation_number',$request->get('reservation_number'))->orWhere('voucher_number',$request->get('reservation_number'))->first();
		if ($order)
		{
			$data=Array(
				'account_number' => $order->account->account_number,
				'RATE_CODE' => $order->rate->code,
				'COMPANY_NAME' => $order->company->name,
				'company_id' => $order->company->id,
				'CAR_TYPE' => '',
				'VOUCHER_NUMBER' => $order->voucher_number,
				'LOYALTY' => '',
				'FIRST_NAME' => $order->reservation_first_name,
				'LAST_NAME' => $order->reservation_last_name,
				'PICKUP_DATETIME' => $order->reservation_pdate.'T'.$order->reservation_ptime.':00',
				'PICKUP_CITYCODE' => $order->plocation->area_code,
				'DROPOFF_DATETIME' => $order->reservation_ddate.'T'.$order->reservation_dtime.':00',
				'DROPOFF_CITYCODE' => $order->dlocation->area_code,
				'TOUR_OPERATOR_NBR' => '',
				'car_company_id' => $order->company->id,
				'RequestorID_ID' => $order->reservation_number,
				'car_company_webservice_url'=> 	'',
				'CONFIRMATION_NBR'=> $order->reservation_number,
			);

			$results=CarService::CancelCar($order->company->id,$data);
			if ($results['error'])
			{
		        return redirect()->route('admin.rentalcaraction.cancelres')->with('errors',$results['error_text']);
			}
			else
			{
				$order->reservation_cancel_number=$results['result']['cancellation_number'];
				$order->reservation_cancel_comments=$request->get('message');
				$order->reservation_cancel=1;
				$order->reservation_cancel_date=date('Y-m-d H:i:s');
				$order->save();
				$order->sendcancel();

			}
		}
		else
		{
		        return redirect()->route('admin.rentalcaraction.cancelres')->with('errors','Number is wrong, please try again');
		}

        return redirect()->route('admin.rentalcaraction.cancelres')
        				 ->with('success','Rental with number #'.$order->reservation_number.' canceled successfully');
    }

/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function retrieveres()
    {
        // get all the nerds
        $orders = Orders::where('reservation_buy','=',1)->get();

        // load the view and pass the nerds
        return view('admin.rentalcaraction.retrieveres')
            ->with('orders', $orders);
    }
}
