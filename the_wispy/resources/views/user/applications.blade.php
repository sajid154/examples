@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<div class="row bg-title">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<h4 class="page-title dashboard">App Activity</h4> </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                            @include('user.last_sync')
                        </div>

	</div>

	<!-- /.col-lg-12 -->
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box for-all">

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
<input type="hidden" name="" id="log_value" value="{{ $id }}">
<input type="hidden" name="" id="device_id" value="{{ $device_id }}">
				<div class="container">

    <table id="example" class="uk-table uk-table-striped" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Package Name</th>
                <th>Time Usage</th>
                <th>Logo</th>
                <th>Date Time</th>
            </tr>
        </thead>
        <tbody class="call_log_table">
        </tbody>
    </table>
     @include('user.no_data_found')
</div>
@else

    @include('user.device_check');
@endif
			</div>
		</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function () {

        var date_time = function ( data, type, row ) {
        if (data == null){
           return '';
       }else{
        return moment(data).format('MMM DD,Y, h:mm:ss A')
       }
    };


	  var id = $('#log_value').val();
	  var table = $('#example').DataTable({
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
    z-index: 9; bottom:77px; background:transparent'; >",
        paginate: {
                    next: '<span class="glyphicon glyphicon-menu-right"></span>',
                    previous: '<span class="glyphicon glyphicon-menu-left"></span>'
              }
    },
    responsive: {
    breakpoints: [
      {name: 'bigdesktop', width: Infinity},
      {name: 'meddesktop', width: 1480},
      {name: 'smalldesktop', width: 1280},
      {name: 'medium', width: 1188},
      {name: 'tabletl', width: 1024},
      {name: 'btwtabllandp', width: 848},
      {name: 'tabletp', width: 768},
      {name: 'mobilel', width: 480},
      {name: 'mobilep', width: 320}
    ]
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
		processing: true,
        serverSide: true,
                ajax: {
            "url": "{{ url('applications-default/') }}"+'/'+id,
            "data": function ( d ) {
            d.device_id = $('#device_id').val();
            }
        },
        
        columns: [
            { data: 'date_time', name: 'date_time'},
            { data: 'application_name', name: 'application_name'},
            { data: 'application_package_name', name: 'application_package_name'},
            { data: 'application_time_usage', name: 'application_time_usage'},
            {
            data:'application_logo', 
            name:"application_logo",
            "render": function (data, type, row) 
                {
                    return '<img src="{{url("storage/user_applications/")}}/'+id+'/' + data + '" style="width: 30px;height:30px;border-radius:50%;" />';
                }
        },
        { render: date_time ,data: 'date_time', name: 'date_time'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endsection