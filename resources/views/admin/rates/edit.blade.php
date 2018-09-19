@extends('layouts.admin')
@section('title', 'Edit rate - '.$item->code)
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
			{!!Form::open(array('url' => route('admin.rates.edit_post',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
			<div class="amc-field-cont">
				{{form::text('code', $item->code, array('placeholder' => 'Code','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('name', $item->name, array('placeholder' => 'Name','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::text('rate_order', $item->rate_order, array('placeholder' => 'Order','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::textarea('description', $item->description, array('placeholder' => 'Description','class' => 'form-control'))}}
		    </div>
			<div class="amc-field-cont">
				{{Form::checkbox('disable', $item->disable, ($item->disable==1))}}  <label for="disable">Disable</label>
		    </div>
			<div class="row">
				<div class="col-xs-12 col-md-12 text-center">
					<input type="submit" class="btn btn-success" value="Save">
					<a href="{{route('admin.rates.index')}}" class="btn btn-danger">Cancel</a>
					 <div class="clear"></div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
