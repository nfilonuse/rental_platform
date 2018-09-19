@extends('layouts.admin')
@section('title', 'Coupon status list')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.statuscoupons.create')}}">Create status</a>
        </div>
        <div class="ap-table">
        	<table id="example"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                        <th class="all">Name</th>
                        <th class="all">Small Name</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statuscoupons as $statuscoupon)
                	<tr>
                        <td>{{$statuscoupon->name}}</td>
                        <td>{{$statuscoupon->smallname}}</td>
                        <td><a href="{{route('admin.statuscoupons.edit', $statuscoupon->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.statuscoupons.delete', $statuscoupon->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
