@extends('layouts.email-template')
@section('content')
    <h1 style="text-align: center; font-size: 16px; color:#414042; padding-bottom: 10px;">Thank you for Choosing TheWiSpy,</h1>
	<figure class="confirm-box" style="text-align: center; max-width: 600px; background-color: #fff; padding: 20px; box-sizing: border-box; margin: 0px auto; margin-top: 20px; margin-bottom: 20px;">
        <p style="text-align: left;">Many congratulations on choosing TheWiSpy Android monitoring software. We commit to providing the best Android spy features to fulfil all your personal and professional needs. Our dedicated experts are 24/7 available to make sure that you find no inconvenience using TheWiSpy software.Below   are   your   TheWiSpy   login   credentials   to   access   the   web-based   control   panel.Using the dashboard, you will be able to modify settings, monitor target device, enable
or disable features, and download the spied data to your device.</p>
        <div style="text-align: center">
            <a style="text-align: center; background-color: #ec008c; color: #fff;padding: 10px 30px; border-radius: 10px; display: inline-block; margin-top: 20px;" id="p1">User Email: {{$data_user['email']}}<br>Password: {{$data_user['system_requirement']}}</a></div>
    </figure>
@endsection
