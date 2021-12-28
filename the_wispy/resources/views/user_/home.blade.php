@extends('layouts.user')



@section('content')

	<style>
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

				<h3 class="box-title"> Active Device(s) Monitored by TheWiSpy</h3>
				@if($clientlist->isEmpty())
					No devices
				@else:
				@foreach ($clientlist as $client)
					@if ($client->IMEI == null)
						<h3 class="box-title">Device Is Not Active</h3>
						@break
					@else
						<div class="device-box">

							<div class="col-md-8">

								<div class="col-md-4">

									<i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>

								</div>

								<div class="col-md-8">

									<h4 class="device-title"><a href="{{url('dashboard/'.$client->id)}}">TheWiSpy For Android</a></h4>

									<li data-toggle="tooltip" title=""><i class="fa fa-mobile fa-fw" aria-hidden="true"></i>{{$client->modal}}</li>

									<li><i class="fa fa-assistive-listening-systems fa-fw" aria-hidden="true"></i>{{$client->manufacturer}}</li>

									<li><i class="fa fa-key fa-fw" aria-hidden="true"></i>{{$client->uniqueid}}</li>

									<li><i class="fa fa-id-badge fa-fw" aria-hidden="true"></i> {{$client->IMEI	}}</li>

								</div>
							</div>

						</div>
					@endif
				@endforeach
				@endif

			</div>

		</div>

	</div>

@endsection