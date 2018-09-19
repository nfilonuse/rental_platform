@extends('layouts.admin')
@section('title', 'Add new coupon')
@section('content')

	<div class="row">
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
			{!!Form::open(array('url' => route('admin.coupons.create_post'), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('number', null, array('placeholder' => 'Number','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('amount', 0, array('placeholder' => 'Amount','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::select('status_coupon_id', $statuscoupons, null)}}
		    </div>
			<div class="amc-field-cont">
				{{Form::select('type_coupon_id', $typecoupons, null)}}
		    </div>
			<div class="amc-field-cont">
				{{Form::select('type_rental_id', $typerentals, null)}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('date_exp', date('Y-m-d H:i:s'), array('placeholder' => 'Date Exp','class' => 'form-control'))}}
		    </div>
			
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" value="Save" class="btn btn-success" value="Add">
					<a href="{{route('admin.coupons.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
