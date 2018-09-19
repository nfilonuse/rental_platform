@extends('layouts.admin')
@section('title', 'Add sipp')
@section('content')

	<div class="row amc-edit-form">
		<div class="col-md-12">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::open(array('url' => route('admin.sipps.create_post'), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('car_model', null, array('placeholder' => 'Sipp','class' => 'form-control'))}}
		    </div>
				<div class="amc-field-cont">
				{{Form::select('car_class_id', $carclasses, null)}}
		    </div>
				<div class="amc-field-cont">
				{{Form::select('car_dor_id', $cardors, null)}}
		    </div>
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" value="Save" class="btn btn-success" value="Add">
					<a href="{{route('admin.sipps.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
