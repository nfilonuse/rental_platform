<?php

namespace HertzApi\Http\Controllers\Admin;

use Illuminate\Http\Request;

use HertzApi\Http\Controllers\Controller;
use HertzApi\Model\Orders as Orders;

class ReportsController extends Controller
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
    public function report1()
    {
        return view('admin.reports.report1');
    }

    public function report2()
    {
        return view('admin.reports.report2');
    }

    public function exportreport1(Request $request)
    {
		$reportdata=array();
		$sum=0;
		//$from = \DateTime::createFromFormat('!m/d/Y', $request['min'])->getTimestamp();
		//$to = \DateTime::createFromFormat('!m/d/Y', $request['max'])->getTimestamp();
		$from=date('Y-m-d 00:00:00',strtotime($request['min']));
		$to=date('Y-m-d 23:59:59',strtotime($request['max']));
		$reportdata=Orders::where('reservation_buy','=',1)->where('reservation_payment_option','=',1)->whereBetween('reservation_date', array($from, $to))->get();
		foreach ($reportdata as $order)
		{
			//if ($order->reservation_cancel==1) continue;
			if ($order->coupon)
			{
				$sum=$sum+$order->reservation_total_amount-$order->coupon->get_discount_amount($order->reservation_total_amount);
			}
			else
			{
				$sum=$sum+$order->reservation_total_amount;
			}
		}
        $html=view('admin.reports.exportreport1')->with('reportdata',$reportdata)->with('sum',$sum)->render();
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename=sales1_report_'.time().'.xls');
		header("Content-Transfer-Encoding: binary");
		header('Accept-Ranges: bytes');
		echo $html;
    }

    public function exportreport2(Request $request)
    {
		$reportdata=array();
		$sum=0;
		$from=date('Y-m-d 00:00:00',strtotime($request['min']));
		$to=date('Y-m-d 23:59:59',strtotime($request['max']));

		$reportdata=Orders::where('reservation_buy','=',1)->where('reservation_payment_option','=',1)->whereBetween('reservation_date', array($from, $to))->get();
		foreach ($reportdata as $order)
		{
			//if ($order->reservation_cancel==1) continue;
			if ($order->coupon)
			{
				$sum=$sum+$order->reservation_total_amount-$order->coupon->get_discount_amount($order->reservation_total_amount);
			}
			else
			{
				$sum=$sum+$order->reservation_total_amount;
			}
		}
        $html=view('admin.reports.exportreport2')->with('reportdata',$reportdata)->with('sum',$sum)->render();
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename=sales2_report_'.time().'.xls');
		header("Content-Transfer-Encoding: binary");
		header('Accept-Ranges: bytes');
		echo $html;
    }
}
