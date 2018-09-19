@extends('layouts.admin')
@section('title', 'Package List')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.packages.create')}}">Create package</a>
        </div>
        <div class="ap-table">
        	<table id="example"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                    	<th class="all">Order</th>
                    	<th class="all">Name</th>
                        <th class="min-tablet-l">Small Name</th>
                        <th class="all">Description</th>
                        <th class="all">Def check</th>
                        <th class="all">Is AD</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                	<tr>
					
                    	<td>{{$package->package_order}}</td>
                    	<td>{{$package->name}}</td>
                        <td>{{$package->smallname}}</td>
                        <td title="{{$package->description}}">{{substr($package->description,0,30).'...'}}</td>
                    	<td>{{($package->defaultcheck==0?'No':'Yes')}}</td>
                    	<td>{{($package->is_additional_details==0?'No':'Yes')}}</td>
                        <td><a href="{{route('admin.packages.edit', $package->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.packages.delete', $package->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

@endsection
