@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<div class="row bg-title">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <h4 class="page-title dashboard">Calendars</h4> </div>
             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                            @include('user.last_sync')
                        </div>
    </div>
    <!-- /.col-lg-12 -->
    <input type="hidden" name="" id="log_value" value="{{ $id }}">
    <input type="hidden" name="" id="device_id" value="{{ $device_id }}">
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

<div class="container">

    <table id="example" class="uk-table uk-table-striped" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Start time</th>
                <th>Finish time</th>
                <th>Event location</th>
                <th>Comments</th>
                <!--<th>Date Time</th>
                <!-- <th width="100px">Action</th> -->
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
      var finish_time = function ( data, type, row ) {
        if (data == null){
           return '';
       }else{
        return moment(data).format('MMM DD,Y, h:mm:ss A')
       }
    }; 
    
    var start_time = function ( data, type, row ) {
        if (data == null){
           return '';
       }else{
        return moment(data).format('MMM DD,Y, h:mm:ss A')
       }
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
         'columnDefs': [
        { 'visible': false, 'targets': [0] }
    ],
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
           "url": "{{ url('calendars-default/') }}"+'/'+id,
            "data": function ( d ) {
            d.device_id = $('#device_id').val();
            }
        },
        columns: [

            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {render: start_time ,data: 'start_time', name: 'start_time'},
            {render: finish_time ,data: 'finish_time', name: 'finish_time'},
            {data: 'event_location', name: 'event_location'},
            {data: 'description', name: 'description'}
            // {data: 'date_time', name: 'date_time'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endsection