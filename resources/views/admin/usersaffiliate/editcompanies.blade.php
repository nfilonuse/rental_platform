
@extends('layouts.admin')
@section('title', 'Edit location companies - '.$item->name)
@section('content')

<div class="page_edit_items">

	<div class="p2-title">Select companies</div>
	{!!Form::open(array('url' => route('admin.locations.updatecompanies',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<ul>
		@foreach ($companies as $company)
    	<li>
        	<input type="checkbox" class="home-checkbox" id="home-checkbox{{$company->id}}" {{($item->companies->find($company->id)?'checked="checked"':'')}} name="counpany[]" value="{{$company->id}}"/>
			<label for="home-checkbox{{$company->id}}">{{$company->name}}</label>
        </li>
		@endforeach
	</ul>
	<div class="page2-submit">
		<input type="submit" class="btn btn-success" value="Save" /> 
		<a href="{{route('admin.locations.index')}}" class="btn btn-danger">Cancel</a>
		<div class="clear"></div>
	</div>
	{{ Form::close() }}
</div>
@endsection
