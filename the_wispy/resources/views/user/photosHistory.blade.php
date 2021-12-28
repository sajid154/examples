@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<link href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css" rel="stylesheet">
<div class="row bg-title">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<h4 class="page-title dashboard">Photos</h4> </div>
                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                            @include('user.last_sync')
                        </div>
	</div>
      <input type="hidden" name="" id="log_value" value="{{ $id }}">
      <input type="hidden" name="" id="device_id" value="{{ $device_id }}">
	<!-- /.col-lg-12 -->
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box for-all">
<div class="table-img-setting">
	
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
				<div class="container">
    <table id="example" class="uk-table uk-table-striped photos-table" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <!-- <th>Images</th> -->
<!--                 <th>Latitude</th>
                <th>Longitude</th> -->
                <!-- <th width="100px">Action</th> -->
            </tr>
        </thead>
        <tbody class="call_log_table table-style">
        </tbody>
    </table>
    @include('user.no_data_found')
</div>
@else

    @include('user.device_check');
@endif

			</div>
			</div>
		</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js" defer></script>
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

          'columnDefs': [
        { 'visible': false,'ordering': false, 'targets': [0] }
    ],
         fnInitComplete : function() {
      if ($(this).find('tbody tr').length<=1) {
         $(this).parent().hide();
          $('#show_possibilities').show();

  } else {
    $(this).parent().show();
  }
   }, 
        
order: [ [0, 'desc'] ],

        serverSide: true,
        // ordering: false,
        searching: false,
        processing: true,
        pageLength : 25,
        
           // info:false,
    // scrollY: 800,
       "paging": true,
        // scroller: {
            // loadingIndicator: true
        // },
      

        language: {
        processing: "<img src='{{ asset('Loader-1-A.gif') }}' style='\
    position: relative;\
    z-index: 9; bottom:77px' >",

        // search: "_INPUT_",
        // searchPlaceholder: "Search...",
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
        'createdRow': function( row, data, dataIndex ) {
        $(row).addClass( 'col-md-5th-1' );
          },

        ajax: {
           "url": "{{ url('photos-default/') }}"+'/'+id,
            "data": function ( d ) {
            d.device_id = $('#device_id').val();
            }
        },
        columns: [
         {data: 'date_time', name: 'date_time'},
         {
            data:'path', 
            name:"path",
            "render": function (data, type, row) 
                {
                    return '<a class="popup_class" href="{{url("storage/user_galleries/")}}/'+id+ '/'+ data + '"><img src="{{url("storage/user_galleries/")}}/'+id+'/' + data + '" style="width: 289px;height:140px;" /><div class="pic-shadow"><p>'+row.date_time_f+'</p></a><div class="date-download"><a href="{{url("storage/user_galleries/")}}/'+id+'/'+row.path+'" download><i class="fa fa-download" aria-hidden="true"></i><p></a></div>'; 
                }
        },
            // { data: 'path', name: 'path'},
            // {render: editIcon, data: 'type', name: 'type'},
            // {render: anotherIcon, data: 'number', name: 'number'},
            // {render: clockIcon, data: 'duration', name: 'duration'},
            
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ],rowGroup: {  //Icon of Calendar 
            startRender: null,
            startRender: function ( rows, group ) {
                return '<i class="fa fa-calendar cldr-icon" aria-hidden="true"></i>' + group;
            },
            dataSrc: 'intro'
        },
    });
    
  });
</script>
<script>
						 $('.call_log_table').magnificPopup({
							delegate: 'a.popup_class',
							type: 'image',
							gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
							}
							});
</script>
@endsection