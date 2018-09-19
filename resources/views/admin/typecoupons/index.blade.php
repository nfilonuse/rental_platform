@extends('layouts.admin')
@section('title', 'Coupon type list')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.typecoupons.create')}}">Create type</a>
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
                    @foreach ($typecoupons as $typecoupon)
                	<tr>
                        <td>{{$typecoupon->name}}</td>
                        <td>{{$typecoupon->smallname}}</td>
                        <td><a href="{{route('admin.typecoupons.edit', $typecoupon->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.typecoupons.delete', $typecoupon->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
