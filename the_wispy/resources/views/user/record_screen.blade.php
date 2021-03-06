@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<link href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css" rel="stylesheet">
        <div class="row bg-title">

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                        <h4 class="page-title dashboard">Record Screen</h4></div>
                                   <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                            @include('user.last_sync')
                        </div>

                    </div>
                          <input type="hidden" name="" id="log_value" value="{{ $id }}">
      <input type="hidden" name="" id="device_id" value="{{ $device_id }}">
                    <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <div class="white-box record-audio">

<div class="inputBox" style="text-align:right;padding-bottom:10px;">
                <!-- <input type="number" value="1" max="180"> -->
<div class="button-down">
            <lable>Select Time:</lable>
                <select name="recording_time" id="recording_time" >
                    <option>0.5m</option>
                    <option>01m</option>
                    <option>02m</option>
                    <!-- <option>05m</option> -->
                    <!-- <option>10m</option> -->
                </select>
    </div>
                                      <button data-remaining-time="0" class="btn btn-full" id="record_screen">
            Record Screen
            </button>
        </div>

    <div class="modal" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="text-align: center;">
          <div class="modal-header">
           <h5 class="modal-title">Recording Screen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="spinner">
            <span class="fa fa-spinner fa-spin fa-3x" id=""></span>
          </div>

          <div class="modal-body append">
            
          </div>
       <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          </div>
        </div>
      </div>
    </div>

        <p id="appen"></p>
<img src='{{ asset('Spinner-1s-200px-removebg-preview.png') }}' style="
    position: relative;\
    z-index: 9; bottom:77px;display: none;" id="loader" >

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

                <div class="container">
    <table id="example" class="uk-table uk-table-striped photos-table" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <!-- <th>Voices</th> -->
<!--                 <th>Latitude</th>
                <th>Longitude</th> -->
                <!-- <th width="100px">Action</th> -->
            </tr>
        </thead>
        <tbody class="call_log_table voice-setting">
        </tbody>
    </table>
     @include('user.no_data_found')
                   <!--     <input type="hidden" name="" id="client_id" value="{{ $id }}">       
                       <input type="hidden" name="" id="device_id" value="{{ $device_id }}">   -->     
</div>
@else

    @include('user.device_check');
@endif
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
        language: {
              processing: "<img src='{{ asset('Spinner-1s-200px-removebg-preview.png') }}' style='\
    position: relative;\
    z-index: 9; bottom:77px' >",

        // search: "_INPUT_",
        // searchPlaceholder: "Search...",
        paginate: {
            next: '<span class="glyphicon glyphicon-menu-right"></span>',
            previous: '<span class="glyphicon glyphicon-menu-left"></span>'
            }
        },
         'createdRow': function( row, data, dataIndex ) {
      $(row).addClass( 'col-md-4' );
  },

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
           info:false,
    // scrollY: 800,
       "paging": true,

        processing: true,
        serverSide: true,
                       "ajax": {
    "url": "{{ url('screen-recording-default/') }}"+'/'+id,
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
                    return '<video width="320px" height="240px" controls><source src="{{url("storage/record_screen")}}/'+id+'/' + data + '"></video>'
                }
        },
            // {render: otherIcon, data: 'name', name: 'name'},
            // {render: editIcon, data: 'type', name: 'type'},
            // {render: anotherIcon, data: 'number', name: 'number'},
            // {render: clockIcon, data: 'duration', name: 'duration'},
            
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ],rowGroup: {
            startRender: null,
            startRender: function ( rows, group ) {
                return '<i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;' + group;
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

     // $(document).ready(function(){
          var id = $('#log_value').val();
        $('#record_screen').on('click', function(){
            // alert("dfdd");
            var recording_time = $('#recording_time').val();
            // alert(record_screen);
             $('#spinner').show();
            $('#record_screen').prop({'disabled':'disabled'});
             $('.modal').modal('show');
            // $('#loader').show();
            $.ajax({
                url:"{{ url('run-command-to-record-screen') }}"+'/'+id,
                type:"post",
                data:{recording_time:recording_time},
                // async: false,
                success: function(data){
                    // alert("dfd");
                  $('#record_screen').prop({'disabled':false});
                  $('#spinner').hide();
                  $('.append').html('');

                  // console.log(data.data.device_state);

                  if(data.data.device_state == "Available"){

      
                    // console.log("asasa");
                    // console.log(data.data.path);
           $('.append').append('<video width="320px" height="240px" controls><source src="{{url("storage/record_screen/")}}/' +id+'/'+ data.data.path + '"></video>');


                 var check_len = $('#example tbody').find(".dtrg-group").length;

                 if(check_len){


            $('#example tbody').find(".dtrg-group td").each(function(index, value) {
                 // console.log(this[index]);
                if(index == 0){
                        console.log($(value).text());

                        var current_data = $(value).text();
                        console.log(moment().format('MMM,DD Y'))
                        if(current_data == moment().format('MMM,DD Y')){
                            // alert("dfd");

                              $('#example tbody tr:nth-child(2)').before('<tr class="col-md-4 odd" role="row"><td><video width="320px" height="240px" controls><source src="{{url("storage/record_screen/")}}/' +id+'/'+ data.data.path + '"></video></td></tr>');


                        }else{
                // alert("dfd");
                             $('#example tbody tr:nth-child(1)').before('<tr class="dtrg-group dtrg-start dtrg-level-0"><td colspan="1"><i class="fa fa-calendar abccc" aria-hidden="true"></i>&nbsp;&nbsp;'+moment().format('MMM,DD Y')+'</td><tr class="col-md-4 odd" role="row"><td><video width="320px" height="240px" controls><source src="{{url("storage/record_screen/")}}/' +id+'/'+ data.data.path + '"></video></td></tr>');

                        }
                        // if(current_data == )
                    }
                });


                      
                 }else{
                    // alert("else");
                     $('#example tbody tr:nth-child(1)').before('<tr class="dtrg-group dtrg-start dtrg-level-0"><td colspan="1"><i class="fa fa-calendar abccc" aria-hidden="true"></i>&nbsp;&nbsp;'+moment().format('MMM,DD Y')+'</td><tr class="col-md-4 odd" role="row"><td><video width="320px" height="240px" controls><source src="{{url("storage/record_screen/")}}/' +id+'/' + data.data.path + '"></video></td></tr>');
                 }
                
                  }
                  else{
                    // alert("busy")
                            $('.append').append('<p>Currently Mobile Device is busy. </p>');
                      }
                }
            })
        })
     // })

     $('.close').click( function(){
         $('.append').html('');
     })

    </script>

@endsection