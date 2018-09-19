@extends('layouts.admin')
@section('title', 'Retrive Reservation')
@section('content')
        <!-- table block -->
        <div class="ap-table">
        	<table id="example" class="display responsive nowrap amc_table" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                    	<th class="all">Status</th>
                    	<th class="all">Company</th>
                        <th class="min-tablet-l">Reservation Number</th>
                        <th class="all">Reservation Date</th>
                        <th class="all">Name</th>
                        <th class="min-tablet-p">Total Amount</th>
                        <th class="min-tablet-p">Total Days</th>
                        <th class="min-tablet-p">Print</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                	<tr>
                    	<td>{{($order->reservation_cancel?'Canceled':($order->reservation_buy?'Bought':'Pending'))}}</td>
                    	<td>{{$order->company->name}}</td>
                        <td>{{$order->reservation_number}}</td>
                        <td>{{$order->reservation_date}}</td>
                        <td>{{trim($order->reservation_first_name.' '.$order->reservation_last_name)}}</td>
                        <td>${{$order->reservation_total_amount}}</td>
                        <td>{{$order->reservation_for_days}}</td>
						@if ($order->reservation_buy&&$order->reservation_cancel==0)
                        <td><a href="/voucher/{{$order->company_id}}/{{$order->id}}" target="_blank">print</a></td>
						@else
                        <td></td>
						@endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

@endsection
