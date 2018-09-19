@extends('layouts.admin')
@section('title', 'Add new account')
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
			{!!Form::open(array('url' => route('admin.accounts.create_post'), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{Form::text('account_number', null, array('placeholder' => 'Account Number','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{form::text('account_password', null, array('placeholder' => 'Account password','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('iata_number', null, array('placeholder' => 'IATA Number','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('account_res_source', null, array('placeholder' => 'Res source','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::select('company_id', $companies, null)}}
		    </div>
			
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" value="Save" class="btn btn-success" value="Add">
					<a href="{{route('admin.accounts.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
