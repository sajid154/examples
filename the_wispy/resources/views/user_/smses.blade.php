@extends('layouts.dashboard')
@section('content')
		<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"> Text Messages Logs </h4></div>
                    </div>
					<div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
							<div class="col-md-4 message-tab-nav">				
							<ul class="nav nav-tabs">
									@foreach($clientlists as $client)
									<li class="{{ $loop->first ? 'active' : '' }}"><a data-toggle="tab" href="#{{$client->id}}"><i class="fa fa-user fa-fw" aria-hidden="true"></i>{{$client->number}}</a></li>
									@endforeach 
								  </ul>
								  
							</div>
							<div class="col-md-8">
								<div class="tab-content msg-content">
										@foreach($clientlists as $clientlist)
									<div id="{{$clientlist->id}}" class="tab-pane fade in {{ $loop->first ? 'active' : '' }}">
										<div class="{{$clientlist->status}}-message">
												<p>{{$clientlist->message}}</p>
												<p class="message-time-date">09 Jan, 2020 14:41:46</p>
										</div>
									</div>
									@endforeach
								</div> 
							</div>
						</div>
					</div>
					</div>
					<script>
						$(document).ready(function() {
  var selector = '.nav-tabs li';
  $(selector).on('click', function() {
    $(selector).removeClass('active');
    $(this).addClass('active');
  });
});
					</script>
@endsection