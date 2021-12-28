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
<div class="item active">2</div>
<div class="line-cut"></div>
<div class="item active">3</div>
</div>
</div>
	<div class="setup_wizard_content">
		<h3 class="congrats-title">Congratulations! <span>You are almost done.</span></h3>
		<p>Congratulations TheWispy has now been successfully installed. You can click "Start" button below to check data of the target device</p>
	</div>			
	<div class="next_step_btn">
		<a class="next_step_btn_anchor" href="{{url('/setup-wizard-2').'/'.$id}}">Back</a>
		<a class="next_step_btn_anchor" href="{{url('/devices')}}">Start</a>
	</div>
		</div>
	</div>
	</div>
@endsection