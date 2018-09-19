@extends('layouts.admin')
@section('title', 'Driver licence List')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.driverlicence.create')}}">CREATE DL</a>
        </div>
        <div class="ap-table">
        	<table id="example"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                        <th class="all">Order</th>
                        <th class="all">Name</th>
                        <th class="all">Small Name</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($driverlicence as $item)
                	<tr>
                        <td>{{$item->dl_order}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->smallname}}</td>
                        <td><a href="{{route('admin.driverlicence.edit', $item->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.driverlicence.delete', $item->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
