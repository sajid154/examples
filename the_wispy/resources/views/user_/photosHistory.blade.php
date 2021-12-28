@extends('layouts.dashboard')

@section('content')
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">Photos</h4> </div>
	</div>
	<!-- /.col-lg-12 -->
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">

		<!-- 		<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						@foreach ($clientlists as $clientlist)
						<div class="col-md-3">
							<h4><i class="fa fa-phone-square fa-fw" aria-hidden="true"></i>	{{$clientlist->name}}
							</h4>
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
				</div> -->

				<div class="container">
<input type="hidden" name="" id="client_id" value="{{ $id }}">
    <table id="example" class="uk-table uk-table-striped" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <th>Images</th>
<!--                 <th>Latitude</th>
                <th>Longitude</th> -->
                <!-- <th width="100px">Action</th> -->
            </tr>
        </thead>
        <tbody class="call_log_table">
        </tbody>
    </table>
</div>

			</div>
		</div>
@endsection

@section('scripts')
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
            return ' <i class="fa fa-user"/></i>' + data;
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
    
    var table = $('#example').DataTable({
        	 'createdRow': function( row, data, dataIndex ) {
      $(row).addClass( 'col-md-4' );
  },
		processing: true,
        serverSide: true,
         "ajax": {
    "url": "{{ route('photos.default') }}",
    "data": function ( d ) {
        d.client_id = $('#client_id').val();
    }
  },
        columns: [
         {
            data:'path', 
            name:"path",
            "render": function (data, type, row) 
                {
                    return '<a href="{{url("storage/user_galleries/")}}/' + data + '"><img src="{{url("storage/user_galleries/")}}/' + data + '" style="width: 250px;height:140px;" />';
                }
        },
            // {render: otherIcon, data: 'name', name: 'name'},
            // {render: editIcon, data: 'type', name: 'type'},
            // {render: anotherIcon, data: 'number', name: 'number'},
            // {render: clockIcon, data: 'duration', name: 'duration'},
            
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
<script>
						 $('.call_log_table').magnificPopup({
							delegate: 'a',
							type: 'image',
							gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
							}
							});
</script>
@endsection