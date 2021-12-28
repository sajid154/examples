@extends('layouts.dashboard')

@section('content')
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Phone Call History Logs</h4> </div>
                    </div>
                    <!-- /.col-lg-12 -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
							 <ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#home">Calls</a></li>
									<li><a data-toggle="tab" href="#menu1">Analysis</a></li>
								  </ul>

						  <div class="tab-content">
							<div id="home" class="tab-pane fade in active">
								@foreach ($clientlists as $clientlist)
					<div class="col-md-3">
								<h4><i class="fa fa-phone-square fa-fw" aria-hidden="true"></i>								{{$clientlist->name}}									</h4>
								<p> Mobile: {{$clientlist->number}}</p>
							</div><div class="col-md-4">
								<h4>{{$clientlist->type}}</h4>
								<p>{{$clientlist->duration}} Seconds</p>
							</div><div class="col-md-2">
								<i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
								<i class="fa fa-microphone fa-fw" aria-hidden="true"></i>
							</div><div class="col-md-3">
								<h4>{{$clientlist->created_at}}</h4>
								<p>10 Jul, 2016</p>
							</div>
					@endforeach
							</div>
							<div id="menu1" class="tab-pane fade">
							  
							</div>
							
						  </div>
                        </div>
                    </div>
@endsection