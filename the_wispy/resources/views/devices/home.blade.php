@extends('layouts.user')

@section('content')
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">My Devices</h4> </div>
                    </div>
                    <!-- /.col-lg-12 -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                        
                        	@if(!$clientlist->isEmpty())
                            <h3 class="box-title"> Active Device(s) Monitored by TheWiSpy</h3>
							@foreach ($clientlist as $client)
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
							@endforeach
							@else
							<h3 class="box-title">No device found regarding this user</h3>
							@endif
                        </div>
                    </div>
                </div>
@endsection