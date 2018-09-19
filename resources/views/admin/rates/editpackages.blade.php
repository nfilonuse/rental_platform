
@extends('layouts.admin')
@section('title', 'Edit rate packages - '.$item->code)
@section('content')

<div class="page_edit_items">

	<div class="p2-title">Select packages</div>
	{!!Form::open(array('url' => route('admin.rates.updatepackages',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
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
		@foreach ($packages as $package)
    	<li>
        	<input type="checkbox" class="home-checkbox" id="home-checkbox{{$package->id}}" {{($item->packages->find($package->id)?'checked="checked"':'')}} name="packages[]" value="{{$package->id}}"/>
			<label for="home-checkbox{{$package->id}}">{{$package->name}}</label>
        </li>
		@endforeach
	</ul>
	<div class="page2-submit">
		<input type="submit" class="btn btn-success" value="Save" /> 
		<a href="{{route('admin.rates.index')}}" class="btn btn-danger">Cancel</a>
		<div class="clear"></div>
	</div>
	{{ Form::close() }}
</div>
@endsection
