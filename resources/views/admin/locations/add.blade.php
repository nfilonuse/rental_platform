@extends('layouts.admin')
@section('title', 'Add new location')
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
			{!!Form::open(array('url' => route('admin.locations.create_post'), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('area_code', null, array('placeholder' => 'Area Code','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('name', null, array('placeholder' => 'Area name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('country', null, array('placeholder' => 'Country','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('state', null, array('placeholder' => 'State','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('city', null, array('placeholder' => 'City','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('zip_code', null, array('placeholder' => 'Zip Code','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('location_order', null, array('placeholder' => 'Order','class' => 'form-control'))}}
		    </div>
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" value="Save" class="btn btn-success" value="Add">
					<a href="{{route('admin.locations.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
