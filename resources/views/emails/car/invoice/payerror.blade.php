@extends('layouts.email')

@section('content')

Dear <b>{{$order->billing->billing_first_name}} {{$order->billing->billing_last_name}}</b>,<BR/><BR/>

We are sorry but your payment failed to pay.<BR/>
Please email us at support@gogoflorida.us or call us at +1-954-636-1327<BR/>
so that we can quickly resolve the issue<BR/>

<b>Order #</b> {{$order->id}}

Your reservation information<BR/>
<HR />

<b>Pickup/Dropoff Dropoff Date:</b> {{$order->reservation_pdate}}<br />
<b>Pickup/Dropoff Pickup Date:</b> {{$order->reservation_ddate}}<br />
<b>Pickup Time:</b> {{$order->reservation_ptime}}<br />
<b>Dropoff Time:</b> {{$order->reservation_dtime}}<br />
<b>Pickup City:</b> {{$order->plocation->name}}<br />
<b>Dropoff City:</b> {{$order->dlocation->name}}<br /><br />

Your Billing information<BR/>
<HR />
			
<b>Name:</b> {{$order->billing->billing_first_name}} {{$order->billing->billing_last_name}}<BR />
<b>Address:</b> {{$order->billing->billing_address}}<BR />
<b>Phone #:</b> {{$order->billing->billing_phone}}<BR />
<b>E-mail address :</b> {{$order->billing->billing_email}}<BR /><BR />
<b>Payment method:</b> Online Credit Card PAY PAL

@endsection
