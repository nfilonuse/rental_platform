@extends('layouts.admin')
@section('title', 'User List')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.users.create')}}">Create user</a>
        </div>
        <div class="ap-table">
        	<table id="example"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                    	<th class="all">First Name</th>
                        <th class="all">Last Name</th>
                        <th class="min-tablet-l">Email</th>
                        <th class="all">Phone</th>
                        <th class="all">Role</th>
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
                        <td>{{$user->phone}}</td>
                        <td>{{$user->role->name}}</td>
                        <td><a href="{{route('admin.users.edit', $user->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.users.delete', $user->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
