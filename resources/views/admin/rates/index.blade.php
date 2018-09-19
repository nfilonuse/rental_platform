@extends('layouts.admin')
@section('title', 'Rate List')
@section('content')
        <!-- table block -->
<script>
$(function(){
    $("#example_rate").dataTable({
		"processing": true,
        "serverSide": true,
		"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 4, 5, 6, 7, 8, 9 ] } ],
		"columns": [
            { "data": "code" },
            { "data": "name" },
            { "data": "rate_order" },
            { "data": "disable" },
            { "data": "editsipps" },
            { "data": "editareas" },
            { "data": "editaccounts" },
            { "data": "editpackages" },
            { "data": "edit" },
            { "data": "delete" }
        ],
        "ajax": "/api/tblrates"	
	});
})
</script>
        <div class="add-btn">
        	<a href="{{route('admin.rates.create')}}">Create rate</a>
        </div>
        <div class="ap-table">
        	<table id="example_rate"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                    	<th class="all">Code</th>
                        <th class="all">Name</th>
                        <th class="all">Order</th>
                        <th class="all">Disable</th>
                        <th class="min-tablet-p">Sipps</th>
                        <th class="min-tablet-p">Areas</th>
                        <th class="min-tablet-p">Accounts</th>
                        <th class="min-tablet-p">Packages</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
<!--
                <tbody>
                    @foreach ($rates as $rate)
                	<tr>
                    	<td>{{$rate->code}}</td>
                        <td title="{{$rate->name}}">{{$rate->name}}</td>
                    	<td>{{$rate->rate_order}}</td>
                    	<td>{{($rate->disable==0?'No':'Yes')}}</td>
                        <td><a href="{{route('admin.rates.editareas', $rate->id)}}">{{(count($rate->areas)<=0?'No areas':$rate->areas_str())}}</a></td>
                        <td><a href="{{route('admin.rates.editaccounts', $rate->id)}}">Accounts</a></td>
                        <td><a href="{{route('admin.rates.editpackages', $rate->id)}}">{{(count($rate->packages)<=0?'No packages':$rate->packages_str())}}</a></td>
                        <td><a href="{{route('admin.rates.edit', $rate->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.rates.delete', $rate->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
-->
            </table>



        </div>

@endsection
