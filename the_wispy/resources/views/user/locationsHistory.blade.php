@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaoOemWkwL19zbFerUg3aZgadwcWqQvuQ&callback=initMap"></script>
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
		<h4 class="page-title dashboard">Locations</h4> </div>
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

				<div class="container">
				<div id="map" style="width:100%; height:400px; margin-bottom:40px;"></div>
    <table id="example_2" class="uk-table uk-table-striped" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <th>ID</th>
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
      window.onload = function() {
	/*	  @foreach ($clientlists as $clientlist)*/
    var latlng = new google.maps.LatLng( {{$current_location['latitude']}},  {{$current_location['longitude']}});
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
	/*@endforeach*/
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

            var date_time = function ( data, type, row ) {
        if (data == null){
           return '';
       }else{
        return moment(data).format('MMM DD,Y, h:mm:ss A')
       }
    };

    var id = $('#log_value').val();
    var table = $('#example_2').DataTable({
                               'columnDefs': [
        { 'visible': false, 'targets': [0] }
    ],
        fnInitComplete : function() {
     if ($(this).find('tbody tr td').first().attr('colspan')) {
    $(this).parent().hide();
    $('#show_possibilities').show();

  } else {
    $(this).parent().show();
  }
   } ,

        order: [ [0, 'desc'] ],

        language: {
        search: "_INPUT_", 
        searchPlaceholder: "Search...",
                processing: "<img src='{{ asset('Loader-1-A.gif') }}' style='\
    position: relative;\
    z-index: 9; bottom:77px' >",
        paginate: {
                        next: '<span class="glyphicon glyphicon-menu-right"></span>',
                        previous: '<span class="glyphicon glyphicon-menu-left"></span>'
                    }
    },
    "mDom": '<"row view-filter"<"col-sm-12"<"pull-right"f><"clearfix">>>rt\
    <"row view-pager"\
    <"col-sm-12"\
    <"text-left"\
    <"col-sm-4"\
    i\
     >\
     >\
     <"text-right"\
    <"col-sm-3"\
    l\
    >\
    <"col-sm-5"\
    p\
    >\
    >\
    >\
    >\
    ',
	rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        processing: true,
        serverSide: true,
                ajax: {
           "url": "{{ url('locations-default/') }}"+'/'+id,
            "data": function ( d ) {
            d.device_id = $('#device_id').val();
            }
        },
        
        columns: [
         { data: 'date_time', name: 'date_time'},
             {render: otherIcon, data: 'user_locations_id', name: 'user_locations_id'},
            {data: 'latitude', name: 'latitude'},
            {data: 'longitude', name: 'longitude'},
            {data: 'address', name: 'address'},
            { render: date_time ,data: 'date_time', name: 'date_time'},
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