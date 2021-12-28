@extends('layouts.email-template')
@section('content')
                <h1 style="text-align: center; font-size: 16px; color:#414042; padding-bottom: 10px;">Welcome Onboard, Log Into TheWiSpy Now!</h1>
				<p>
					Many congratulations on choosing TheWiSpy Android monitoring software. We commit to providing the best Android spy features to fulfil all your personal and professional needs. Our dedicated experts are 24/7 available to make sure that you find no inconvenience using TheWiSpy software.
				</p>
                    <figure class="confirm-box" style="text-align: center; max-width: 600px; background-color: #fff; padding: 20px; box-sizing: border-box; margin: 0px auto; margin-top: 20px; margin-bottom: 20px;">
                        <p style="text-align: center;">Below is your TheWiSpy Activation Key</p>
                        <div style="text-align: center">
                        <p style="text-align: center; background-color: #ec008c; color: #fff;padding: 10px 30px; border-radius: 10px; display: inline-block; margin-top: 20px;" id="p1">{{$data['random']}}</p></div>
                    </figure>
					<p style="text-align:left">
					<strong>For Android Users:</strong>
					</p>
					<p style="text-align:left">
						Before you get started, please read this <a href="https://www.thewispy.com/how-it-works/">step-by-step installation guide</a> of TheWiSpy Android monitoring software.<br>
						<a style="text-align: center; background-color: #ec008c; color: #fff;padding: 10px 30px; border-radius: 10px; display: inline-block; margin-top: 20px;" href="http://download.thewispy.com/">Download App</a>
					</p>
					<p style="text-align:left">If you have any type of query regarding the installation or functionality of TheWiSpy app, feel free to <a href="mailto:support@thewispy.com">contact our customer support team</a>. We are 24/7 available to respond to your queries and help you out.
					</p>
					<p style="text-align:left">
						Have a great monitoring experience.<br>Warm Regards,<br>TeamTheWiSpy 

					</p>
@endsection
