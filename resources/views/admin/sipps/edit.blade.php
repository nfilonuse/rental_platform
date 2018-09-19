@extends('layouts.admin')
@section('title', 'Edit rate - '.$item->code)
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
			{!!Form::open(array('url' => route('admin.sipps.edit_post',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('car_model', $item->car_model, array('placeholder' => 'Side','class' => 'form-control'))}}
		    </div>
				<div class="amc-field-cont">
				{{Form::select('car_class_id', $carclasses, $item->car_class_id)}}
		    </div>
				<div class="amc-field-cont">
				{{Form::select('car_dor_id', $cardors, $item->car_dor_id)}}
		    </div>
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" class="btn btn-success" value="Save">
					<a href="{{route('admin.sipps.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
