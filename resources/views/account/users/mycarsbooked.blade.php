@extends('layouts.account')
@section('title', 'My cars booked')
@section('content')
        <!-- table block -->
        <div class="ap-table">
        	<table id="example" class="display responsive nowrap amc_table" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                        <th class="all">Reservation Date</th>
                    	<th class="all">Status</th>
                        <th class="min-tablet-l">Reservation Number</th>
                        <th class="all">Name</th>
                        <th class="all">Phone Number</th>
                    	<th class="all">Company</th>
						<th class="desktop">Pkup-DATE</th>
						<th class="desktop">Drop-DATE</th>
                        <th class="min-tablet-p">Total Amount</th>
                        <th class="min-tablet-p">Total Days</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                	<tr>
                        <td>{{date('m/d/Y H:i',strtotime($order->reservation_date))}}</td>
                        <td>{{($order->reservation_cancel?'Canceled':'')}}</td>
                        <td>{{$order->reservation_number}}</td>
                        <td>{{trim($order->reservation_first_name.' '.$order->reservation_last_name)}}</td>
                        <td>{{$order->reservation_phone_number}}</td>
                    	<td>{{$order->company->name}}</td>
                        <td>{{$order->reservation_pdate}}</td>
                        <td>{{$order->reservation_ddate}}</td>
                        <td>${{($order->coupon?$order->reservation_total_amount-$order->coupon->get_discount_amount($order->reservation_total_amount):$order->reservation_total_amount)}}</td>
                        <td>{{$order->reservation_for_days}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

@endsection
