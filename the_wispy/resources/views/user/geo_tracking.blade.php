@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')

                                           @php
    if(Auth::user()->roles->first()->name == "SuperAdmin"){
        // dd($request->all());
       $check_id = $user_id->user;
        // dd($check_id);
    }else{
      $check_id =  Auth::id();
    }
@endphp
                @if($user_id->user == $check_id)    
        {{--        @if($user_id->user == Auth::user()->id)  --}}   
<div class="row bg-title">
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <h4 class="page-title dashboard">Geo Tracking</h4> </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                    <p>Location Status: 

@if(isset($clientlist->device_location_status) && $clientlist->device_location_status == 1)
{{ ' On' }}
@else
{{ ' OFF' }}
@endif</p>
                            @include('user.last_sync')
                        </div>
  </div>
  <!-- /.col-lg-12 -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="white-box for-all">

<form method="post" action="#">
  

<div class="col-sm-12 col-md-8">
<h5 class="col-md-2">Start Date</h5>
            <div class="form-group col-md-3">
        <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose" placeholder="Please select start date">
    </div>
<h5 class="col-md-2">End Date</h5>
 <div class="form-group col-md-3">
        <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose" placeholder="Please select end date">
    </div>
    <div class="text-left col-md-2" style="">
    <button type="text" id="btnFiterSubmitSearch" class="btn btn-info">Submit</button>
    </div>
  </div>

</form>

        <div class="container">
        <div id="map" style="width:100%; height:400px; margin-bottom:40px;"></div>
                <div id="msg"></div>

    @include('user.no_data_found')
    
    <input type="hidden" name="" id="log_value" value="{{ $id }}">
    <input type="hidden" name="" id="device_id" value="{{ $device_id }}">
    
   <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="padding:10px; box-sizing:border-box;">
      <div id="modal-body" class="modal-body" style="width:100%; height:230px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
</div>
</div>
</div>



@else

    @include('user.device_check');
@endif

@endsection

@section('scripts')

    <script>
// Initialize and add the map
var map;

function haversine_distance(mk1, mk2) {
      var R = 3958.8; // Radius of the Earth in miles
      var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
      var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
      var difflat = rlat2-rlat1; // Radian difference (latitudes)
      var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

      var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
      return d;
    }
    function initMap() {

var arr = [];
      i = 0;

  // The map, centered on Central Park
  const center = {lat: {{ isset($clientlists[0]->latitude)?$clientlists[0]->latitude:'' }}, lng: {{ isset($clientlists[0]->longitude)?$clientlists[0]->longitude:'' }} };
  const options = {zoom: 10, scaleControl: true, center: center};
  map = new google.maps.Map(
      document.getElementById('map'), options);


    @foreach ($clientlists as $key => $value)
       
        // var latitude = value.latitude[i].replace(/\"/g, "");
        // var longitude = value.longitude[i].replace(/\"/g, "");

    new google.maps.Marker({position: { lat:  {{ $value->latitude }}, lng: {{ $value->longitude }} }, map: map });
         arr[i++] = {lat: {{ $value->latitude }} ,lng: {{ $value->longitude }} };

    @endforeach
              
console.log(arr);
                        
                
                 new google.maps.Polyline({path:  arr , map: map});

  // console.log(arr);
}

    $(document).ready(function(){

      $('#btnFiterSubmitSearch').click(function(e){


        e.preventDefault();
        // alert("ssa");
        var id = $('#device_id').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

            $.ajax({
                url:"{{ url('geo-tracking-default') }}"+'/'+id,
                type:"post",
                data:{start_date:start_date, end_date:end_date},
                // async: false,
                success: function(data){
                        // console.log(data);

                         var arr = [];
      i = 0;

  // The map, centered on Central Park
  const center = {lat: 49.8849526, lng: -97.1128534 };
  const options = {zoom: 1, scaleControl: true, center: center};
  map = new google.maps.Map(
      document.getElementById('map'), options);

                        $(data.latitude).each(function(i,val){
              
                                  var latitude = data.latitude[i].replace(/\"/g, "");
                                  var longitude = data.longitude[i].replace(/\"/g, "");

new google.maps.Marker({position: { lat:  parseFloat(latitude), lng: parseFloat(longitude) }, map: map });
     arr[i++] = {lat: parseFloat(latitude) ,lng: parseFloat(longitude) }
                        })
                
                 new google.maps.Polyline({path:  arr , map: map});

                }
            })


        })
    })

    </script>
    <!--Load the API from the specified URL -- remember to replace YOUR_API_KEY-->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaoOemWkwL19zbFerUg3aZgadwcWqQvuQ&callback=initMap">
    </script>

@endsection