@extends('layouts.dashboard')
@section('content')

		<div class="row bg-title">
    <input type="hidden" name="" id="client_id" value="{{ $id }}">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <h4 class="page-title"> Videos </h4></div>

                    </div>

					<div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="white-box">
                        <table id="example" class="uk-table uk-table-striped" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <th>Videos</th>
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
    "url": "{{ route('videos.default') }}",
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
					return '<video width="320" height="240" controls><source src="{{url("storage/user_videos/")}}/' + data + '"></video>'
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
@endsection