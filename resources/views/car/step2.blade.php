@extends('layouts.app')

@section('content')
<!-- 2 PAGE -->
<form role="form" id="form-step2" method="POST" action="{{ route('web.rentcar.step3cook',$data['company_id']) }}">
        {{ csrf_field() }}
<div class="page2">
<!--
    <div class="page2-layer" style="display:block">
    	<a class="page2-layer-close" href=""></a>
        <div class="page2-layer-title">Supplemental Liability Insurance</div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in </p>
    </div>
-->
	<input type="hidden" name="location-pickup-value" value="{{$data['location-pickup-value']}}"/>
	<input type="hidden" name="date-pickup-value" value="{{$data['date-pickup-value']}}"/>
	<input type="hidden" name="location-dropoff-value" value="{{$data['location-dropoff-value']}}"/>
	<input type="hidden" name="date-dropoff-value" value="{{$data['date-dropoff-value']}}"/>
	<input type="hidden" name="country" value="{{$data['country']}}"/>
	<input type="hidden" name="driverage" value="{{$data['driverage']}}"/>
	<input type="hidden" name="company_id" id="company_id" value="{{$data['company_id']}}"/>
	<input type="hidden" id="ratecode" name="ratecode" value=""/>
	<div class="p2-title">Build your own rental package by checking the boxes below:</div>
	<ul>
		@foreach ($data['packages'] as $package)
    	<li class="amc_qtip" title="{{$package->name}}" alt="{{$package->description}}">
        	<input type="checkbox" class="home-checkbox" id="home-checkbox{{$package->id}}" name="package[]" value="{{$package->id}}"/>
			<label for="home-checkbox{{$package->id}}">{{$package->name}}</label>
        </li>
		@endforeach
	</ul>
	<div class="result_code_cont">
		<div class="p2-title">Code not found yet.</div>
		<div class="result_code">
		</div>
	</div>
	<div class="page2-submit"><input type="submit" value="Next" /></div>


</div><!--   / page 2   --->
<!-- 2 PAGE -->
</form>
@endsection
