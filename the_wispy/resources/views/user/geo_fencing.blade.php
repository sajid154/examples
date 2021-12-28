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



        <div class="">
          <div class="row">
                <div class="col-md-4">
                    
    <h4 class="page-title dashboard">Restricted Locations</h4>
    
                   <ul class="nav nav-tabs">
               
                @foreach($geo_fences as $fence)
                  
                  <li class="sms-user_list">

                  <a data-toggle="tab" href="" id="number_val" class="number_val" style="float: left;"><div class="sms_user_icon"><i class="fa fa-map-marker fa-fw fa-2x" aria-hidden="true"></i></div>
                      <div class="sms_user_detail"><strong>{{ $fence->area_name }}</strong>
                     <p>Lat ({{$fence->latitude}}), Lng ({{$fence->longitude}})<br> Range {{$fence->radius}}KM</p></div>
                   </a>
                    <form method="POST" action="{{ url('remove-geo-fence/'.$fence->id) }}" style="float: right; position:absolute; right: 10px; top: 45px;">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="submit" value="x" class="btn btn-sm btn-danger">
                   </form>

                   </li>
              
                @endforeach
                  </ul>
                  <br>
                  <a href="{{ url('geo-fence-logs/'.$device_id) }}" style="margin: 20px auto" title="Fencing Logs" class="btn btn-primary">Fencing Logs</a> 
                   <a href="{{ url('add-geo-fence/'.$device_id) }}" style="margin: 20px auto" title="New Fencing" class="btn btn-primary">+</a> 
                </div>
                <div class="col-md-8">
                  
        <div id="map" style="width:100%; height:600px; margin-bottom:40px;"></div>
                </div>
          </div>
                <div id="msg"></div>

    

</div>
</div>
</div>
</div>



@else

    @include('user.device_check');
@endif

@endsection

@section('scripts')


  
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaoOemWkwL19zbFerUg3aZgadwcWqQvuQ&callback=initMap" async></script>
    <script>


const citymap = {

  <?php foreach($geo_fences as $fence)
  { ?>

      '<?php echo $fence->area_name; ?>' : { 
      center: { lat: <?php echo $fence->latitude; ?>, lng: <?php echo $fence->longitude; ?> },
      population: <?php echo $fence->radius; ?>
      },
  
  <?php } ?>
}



function initMap() {
  // Create the map.
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12,
    center: { lat: <?php  if($current_location != null){echo $current_location->latitude;}else{ echo 37.0902;} ?>, lng: <?php if($current_location != null){echo $current_location->longitude;}else{ echo 95.7129;} ?> },
    mapTypeId: "terrain",
  });

  // Construct the circle for each value in citymap.
  // Note: We scale the area of the circle based on the population.
  for (const city in citymap) {
    // Add the circle for this city to the map.
    const cityCircle = new google.maps.Circle({
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.2,
      map,
      center: citymap[city].center,
      radius: Math.sqrt(citymap[city].population) * 1000,
    });
  }

    for (const city in citymap) {

       // Add the circle for this city to the map.
        const cityMarker = new google.maps.Marker({
       position: citymap[city].center,
       map,
       title: city
      });
    }

}


    </script>



@endsection