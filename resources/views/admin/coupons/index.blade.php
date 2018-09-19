@extends('layouts.admin')
@section('title', 'Coupon list')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.coupons.create')}}">Create coupon</a>
        </div>
        <div class="ap-table">
        	<table id="example"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                    	<th class="all">Number</th>
                        <th class="min-tablet-l">Amount</th>
                        <th class="all">Type coupon</th>
                        <th class="all">Status coupon</th>
                        <th class="all">Type rental</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                	<tr>
                    	<td>{{$coupon->number}}</td>
                        <td>{{$coupon->amount}} {{$coupon->typecoupon->smallname}}</td>
                        <td>{{$coupon->typecoupon->name}}</td>
                        <td>{{$coupon->statuscoupon->name}}</td>
                        <td>{{$coupon->typerental->name}}</td>
                        <td><a href="{{route('admin.coupons.edit', $coupon->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.coupons.delete', $coupon->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
