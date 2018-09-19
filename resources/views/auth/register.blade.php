@extends('layouts.app')

@section('content')
<!-- 8 REGISTER FORM -->
<div class="register-form">
	<h2>Create an account</h2>
	<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
       	{{ csrf_field() }}
	    <div class="reg-form">
    		<div class="reg-input reg-left{{ $errors->has('first_name') ? ' has-error' : '' }}">
    			<input id="first-name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus placeholder="First Name" />
				@if ($errors->has('first_name'))
					<span class="help-block">
						<strong>{{ $errors->first('first_name') }}</strong>
					</span>
				@endif
    		</div>
	        <div class="reg-input reg-right{{ $errors->has('last_name') ? ' has-error' : '' }}">
	        	<input id="last-name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required placeholder="Last Name" />
				@if ($errors->has('last_name'))
					<span class="help-block">
						<strong>{{ $errors->first('last_name') }}</strong>
					</span>
				@endif
	        </div>
    	    <div class="reg-input reg-left{{ $errors->has('email') ? ' has-error' : '' }}">
    	    	<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email Address" />
				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
    	    </div>
    	    <div class="reg-input reg-right{{ $errors->has('email_confirmation') ? ' has-error' : '' }}">
    	    	<input id="email_confirmation" type="email" class="form-control" name="email_confirmation" value="{{ old('email_confirmation') }}" required placeholder="Email Address Сonfirmation" />
				@if ($errors->has('email_confirmation'))
					<span class="help-block">
						<strong>{{ $errors->first('email_confirmation') }}</strong>
					</span>
				@endif
    	    </div>
<!--
	        <div class="reg-input reg-left{{ $errors->has('phone') ? ' has-error' : '' }}">
	        	<input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required placeholder="Primary Phone Number" />
				@if ($errors->has('phone'))
					<span class="help-block">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
				@endif
	        </div>
	        <div class="reg-input reg-right{{ $errors->has('second_phone') ? ' has-error' : '' }}">
	        	<input id="second_phone" type="phone" class="form-control" name="second_phone" value="{{ old('second_phone') }}" placeholder="Secondary Phone Number" />
				@if ($errors->has('second_phone'))
					<span class="help-block">
						<strong>{{ $errors->first('second_phone') }}</strong>
					</span>
				@endif
	        </div>
-->
    	    <div class="reg-input reg-left{{ $errors->has('password') ? ' has-error' : '' }}">
    	    	<input id="password" type="password" class="form-control" name="password" value="" required placeholder="Password (6 or more characters)" />
				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
    	    </div>
	        <div class="reg-input reg-right{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	        	<input id="password-confirmation" type="password" class="form-control" name="password_confirmation" value="" required placeholder="Re-enter Password" />
				@if ($errors->has('password_confirmation'))
					<span class="help-block">
						<strong>{{ $errors->first('password_confirmation') }}</strong>
					</span>
				@endif
	        </div>
    	    <div class="clear"></div>
	    </div>
    	<div class="reg-buttons">
	    	<div class="reg-submit"><input type="submit" value="Submit" /></div>
    	    <div class="reg-reset"><input type="reset" value="Reset" /></div>
	        <div class="clear"></div>
    	</div>
	</form>
</div>
<!-- 8 REGISTER FORM -->
<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@endsection
