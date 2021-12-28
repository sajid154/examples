@extends('layouts.dashboard')

@section('content')
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKXfDGMESlSPw39YxuSjTz6jWywMPvZxk&callback=initMap"></script>
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">Recent Locations</h4> </div>
	</div>
	<!-- /.col-lg-12 -->
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">
<input type="hidden" name="" id="client_id" value="{{ $id }}">
				<div class="container">
				<div id="map" style="width:100%; height:400px; margin-bottom:40px;"></div>
    <table id="example_2" class="uk-table uk-table-striped" style="width:100%">
        <thead class="call-log-heading">
            <tr>
				<th>Map</th>
				<th>Latitude</th>
                <th>Longitude</th>
                <th>Address</th>
                <th>Date & Time</th>
                <!-- <th width="100px">Action</th> -->
            </tr>
        </thead>
        <tbody class="call_log_table">
		</tbody>
    </table>
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
@endsection

@section('scripts')
<script>
      window.onload = function() {
		  @foreach ($clientlists as $clientlist)
    var latlng = new google.maps.LatLng( {{$clientlist->latitude}},  {{$clientlist->longitude}});
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
	@endforeach
};
    </script>
<script type="text/javascript">
  $(function () {
	  var editIcon = function ( data, type, row ) {
        if ( type === 'display' ) {
            return ' <i class="fa fa-phone"/></i>' + data;
        }
        return data;
    };
	var otherIcon = function ( data, type, row ) {
        if ( type === 'display' ) {
            return ' <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View Map</button>';
        }
        return data;
    };
	var anotherIcon = function ( data, type, row ) {
        if ( type === 'display' ) {
            return ' <i class="fa fa-mobile"/></i>' + data ;
        }
        return data;
    };
	var clockIcon = function ( data, type, row ) {
        if ( type === 'display' ) {
            return ' <i class="fa fa-clock-o"/></i>' + data ;
        }
        return data;
    };
	var calenderIcon = function ( data, type, row ) {
        if ( type === 'display' ) {
            return ' <i class="fa fa-calendar-check-o"/></i>' + data ;
        }
        return data;
    };
    
    var table = $('#example_2').DataTable({
        processing: true,
        serverSide: true,
         "ajax": {
    "url": "{{ route('locations.default') }}",
    "data": function ( d ) {
        d.client_id = $('#client_id').val();
    }
  },
        columns: [
            {render: otherIcon, data: 'user_locations_id', name: 'user_locations_id'},
            {data: 'latitude', name: 'latitude'},
            {render: anotherIcon, data: 'longitude', name: 'longitude'},
            {render: clockIcon, data: 'address', name: 'address'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
	$('#example_2 tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        //alert( 'You clicked on '+data['longitude']+'\'s row' );
		var latlng = new google.maps.LatLng( data['latitude'],  data['longitude']);
    var map = new google.maps.Map(document.getElementById('modal-body'), {
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
    } );
  });
</script>
@endsection