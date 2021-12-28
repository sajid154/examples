@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring ')
<style>
.modal-body input[type=text] {width:100%; padding:10px;}
.col-lg-9.col-md-4.col-sm-4.col-xs-12.new_syn_btn p {display:inline-block; margin-right:10px; font-weight:500;}
.col-lg-9.col-md-4.col-sm-4.col-xs-12.new_syn_btn {
    text-align: right;
}
.syn_new_btn_class {color:#313131; padding:0px; background:transparent; border:none; box-shadow:none;}
.syn_new_btn_class i {color:#313131;}
.syn_new_btn_class:hover {border:none;}
.syn_new_btn_anchor i {color:#313131;font-size: 17px;
vertical-align: middle;}
margin-top:60px; border-left: 1px solid #ccc;
border-right: 1px solid #ccc;
border-bottom: 1px solid #ccc;
.dismiss_btn_alert {padding:0px; margin:0px; border:none; box-shadow:none; background:none;}
</style>

@section('content')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDgmE4LsKOGdAle5Dt0dd2mdlPAO4Zpxs&callback=initMap"></script>
<div class="row bg-title dashboard">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<h4 class="page-title new">Dashboard</h4></div>


          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
           <p>
              {{ isset($client_data->last_sync)? 'Updated: '.date('M d,Y, h:i:s A', strtotime($client_data->last_sync)) :'Click to update ' }}
            </p>
            <a class="syn_new_btn_anchor" href="{{url('last-sync/'.$client_data->id)}}"><i class="fa fa-refresh" aria-hidden="true"></i>
            </a>

						@include('user.last_sync')


          </div>
          

					</div>
		@if (session('pcon'))
			<div class="alert alert-success">
				{{ session('pcon') }}
			</div>
		@endif
                    <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              @if($client_data->device_status == "active")
                        <div class="col-md-12 col-md-6 device_info_main">
							<div class="col-md-12">
							<div class="white-box left-side-01">
							<h4 class="page-title">Device Information</h4>
@php
	$now = Carbon\Carbon::now();
	$days = Carbon\Carbon::parse($client_data->device_end_date)->diffInDays($now);
	$hours = Carbon\Carbon::now()->addDays($days)->diffInHours($client_data->device_end_date);
$minutes = Carbon\Carbon::now()->addDays($days)->addHours($hours)->diffInMinutes($client_data->device_end_date);

@endphp



	
	<p class="col-md-6"><i class="fa fa-mobile fa-fw setting" aria-hidden="true"></i>Device Model :<span>{{ucfirst(trans($client_data->modal))}}</span></p> 
							 <p class="col-md-6"><i class="fa fa-battery-three-quarters fa-fw setting" aria-hidden="true"></i>Bettery Level :<span>
							 @if($client_data->battery_level != null)
							 {{ number_format($client_data->battery_level, 2)}}%
							@else
								Unavailable
							@endif</span>
							</p>
							 <p class="col-md-6">
								<i class="fa fa-assistive-listening-systems fa-fw setting" aria-hidden="true"></i>Manufacturer: <span>{{$client_data->manufacturer}}</span>
							 </p>
							 <p class="col-md-6">
								<i class="fa fa-android fa-fw setting" aria-hidden="true"></i>Android Version: <span>{{$client_data->android_os}}</span>
							 </p>
<p class="col-md-12">
							@if($client_data->network_carrier != null)	
								<i class="fa fa-id-badge fa-fw setting" aria-hidden="true"></i>Network Carrier: <span>{{$client_data->network_carrier}}</span>
							@else
							<i class="fa fa-id-badge fa-fw setting" aria-hidden="true"></i>Network Carrier: <span>No SIM Card Detected</span>
							@endif
							</p>
							@if($client_data->current_wifi != null) 
							 <p class="col-md-12"> 
								<i class="fa fa-wifi fa-fw setting" aria-hidden="true"></i>Current WiFi: <span>{{str_replace(str_split("<,>"),"",$client_data->current_wifi)}}</span>
							 </p>
							 @else
								<p class="col-md-12"> 
								<i class="fa fa-wifi fa-fw setting" aria-hidden="true"></i>Current WiFi: <span>No Connection</span>
							 </p> 
							 @endif
							 <p class="col-md-6"> 
								<i class="fa fa-plug fa-fw setting" aria-hidden="true"></i>Device Plug-In: <span>{{str_replace(str_split("<,>"),"",$client_data->plug_status)}}</span>
							 </p>
							 <p class="col-md-12">
								<i class="fa fa-id-badge fa-fw setting" aria-hidden="true"></i>IMEI Number: <span>{{$client_data->IMEI}}</span>
							 </p> 
							 							 <p class="col-md-12">
								<i class="fa fa-key fa-fw setting" aria-hidden="true"></i>License Key: <span>{{$client_data->uniqueid}}</span>
							 </p>
							 							<div class="plan-info-detail"> 

	@if( $client_data->device_end_date > Carbon\Carbon::now())
		<p class="col-md-12">{{ 'Expires in ' .$days .' days '. $hours. ' hours '. $minutes. ' minutes ' }}</p>
		
	@else
	<p>
		Expired
	</p>
	
	@endif
	</div>
							<div class="col-md-12">
{{-- @if(  $client_data->subscribed == '1') --}}

{{--@if(  $client_data->subscribed == '1' && $client_data->user_id != 19) --}}
@if(  $client_data->user_id != 19)

<a href="{{ url('plans/').'/'.$client_data->id }}" class="upgrade_plan">Upgrade</a>
@endif

@if(  $client_data->subscribed >= '0')
{{--			@if( $client_data->device_end_date < Carbon\Carbon::now() && array_first($client_data->clientlist_plans)['plans']['type'] != 'promotional') --}}

			@if( $client_data->device_end_date < Carbon\Carbon::now() && $client_data->user_id != 19 && array_first($client_data->clientlist_plans)['plans']['type'] != 'trial')
	<!-- <button type="button" data-toggle="modal" data-target="#myModal" 
	onclick="event.preventDefault();document.getElementById('plan_renewal_form').submit();">Renewal Subscription</button> -->

	<a href="{{ url('plans/').'/'.$client_data->id }}" class="upgrade_plan">Renewal</a>

	
<!--   <button type="button" data-toggle="modal" data-target="#myModal">
    Renewal
  </button> -->
<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Credit Card Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="{{ url('plan-renewal') }}" method="post" id="plan_renewal_form">
		<input type="hidden" name="plan_id" class="form-group" value="{{ array_first($client_data->clientlist_plans) }}">
		<input type="hidden" name="device_id" class="form-group" value="{{ $client_data->id }}">
		<input type="text" class="form-group" placeholder="Card Number" name="number">
		<input type="text" class="form-group" placeholder="Expire Month" name="expiryMonth">
		<input type="text"  class="form-group" placeholder="Expire Month" name="expiryYear">
		<input type="text" class="form-group" placeholder="CVV"  name="cvv">
		<button>Pay</button>
	</form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>  
		@endif
	@else

	{{--<p>You have cancelled your subscription, so you can subcribe from this button</p>
		
			<a href="{{ url('plans/').'/'.$client_data->id }}" class="upgrade_plan">Active Subscription</a>--}}

	@endif
								</div>
								</div>
	
							</div>
						<div class="col-md-12">
							<div class="white-box left-side-01">
							<h4 class="page-title">New Message <a href="{{url('sms/').'/'.$id}}">Read More</a></h4>
						
                                 <div class="col-md-6">
                                    <p><i class="fa fa-user fa-fw setting message"></i><span> {{ `(isset($sms_test) && $sms_test->contact_name != null)? $sms_test->contact_name: (isset($sms_test) && $sms_test->number != null)? $sms_test->number:''` }}</span></p></div>
						<div class="col-md-6">
							 @if ($sms_test == null)
								 No Message
							 @else
                            <p><i class="fa fa-calendar-check-o fa-fw setting message" aria-hidden="true"></i>
							<span class="light">{{ `($sms_test)? date('M d,Y, h:i:s A', strtotime($sms_test->date_time)) :''` }}</span></p>
                                </div>
                               
							<div class="col-md-12"><p class="dash-text"><i class="fa fa-comments fa-fw setting message" aria-hidden="true"></i> <span>   {{str_limit($sms_test->message, $limit = 30, $end = '...')}}</span></p>
                             
							@endif
                                </div> 

						</div>
						</div>
                                

                                
                                
						<div class="col-md-12">
							<div class="white-box left-side-01">
							<h4 class="page-title">New Call <a href="{{url('calls/').'/'.$id}}">Read More</a></h4>
							
							@if ($recent_call != null)
							<div class="col-md-6">	  
							<p><i class="fa fa-user fa-fw setting message"></i><span> {{$recent_call->name}}</span></p>
                                
                                @if($recent_call != null)
								  <p><i class="fa fa-calendar-check-o fa-fw setting message" aria-hidden="true"></i><span class="light">{{ ($recent_call)? date('M d,Y, h:i:s A', strtotime($recent_call->date_time)) :'' }}</span></p>
						
					
							  </div>
							  <div class="col-md-6"> 
							  	<p class="{{$recent_call->type}}_home"><i class="fa fa-phone fa-fw setting message"></i><span> {{$recent_call->type}}</span></p>
								  	<p><i class="fa fa-clock-o fa-fw setting message"></i><span class="light">  {{ 'lasts for' .' '.$recent_call->duration .' '.'second(s)'}}</span></p>
								@else
									<p><i class="fa fa-calendar-check-o fa-fw setting message" aria-hidden="true"></i>Not Available</p>
								@endif
							  </div>
							  @else
								  No Calls
							  @endif
						</div>
						</div>
                                
                                
                                <!--  New Most Recent 5 message   -->
                                
<!--                                 <div class="col-md-12">
							<div class="white-box left-side-01">
							<h4 class="page-title">Most Recent message <a href="{{url('sms/').'/'.$id}}">Read More</a></h4>
						
                                 <div class="col-md-6">
                                    <p><i class="fa fa-user fa-fw setting message recent"></i><span> {{isset($sms_test)?$sms_test->name:''}}</span></p></div>
						<div class="col-md-6">
							 @if ($sms_test == null)
								 No Message
							 @else
                            <p><i class="fa fa-calendar-check-o fa-fw setting message" aria-hidden="true"></i>
							<span class="light">{{ ($sms_test)? date('M d,Y, h:i:s A', strtotime($sms_test->date_time)) :'' }}</span></p>
                                </div>
                               
							<div class="col-md-12"><p class="dash-text"><i class="fa fa-comments fa-fw setting message" aria-hidden="true"></i> <span>{{($sms_test)?$sms_test->message:''}}</span></p>
							@endif
                                </div> 

						</div>
						</div> -->
                                
                                
						</div>
						<div class="col-md-12 col-md-6 recent_location_right">
							<div class="white-box left-side-01">
							<h4 class="page-title">Recent Location</h4>
							<div id="map" style="width:100%; height:450px; margin-bottom:40px;"></div>
							</div>
						</div>
                           
                        <div class="col-md-12 col-md-6 recent_location_right">
							<div class="white-box left-side-01">
							<h4 class="page-title">Phone Activities</h4>
							
							<div id="chart_area" style="width: 100%;height: 400px"></div>

							</div>
						</div>

                            
<!--         Recent Most Calls                   -->
      <!--                       <div class="col-md-6 recent_location_right">
                              <div class="col-md-12">
							<div class="white-box left-side-01">
							<h4 class="page-title">Most Recent Call <a href="{{url('calls/').'/'.$id}}">Read More</a></h4>
						
                                 <div class="col-md-6">
                                    <p><i class="fa fa-user fa-fw setting message recent"></i><span> {{isset($sms_test)?$sms_test->name:''}}</span></p></div>
						<div class="col-md-6">
							 @if ($sms_test == null)
								 No Message
							 @else
                            <p><i class="fa fa-calendar-check-o fa-fw setting message" aria-hidden="true"></i>
							<span class="light">{{ ($sms_test)? date('M d,Y, h:i:s A', strtotime($sms_test->date_time)) :'' }}</span></p>
                                </div>
                               
							<div class="col-md-12"><p class="dash-text"><i class="fa fa-comments fa-fw setting message" aria-hidden="true"></i> <span>{{($sms_test)?$sms_test->message:''}}</span></p>
							@endif
                                </div> 

						</div>
						</div>
                            </div> -->
						</div>
					@endif
					<style type="text/css">
						.actives{
							background-color: green;
						}
					</style>
				
					
			
				
                    </div>

@endsection
@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#read_more').click(function(e){
			e.preventDefault();
			// alert("Sd");
			$('.show_read_more').show();
			// $(this).hide();
			// $('#read_more_close').show();
		})
	})
		
		      window.onload = function() {
		
    var latlng = new google.maps.LatLng( {{ (($recent_location['latitude']))?$recent_location['latitude']:'0'}},  {{ (($recent_location['longitude']))?$recent_location['longitude']:'0'}});
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: 'Set lat/lon values for this property',
        draggable: true
    });
    google.maps.event.addListener(marker, 'dragend', function(a) {
        console.log(a);
        var div = document.createElement('div');
        div.innerHTML = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
        document.getElementsByTagName('body')[0].appendChild(div);
    });
	
};

	// console.log(chart_data.result);




google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawAxisTickColors);


	


function drawAxisTickColors(chart_data) {

    var jsonData =  {!! str_replace("'", "\'", json_encode($get_graph_data)) !!};
         

    //       t = [];
    //     response = JSON.parse(jsonData);
    //             for (var i = 0; i < response.length; i++)
    //                 t[i] = [response[i][0], response[i][1]];


    //      var data = google.visualization.arrayToDataTable([
    //     ['Name', 'Number'],
    //     response,
    // ]);

    // var jsonData = jsonData[0]
  var chartData = [];
  chartData.push(['Name', '', { role: 'style' }]);
  //    jsonData.forEach(function (row) {
  //   chartData.push([row[0], parseFloat(row[1])]);
  // });
     // console.log(jsonData[0]);

	
	// console.log("jsonData");
	// console.log(jsonData);
var colors =  ['#FFFFFF', '#999999', 'orange', '#454545', '#00FF00','#0000FF', '#800080', '#FF00FF', '#000080', '#008080','#00FFFF', '#808000', '#800000', '#808080', '#C0C0C0'];
// console.log(colors[0]);
    $.each(jsonData, function(key, value){
    	var i = 1;
        $.each(value, function(key, value){
        	// var i = 1+int(i);
        	// console.log(key);
        	// console.log(value);

        	if(key == 'capture_screenshots'){
        		key = "Capture Screenshots";
        	}
        	if(key == 'Calllogs'){
        		key = "Call Logs";
        	}
        	if(key == 'user_applications'){
        		key = "Applications";
        	}
        	if(key == 'user_calendars'){
        		key = "Calendars";
        	}
        	if(key == 'user_galleries'){
        		key = "Galleries";
        	}
        	if(key == 'user_location_details'){
        		key = "Locations";
        	}
        	if(key == 'wifi_loggers'){
        		key = "Wifi Loggers";
        	}
        	if(key == 'user_videos'){
        		key = "Videos";
        	}
        	if(key == 'take_pictures'){
        		key = "Take Pctures";
        	}
        	if(key == 'user_voices'){
        		key = "Voices";
        	}
        	if(value != ''){

        	if(i<20){
             chartData.push([key, value,colors[i]]);
        	}
        }

        // data.addRows([[key, value]]);
           i++;
      });

    });

     // console.log(chartData);
// chartData


      var data = google.visualization.arrayToDataTable(chartData);
    // data.addColumn('string', 'Modules');
    // data.addColumn('number', 'Total Records');

        var options = {
          // title: 'Company Performance',
          chartArea:{left:30,top:30},
          // hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          // vAxis: {minValue: 0},

                  // title:chart_main_title,
 // hAxis: {title: 'Year',  titleTextStyle: {color: 'red'}},
        vAxis: {
            // title: 'Count',
            // gridlines: { count: 4 },
            scaleType: 'log',
            // ticks: [0, 5, 10, 50, 100, 500]
            ticks: [],
             // baselineColor: 'none',
              // baselineColor: '#fff',
         // gridlineColor: '#fff',
         // textPosition: 'none'
        },

         legend: {position: 'none'},
          width:650,
          height:450,
          bars: 'vertical',
          bar: {groupWidth: '70%'}
        };
 var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
    }
    </script> 

    @endsection