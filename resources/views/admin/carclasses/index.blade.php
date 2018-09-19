@extends('layouts.admin')
@section('title', 'Car classe list')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.carclasses.create')}}">Create classe</a>
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
                    @foreach ($carclasses as $typerental)
                	<tr>
                        <td>{{$typerental->name}}</td>
                        <td>{{$typerental->smallname}}</td>
                        <td><a href="{{route('admin.carclasses.edit', $typerental->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.carclasses.delete', $typerental->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
