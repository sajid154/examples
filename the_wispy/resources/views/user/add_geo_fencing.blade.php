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
    <h4 class="page-title dashboard">Geo Fencing</h4> </div>
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

  @if(session()->get('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>

    @endif

      <div class="white-box for-all">



      <div id="map" style="width:100%; height:500px; margin-bottom:40px;"></div>
                <div id="msg"></div>

    @include('user.no_data_found')
    
    <div class="col-md-12">
        <form action="{{ url('geo-fence/'.$id) }}" method="POST">
          @csrf
          <div class="row">
            <div class="form-group col-md-3">
              <label>Latitude</label>
              <input type="text" name="latitude" class="form-control" id="latitude">
            </div>
            <div class="form-group col-md-3">
              <label>Longitude</label>
              <input type="text" name="longitude" class="form-control" id="longitude">
            </div>
            <div class="form-group col-md-3">
              <label>Area Name</label>
              <input type="text" name="area_name" class="form-control">
            </div>
            <div class="form-group col-md-3">
              <label>Range (1km to 20km)</label>
              <input type="number" name="radius" class="form-control" id="radius" min="1" max="20">
            </div>
          </div>
          <div class="col-md-12 text-center">
            <button type="submit">Save</button>
          </div>
          
        </form>
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
   function initMap() {
  const myLatlng = { lat: <?php  if($current_location != null){echo $current_location->latitude;}else{ echo 37.0902;} ?>, lng: <?php if($current_location != null){echo $current_location->longitude;}else{ echo 95.7129;} ?> } ;
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12,
    center: myLatlng,
  });

  new google.maps.Marker({
       position: myLatlng,
       map,
      });
  // Create the initial InfoWindow.
  let infoWindow = new google.maps.InfoWindow({
    content: "Click the map to on desire location to get Lat/Lng!",
    position: myLatlng,
  });

  let circle = '';
  let marker = '';
  
  var myLat = document.querySelector('#latitude');
  var myLng = document.querySelector('#longitude');
  var myRadius = document.querySelector('#radius');

  let getPosition = "";


  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
    getPosition = mapsMouseEvent.latLng;
           if(circle != ''){
            circle.setMap(null);
          }
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
    );
    infoWindow.open(map);

    myLat.value = mapsMouseEvent.latLng.toJSON().lat;
    myLng.value = mapsMouseEvent.latLng.toJSON().lng;

  });

      myRadius.addEventListener("keyup", (mapsRadiusEvent)=>{
            if(circle != ''){
            circle.setMap(null);
          }
           if(myRadius.value > 20){
              alert('Range Should be 1km to 20 km');
              myRadius.value = 1;
          }
            circle = new google.maps.Circle({
                  strokeColor: "#FF0000",
                  strokeOpacity: 0.8,
                  strokeWeight: 2,
                  fillColor: "#FF0000",
                  fillOpacity: 0.35,
                  map,
                  position: getPosition, 
                  center: getPosition,
                  radius: myRadius.value * 1000,
                });
      });



}




    </script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaoOemWkwL19zbFerUg3aZgadwcWqQvuQ&callback=initMap" async></script>

@endsection