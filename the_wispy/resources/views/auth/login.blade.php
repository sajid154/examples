@extends('layouts.register')
@section('pageTitle', 'Login')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
				<div id="register-form">
                <div class="card-body register-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
<h3>Sign In</h3>
                        <div class="form-group row">
                        
                            <div class="col-md-12"><label>Your Current Account:</label>
                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <div class="col-md-12">
							<label>Your password:</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row accpet-terms">
                            <div class="col-md-6 setup">
                                <div class="form-check">
                                    <p><input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label></p>
                                </div>
                            </div>
							<div class="col-md-6 setup">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link forget_password" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0 register-btn">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary login-anchor">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
						<div class="dnthave_account">
							<p>Don't have an account yet? <a href="{{ route('register') }}">Sign up now!</a></p>
						</div>
                    </form>
                </div>
            </div>
        </div>
		</div>
    </div>
</div>
@endsection
