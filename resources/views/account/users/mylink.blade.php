@extends('layouts.account')
@section('title', 'Your Affiliate Link')
@section('content')

	<div class="row amc-edit-form">
		<div class="col-md-12">
			<div class="row amc-left mylink">
				<h2 class="amc-subtitle">HTML code with your Affiliate Link</h2>
				<div class="amc-field-cont">
					<textarea><a href="{{ $urllink }}" target="_blank">Visit GoGoFlorida.com</a></textarea>
				</div>
				<div class="amc-field-cont">
					<p class="text1">Above HTML code in action. Click Here >> <a href="{{ $urllink }}" terget="_blank">Visit GoGoFlorida.com</a></p>
					<p class="text2">Copy URL below. Put on your sile or use in your web browser</p>
					<p class="text3">{{ $urllink }}</p>
				</div>
		    </div>
			 <div class="clear"></div>
		</div>
		 <div class="clear"></div>
	</div>
@endsection
