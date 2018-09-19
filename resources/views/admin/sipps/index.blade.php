@extends('layouts.admin')
@section('title', 'Sipp List')
@section('content')
        <!-- table block -->
        <div class="add-btn">
        	<a href="{{route('admin.sipps.create')}}">Create sipp</a>
        </div>
        <div class="ap-table">
        	<table id="example"  class="display responsive nowrap" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
                        <th class="all">Sipp</th>
                        <th class="all">Class</th>
                        <th class="all">Dor</th>
                        <th class="all">Company</th>
                        <th class="min-tablet-p">Edit</th>
                        <th class="min-tablet-p">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sipps as $sipp)
                	<tr>
                        <td>{{$sipp->car_model}}</td>
                        <td>{{$sipp->carclass->name}}</td>
                        <td>{{$sipp->dor->name}}</td>
                        <td><a href="{{route('admin.sipps.editcompanies', $sipp->id)}}">{{(count($sipp->companies)<=0?'No companies':$sipp->companies_str())}}</a></td>
                        <td><a href="{{route('admin.sipps.edit', $sipp->id)}}">Edit</a></td>
                        <td><a href="{{route('admin.sipps.delete', $sipp->id)}}" onclick="javascript: return confirm('Are you sure?');">Remove</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>


@endsection
