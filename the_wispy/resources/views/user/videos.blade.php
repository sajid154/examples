@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
		<div class="row bg-title">

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                        <h4 class="page-title dashboard"> Videos </h4></div>
                                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                            @include('user.last_sync')
                        </div>

                    </div>
  <input type="hidden" name="" id="log_value" value="{{ $id }}">
  <input type="hidden" name="" id="device_id" value="{{ $device_id }}">
					<div class="row">
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
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="white-box for-all">
                   
						<table id="example" class="uk-table uk-table-striped photos-table" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <!-- <th>Videos</th> -->
<!--                 <th>Latitude</th>
                <th>Longitude</th> -->
                <!-- <th width="100px">Action</th> -->
            </tr>
        </thead>
        <tbody class="call_log_table video">
        </tbody>
    </table>
    @include('user.no_data_found')

					</div>

					</div>
@else

    @include('user.device_check');
@endif
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
    var id = $('#log_value').val();
    var table = $('#example').DataTable({
                fnInitComplete : function() {
     if ($(this).find('tbody tr td').first().attr('colspan')) {
    $(this).parent().hide();
    $('#show_possibilities').show();

  } else {
    $(this).parent().show();
  }
   } ,
               processing: true,
        serverSide: true,
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
		 'createdRow': function( row, data, dataIndex ) {
      $(row).addClass( 'col-md-5th-1' );
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
 
               ajax: {
            "url": "{{ url('videos-default/') }}"+'/'+id,
            "data": function ( d ) {
            d.device_id = $('#device_id').val();
            }
        },
        columns: [
        {
            data:'path', 
            name:"path",
            "render": function (data, type, row) 
                {
					return '<video width="320px" height="240px" controls><source src="{{url("storage/user_videos/")}}/'+id+'/' + data + '"></video>'
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