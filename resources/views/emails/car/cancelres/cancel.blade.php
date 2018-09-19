@extends('layouts.email')



@section('content')



Hello, <BR/>

<b>Customer Name :</b> {{$order->billing->billing_first_name}} {{$order->billing->billing_last_name}},<BR/>

<b>Reservation Number :</b> {{$order->reservation_number}},<BR/>

<b>Cancellation Number :</b> {{$order->reservation_cancel_number}},<BR/>

<b>Voucher Number :</b> {{$order->voucher_number}},<BR/>

@if($order->coupon)

<b>Voucher Value :</b> $ {{round($order->reservation_total_amount-$order->coupon->get_discount_amount($order->reservation_total_amount),2)}}<BR/><BR/>

@else

<b>Voucher Value :</b> $ {{round($order->reservation_total_amount,2)}}<BR/><BR/>

@endif

<b>Car Type :</b> {{$order->car_class_code}}<BR/>

<b>Rate Code :</b> {{$order->rate_code}}<BR/><BR/>





<b>Pickup Location :</b> {{$order->plocation->name}}<br />

<b>Pickup Date:</b> {{$order->reservation_pdate}} {{$order->reservation_ptime}}<br />



<b>Dropoff Location :</b> {{$order->dlocation->name}}<br />

<b>Dropoff Date:</b> {{$order->reservation_ddate}} {{$order->reservation_dtime}}<br /><br />

<!--

<b>Agent's Name :</b> <br />

-->

<b>Message: </b><br> {{$order->reservation_cancel_comments}}<br /><br />



@endsection

