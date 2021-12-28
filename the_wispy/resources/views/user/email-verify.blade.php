@extends('layouts.email-template')
@section('content')
    <h1 style="text-align: center; font-size: 16px; color:#414042; padding-bottom: 10px;">Please Verify Your Email Address</h1>
    <figure class="confirm-box" style="text-align: center; max-width: 600px; background-color: #fff; padding: 20px; box-sizing: border-box; margin: 0px auto; margin-top: 20px; margin-bottom: 20px;">
        <p style="text-align: center;">Please click the button below to verify your email address.</p>
        <div style="text-align: center">
            <a href="{{$url}}" style="text-align: center; background-color: #ec008c; color: #fff;padding: 10px 30px; border-radius: 10px; display: inline-block; margin-top: 20px;" id="p1">Verify Email Address</a></div>
    </figure>
    <p style="text-align: center;">If you did not create an account, no further action is required.</p>
@endsection
