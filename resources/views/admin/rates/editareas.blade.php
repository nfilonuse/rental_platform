
@extends('layouts.admin')
@section('title', 'Edit rate areas - '.$item->code)
@section('content')

<div class="page_edit_items">

	<div class="p2-title">Select areas</div>
	{!!Form::open(array('url' => route('admin.rates.updateareas',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
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
		@foreach ($areas as $area)
    	<li>
        	<input type="checkbox" class="home-checkbox" id="home-checkbox{{$area->id}}" {{($item->areas->find($area->id)?'checked="checked"':'')}} name="areas[]" value="{{$area->id}}"/>
			<label for="home-checkbox{{$area->id}}">{{$area->name}}</label>
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
