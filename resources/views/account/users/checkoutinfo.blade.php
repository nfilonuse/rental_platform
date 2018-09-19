@extends('layouts.account')
@section('title', 'Edit Account/Billing info ')
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
			{!!Form::open(array('url' => route('account.users.mybillinginfo_post'), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="row amc-left">
				<h2 class="amc-subtitle">Account Information</h2>
				<div class="amc-field-cont">
					{{form::text('account_first_name', ($item?$item->account_first_name:''), array('placeholder' => 'First Name','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('account_last_name', ($item?$item->account_last_name:''), array('placeholder' => 'Last name','class' => 'form-control'))}}
				</div>

				<div class="amc-field-cont">
					{{Form::text('account_company', ($item?$item->account_company:''), array('placeholder' => 'Company','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('account_phone', ($item?$item->account_phone:''), array('placeholder' => 'Phone','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('account_address', ($item?$item->account_address:''), array('placeholder' => 'Address','class' => 'form-control'))}}
				</div>

				<div class="amc-field-cont">
					{{Form::text('account_email', ($item?$item->account_email:''), array('placeholder' => 'Email','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('account_art', ($item?$item->account_art:''), array('placeholder' => 'Suite/Apt #','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('account_city', ($item?$item->account_city:''), array('placeholder' => 'City','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::select('account_country_id', $countries,($item?$item->account_country_id:''),array('id' => 'account_country_id','onchange' => 'changestate(this.value)'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::select('account_state_id', $states,($item?$item->account_state_id:''),array('id' => 'account_state_id'))}}
				</div>

				<div class="amc-field-cont">
					{{Form::text('account_zip_code', ($item?$item->account_zip_code:''), array('placeholder' => 'Zip code','class' => 'form-control'))}}
				</div>
		    </div>


			<div class="row amc-left">
				<h2 class="amc-subtitle">Billing Information</h2>
				<div class="amc-field-cont">
					{{form::text('billing_first_name', ($item?$item->billing_first_name:''), array('placeholder' => 'First Name','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('billing_last_name', ($item?$item->billing_last_name:''), array('placeholder' => 'Last name','class' => 'form-control'))}}
				</div>

				<div class="amc-field-cont">
					{{Form::text('billing_company', ($item?$item->billing_company:''), array('placeholder' => 'Company','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('billing_phone', ($item?$item->billing_phone:''), array('placeholder' => 'Phone','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('billing_address', ($item?$item->billing_address:''), array('placeholder' => 'Address','class' => 'form-control'))}}
				</div>

				<div class="amc-field-cont">
					{{Form::text('billing_email', ($item?$item->billing_email:''), array('placeholder' => 'Email','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('billing_art', ($item?$item->billing_art:''), array('placeholder' => 'Suite/Apt #','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::text('billing_city', ($item?$item->billing_city:''), array('placeholder' => 'City','class' => 'form-control'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::select('billing_country_id', $countries,($item?$item->billing_country_id:''),array('id' => 'billing_country_id','onchange' => 'changestate(this.value)'))}}
				</div>
				<div class="amc-field-cont">
					{{Form::select('billing_state_id', $states,($item?$item->billing_state_id:''),array('id' => 'billing_state_id'))}}
				</div>

				<div class="amc-field-cont">
					{{Form::text('billing_zip_code', ($item?$item->billing_zip_code:''), array('placeholder' => 'Zip code','class' => 'form-control'))}}
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" class="btn btn-success" value="Save">
					 <div class="clear"></div>
				</div>
				 <div class="clear"></div>
			</div>
			 <div class="clear"></div>
			{{ Form::close() }}
			 <div class="clear"></div>
		</div>
		 <div class="clear"></div>
	</div>
@endsection
