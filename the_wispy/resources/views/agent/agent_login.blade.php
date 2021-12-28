@extends('layouts.register_agent')
@section('pageTitle', 'Login')
@section('styles')

<style type="text/css">

.Affiliate-login {
    margin-bottom: 15px;
    margin-top: 20px;
    background: #ffffff;box-shadow: 0 0 15px 0 rgba(153,153,153,.4);
}
.Affiliate-login-Detail .col-md-12 {
    padding-left: 0px;
}
.portlet-title {
    padding: 10px;
}
.Affiliate-login-body {
    background: #ffffff;
    padding: 20px;min-height: 460px;
}

</style>



@endsection
@section('content')
    <section class="container">
    <div class="row justify-content-center">
        
<div class="col-md-8">

    <div class="Affiliate-login">
            <div class="Affiliate-login-body">

                <h4>
                    Welcome to TheWiSpy Affiliate Program!
                </h4>

                <p>
                  TheWiSpy affiliate program is free to join, enabling you to earn commissions on our premium products. Our affiliate program is designed to benefit website owners by empowering them to earn profit from TheWiSpy sales. In general, the affiliates generate leads and sales for commercial websites by referring the business products and acquire commissions on each sale reciprocally. 
                </p>
                
                <h4>
                    How Does TheWiSpy Affiliate Program Work?
                </h4>
                <p>
                  Signing up with TheWiSpy affiliate program requires no technical knowledge. It is a simple process; you only need to create an account as an affiliate, refer TheWiSpy to your website traffic, and watch your bank balance grow. TheWiSpy will supply you with all the textual links and banners that you need to place on your website. Whenever a user from your website clicks on the link, they will be conveyed to TheWiSpy's website. TheWiSpy will track all redirecting activities by its affiliate software. You will earn commission in accordance with your commission category.
                </p>
                <h4>
                   Real-Time Reporting:
                </h4>
                <p>
                    You can log in 24 hours a day to check real-time statistics on your leads, sales, account balance and monitor the performance of all marketing banners.
                </p>

                
            </div>
        </div>
                   </div>







        <div class="col-md-4">
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
                            <p>Don't have an account yet? <a href="{{ url('affiliate-signup') }}">Sign up now!</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    <section class="Affiliate-login-Detail">
    <div class="col-md-12">
        <div class="portlet" style="border-color:#eb008b;">
            <div class="portlet-heading" style="background:#eb008b;">
                <div class="portlet-title" style="color:#ffffff;">
                    <h4>
                        Program Details
                    </h4>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        
                                                
                                                <tr>
                            <td>
                                Payout Duration
                            </td>
                            <td>
                                Payments are made once per month, for the previous month.
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>
</section>
@endsection
