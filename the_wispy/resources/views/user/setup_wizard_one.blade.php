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
</style>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">
				<div class="purchase-progress clear">
<div class="wrapper">
<div class="item active">1</div>
<div class="line-cut"></div>
<div class="item ">2</div>
<div class="line-cut"></div>
<div class="item ">3</div>
</div>
</div>
	<div class="setup_wizard_content">
		<div class="youtub-video"><iframe width="789" height="444" src="https://www.youtube.com/embed/ieJEvs2zbr4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
			<h3> What Things You Require to get Start Spying the Target Android Phone?</h3>
			<ul id="tutorail-list">
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
	</div>
	<div class="next_step_btn">
		<a class="next_step_btn_anchor" href="{{url('/setup-wizard-2').'/'.$id}}">Next</a>
	</div>
		</div>
	</div>
	</div>
@endsection