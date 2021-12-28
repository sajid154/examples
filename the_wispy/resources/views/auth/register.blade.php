@extends('layouts.register')
@section('pageTitle', 'Register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
				<div id="register-form">
                <div class="card-body register-form">
                    <form method="POST" action="{{ route('register') }}">

						<h3>Create your account</h3>
                        @csrf

                        <!--<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> -->

                            <!--<div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>-->

                        <div class="form-group row">
                            <!--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>-->

                            <div class="col-md-12">
								<label>Your Current Account:</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="col-md-12">
								<label>Your Password:</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label> -->

                            <div class="col-md-12">
								<label>Confirm Password:</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row mb-0 register-btn">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Sign Up') }}
                                </button>
                            </div>
                        </div>
						<div class="agreed_user">
							<p>By signing up, I hereby agree to the <a target="_blank" href="https://www.thewispy.com/terms/">Terms</a> and <a target="_blank" href="https://www.thewispy.com/privacy-policy/">Privacy Policy</a></p>
						</div> 
                    </form>
					<div class="already_have_account">
						<p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
					</div>
                </div>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
