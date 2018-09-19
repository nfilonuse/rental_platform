@extends('layouts.admin')
@section('title', 'Edit - '.$item->name)
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
			{!!Form::open(array('url' => route('admin.coupons.edit_post',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('number', $item->number, array('placeholder' => 'Number','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('amount', $item->amount, array('placeholder' => 'Amount','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::select('status_coupon_id', $statuscoupons, $item->status_coupon_id)}}
		    </div>
			<div class="amc-field-cont">
				{{Form::select('type_coupon_id', $typecoupons, $item->type_coupon_id)}}
		    </div>
			<div class="amc-field-cont">
				{{Form::select('type_rental_id', $typerentals, $item->type_rental_id)}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('date_exp', $item->date_exp, array('placeholder' => 'Date Exp','class' => 'form-control datepicker'))}}
		    </div>

			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" class="btn btn-success" value="Save">
					<a href="{{route('admin.coupons.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
