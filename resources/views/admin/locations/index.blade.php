@extends('layouts.admin')
@section('title', 'Location List')
@section('content')
        <!-- table block -->
<script>
$(function(){
    $("#example_location").dataTable({
		"processing": true,
        "serverSide": true,
		"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 7, 8, 9 ] } ],
		"columns": [
            { "data": "area_code" },
            { "data": "name" },
            { "data": "country" },
            { "data": "state" },
            { "data": "city" },
            { "data": "zip_code" },
            { "data": "phone" },
            { "data": "editcompanies" },
            { "data": "edit" },
            { "data": "delete" }
        ],
        "ajax": "/api/tbllocations"	
	});
})
</script>
        <div class="add-btn">
        	<a href="{{route('admin.locations.create')}}">Create location</a>
        </div>
        <div class="ap-table">
        	<table id="example_location"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                    	<th class="all">Area Code</th>
                        <th class="all">Name</th>
                        <th class="min-tablet-l">Country</th>
                        <th class="all">State</th>
                        <th class="all">City</th>
                        <th class="all">Zip</th>
                        <th class="all">Phone</th>
                        <th class="min-tablet-p">Companies</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
<!--
                <tbody>
                    @foreach ($locations as $location)
                	<tr>
                    	<td>{{$location->area_code}}</td>
                        <td>{{$location->name}}</td>
                        <td>{{$location->country}}</td>
                        <td>{{$location->state}}</td>
                        <td>{{$location->city}}</td>
                        <td>{{$location->zip_code}}</td>
                        <td>{{$location->phone}}</td>
                        <td><a href="{{route('admin.locations.editcompanies', $location->id)}}">Companies</a></td>
                        <td><a href="{{route('admin.locations.edit', $location->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.locations.delete', $location->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
-->
            </table>



        </div>

@endsection
