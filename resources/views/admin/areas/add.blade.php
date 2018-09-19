@extends('layouts.admin')
@section('title', 'Add new area')
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
			{!!Form::open(array('url' => route('admin.areas.create_post'), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{Form::text('name', null, array('placeholder' => 'Area name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{form::text('smallname', null, array('placeholder' => 'Small name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{form::text('countries', null, array('placeholder' => 'Countries(by a comma)','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{form::text('states', null, array('placeholder' => 'States(by a comma)','class' => 'form-control'))}}
		    </div>
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" value="Save" class="btn btn-success" value="Add">
					<a href="{{route('admin.areas.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
