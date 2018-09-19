
@extends('layouts.admin')
@section('title', 'Edit rate sipps - '.$item->code)
@section('content')

<div class="page_edit_items">

	<div class="p2-title">Select sipps</div>
	{!!Form::open(array('url' => route('admin.rates.updatesipps',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
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
		@foreach ($sipps as $sipp)
    	<li>
        	<input type="checkbox" class="home-checkbox" id="home-checkbox{{$sipp->id}}" {{($item->sipps->find($sipp->id)?'checked="checked"':'')}} name="sipps[]" value="{{$sipp->id}}"/>
			<label for="home-checkbox{{$sipp->id}}">{{$sipp->car_model.' '.$sipp->carclass->name}}</label>
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
