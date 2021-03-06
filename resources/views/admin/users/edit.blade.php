@extends('layouts.admin')
@section('title', 'Edit user - '.$item->first_name.' '.$item->last_name)
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
			{!!Form::open(array('url' => route('admin.users.edit_post',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('first_name', $item->first_name, array('placeholder' => 'First Name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('last_name', $item->last_name, array('placeholder' => 'Last name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('email', $item->email, array('placeholder' => 'Email','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('phone', $item->phone, array('placeholder' => 'Phone','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::password('password', array('placeholder' => 'Password','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::password('password_confirmation', array('placeholder' => 'Confirm password','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::select('role_id', $roles, $item->role_id)}}
		    </div>
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" class="btn btn-success" value="Save">
					<a href="{{route('admin.users.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
