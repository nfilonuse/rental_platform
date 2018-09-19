@extends('layouts.admin')
@section('title', 'Cancel Car Reservation')
@section('content')

	<div class="row amc-edit-form">
		<div class="col-md-12">
			@if (trim($errors) != '')
				<div class="alert alert-danger">
					<ul>
						<li>{{ $errors }}</li>
					</ul>
				</div>
			@endif
			@if (trim($success) != '')
				<div class="alert">
					<ul>
						<li>{{ $success }}</li>
					</ul>
				</div>
			@endif
			{!!Form::open(array('url' => route('admin.rentalcaraction.updatecancelres'), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('reservation_number', null, array('placeholder' => 'Voucher # / RES #','class' => 'form-control'))}}
		    </div>
<!--
			<div class="amc-field-cont">
				{{Form::text('agency_name', null, array('placeholder' => 'Agency Name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('agent_name', null, array('placeholder' => 'Agent`s Name','class' => 'form-control'))}}
		    </div>
-->
			<div class="amc-field-cont">
				{{Form::textarea('message', null, array('placeholder' => 'Message','class' => 'form-control'))}}
		    </div>
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" class="btn btn-success" value="Cancel">
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
