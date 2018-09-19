@extends('layouts.admin')
@section('title', 'Area List')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.areas.create')}}">Create area</a>
        </div>
        <div class="ap-table">
        	<table id="example"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                        <th class="all">Name</th>
                        <th class="all">Small Name</th>
                        <th class="all">Countries</th>
                        <th class="all">States</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                	<tr>
                        <td>{{$area->name}}</td>
                        <td>{{$area->smallname}}</td>
                        <td>{{$area->countries}}</td>
                        <td>{{$area->states}}</td>
                        <td><a href="{{route('admin.areas.edit', $area->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.areas.delete', $area->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
