
@extends('layouts.admin')
@section('title', 'Edit rate accounts - '.$item->code)
@section('content')

<div class="page_edit_items">

	<div class="p2-title">Select accounts</div>
	{!!Form::open(array('url' => route('admin.rates.updateaccounts',$item->id), 'method' => 'post', "enctype" => "multipart/form-data"))!!}
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<ul>
		@foreach ($accounts as $account)
    	<li>
        	<input type="checkbox" class="home-checkbox" id="home-checkbox{{$account->id}}" {{($item->accounts->find($account->id)?'checked="checked"':'')}} name="accounts[]" value="{{$account->id}}"/>
			<label for="home-checkbox{{$account->id}}">{{$account->id.' '.$account->company->name.'   #'.$account->account_number}}</label>
        </li>
		@endforeach
	</ul>
	<div class="page2-submit">
		<input type="submit" class="btn btn-success" value="Save" /> 
		<a href="{{route('admin.rates.index')}}" class="btn btn-danger">Cancel</a>
		<div class="clear"></div>
	</div>
	{{ Form::close() }}
</div>
@endsection
