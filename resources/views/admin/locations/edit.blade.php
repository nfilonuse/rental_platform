@extends('layouts.admin')
@section('title', 'Edit client - '.$item->area_code)
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
			{!!Form::open(array('url' => route('admin.locations.edit_post',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('area_code', $item->area_code, array('placeholder' => 'Area Code','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('name', $item->name, array('placeholder' => 'Area name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('country', $item->country, array('placeholder' => 'Country','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('state', $item->state, array('placeholder' => 'State','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('city', $item->city, array('placeholder' => 'City','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('address', $item->address, array('placeholder' => 'Address','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('zip_code', $item->zip_code, array('placeholder' => 'Zip Code','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('phone', $item->phone, array('placeholder' => 'Phone','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('location_order', $item->location_order, array('placeholder' => 'Order','class' => 'form-control'))}}
		    </div>
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" class="btn btn-success" value="Save">
					<a href="{{route('admin.locations.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
