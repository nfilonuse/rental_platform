@extends('layouts.app')

@section('content')
<!-- 8 LOGIN FORM RESET PASSWORD-->
<div class="login-form reset-password">
	<h2>Reset Password</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
	<form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
		<div class="log-username{{ $errors->has('email') ? ' has-error' : '' }}">
			<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="E-Mail" required autofocus />
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
	    <div class="log-pass{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	    	<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation Password" required/>
			@if ($errors->has('password_confirmation'))
            	<span class="help-block">
					<strong>{{ $errors->first('password_confirmation') }}</strong>
				</span>
			@endif
	    </div>
    	<div class="log-buttons">
	        <div class="log-guest"><input type="submit" value="Reset Password" /></div>
    	    <div class="clear"></div>
	    </div>
	</form>
</div>
@endsection
