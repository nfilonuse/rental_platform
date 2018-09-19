@extends('layouts.app')

@section('content')
<!-- 7 LOGIN FORM -->
<div class="login-form">
	<h2>Login</h2>
	<p class="login-info">To complete your reservation, log into your GoGo account or create a new one.<br>If you prefer, you can simply checkout as a guest</p>
	<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
		<div class="log-username{{ $errors->has('email') ? ' has-error' : '' }}">
			<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail" required autofocus />
			@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</div>
	    <div class="log-pass{{ $errors->has('password') ? ' has-error' : '' }}">
	    	<input id="password" type="password" class="form-control" name="password" placeholder="Password" required/>
			@if ($errors->has('password'))
            	<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
	    </div>
    	<div class="log-buttons">
    		<div class="log-login"><input type="submit" value="Login" /></div>
	        <div class="log-guest"><a href="{{route('web.rentcar.billinggolikeguest')}}">Checkout as Guest</a></div>
    	    <div class="clear"></div>
	    </div>
    	<div class="log-links">
    		<a class="log-forgot-pass" href="{{ route('password.request') }}" >Forgot Password</a>
	        <a class="log-create-acc" href="{{ route('register') }}" >Create an Account</a>
    	    <div class="clear"></div>
	    </div>
	</form>
</div>

@endsection
