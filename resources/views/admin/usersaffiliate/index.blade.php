@extends('layouts.admin')
@section('title', 'User List')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.usersaffiliate.create')}}">Create user</a>
        </div>
        <div class="ap-table">
        	<table id="example"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                    	<th class="all">First Name</th>
                        <th class="all">Last Name</th>
                        <th class="min-tablet-l">Email</th>
                        <th class="all">Link</th>
                        <th class="all">Commision</th>
                        <th class="all">Referral ID</th>
                        <th class="min-tablet-p">Report</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                	<tr>
                    	<td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        @if ($user->useraffiliate)
                        <td>{{URL('/').'?ref='.$user->useraffiliate->referral_id}}</td>
                        <td>{{number_format($user->useraffiliate->commission_car,2)}}</td>
                        <td>{{$user->useraffiliate->referral_id}}</td>
                        <td><a href="{{route('admin.usersaffiliate.report', $user->id)}}" target="_blank">Report</a></td>
                        <td><a href="{{route('admin.usersaffiliate.edit', $user->id)}}">Edit</a></td>
                        @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @endif
                        <td><a href="{{route('admin.usersaffiliate.delete', $user->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
