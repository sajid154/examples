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

  @if(session()->get('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>

    @endif

      <div class="white-box for-all">



        <div class="">
          <div class="row">
  
                <div class="col-md-12">
                  
               <div id="map" style="width:100%; height:650px; margin-bottom:40px;"></div>
               
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
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaoOemWkwL19zbFerUg3aZgadwcWqQvuQ&callback=initMap&libraries=&v=weekly"
      async
    ></script>

    <script>

// This example uses SVG path notation to add a vector-based symbol
// as the icon for a marker. The resulting icon is a marker-shaped
// symbol with a blue fill and no border.
function initMap() {
  const center = new google.maps.LatLng(-33.712451, 150.311823);
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 19,
    center: center,
  });
  const svgMarker = {
    path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
    fillColor: "Blue",
    fillOpacity: 0.6,
    strokeWeight: 0,
    rotation: 0,
    scale: 2,
    anchor: new google.maps.Point(15, 30),
  };

  new google.maps.Marker({
    position: map.getCenter(),
    icon: svgMarker,
    map: map,
  });
}


    </script>

<script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>

<script>
  
        $(function(){
            let ip = '127.0.0.1';
            let port = '3000';
            let socket = io(ip + ':' + port);

            socket.on('connection');
        })


</script>

@endsection