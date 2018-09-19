@extends('layouts.admin')
@section('title', 'Edit - '.$item->name)
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
			{!!Form::open(array('url' => route('admin.packages.edit_post',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{Form::text('name', $item->name, array('placeholder' => 'Name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{form::text('smallname', $item->smallname, array('placeholder' => 'Small name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::textarea('description', $item->description, array('placeholder' => 'Description','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{form::text('package_order', $item->package_order, array('placeholder' => '0','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::checkbox('defaultcheck', $item->defaultcheck, ($item->defaultcheck==1))}}  <label for="defaultcheck">Default check</label>
		    </div>
				<div class="amc-field-cont">
				{{Form::checkbox('is_additional_details', $item->is_additional_details, ($item->is_additional_details==1))}}  <label for="is_additional_details">IS Additional details</label>
		    </div>
				
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" class="btn btn-success" value="Save">
					<a href="{{route('admin.packages.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
