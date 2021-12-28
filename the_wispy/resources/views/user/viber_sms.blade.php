@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<!--  <link href="https://cdn.datatables.net/scroller/2.0.2/css/scroller.dataTables.min.css" rel="stylesheet"> -->
 <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css" rel="stylesheet">

<div class="row bg-title">
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <h4 class="page-title dashboard">Viber Messages</h4> 
  </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
            @include('user.last_sync')
          </div>
  </div>
  <!-- /.col-lg-12 -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="white-box for-all">

           @if(sizeof($vSms) > 0) 
                      <div class="col-md-12 col-md-4 message-tab-nav">        
              <ul class="nav nav-tabs">
                  @foreach($vSms as $index=> $client)

                  <input type="hidden" name="number_value" id="number_value" value="{{ ($index==0)? $client->contact_name: '' }}">
                  <li class="sms-user_list">
                    <a data-toggle="tab" href="{{$client->contact_name}}" id="number_val" class="number_val" value="{{ $client->contact_name }}"><div class="sms_user_icon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></div><div class="sms_user_detail"><strong>{{$client->contact_name}}</strong>
                     <p>{{str_limit($client->message, $limit = 30, $end = '...')}}</p></div></a></li>
                  @endforeach 
                  </ul>
              </div>
             @endif              <div class="col-md-{{ (sizeof($vSms) > 0)?8:12 }} no-padding">
        <input type="hidden" name="" id="log_value" value="{{ $id }}">
        <input type="hidden" name="" id="device_id" value="{{ $device->id }}">
        <div class="container no-padding">

          <table id="example" class="uk-table uk-table-striped sms-table" style="width:100%">
            <thead class="call-log-heading">
              <tr>
                <!-- <th>Message</th> -->
                <!-- <th>Message</th> -->
              </tr>
            </thead>
          </table>
          
           @include('user.no_data_found')

        </div>
      </div>
      </div>
    </div>
  </div>
  <style type="text/css">
.item {
    width: 40%;
    min-width: 280px;
    padding-top: 10px;
    clear: both;
    position: relative;
    z-index: 1;
}
.item .info {
    background: #f0f0f0;
    border-radius: 5px;
    padding: 10px;
    position: relative;
    margin-left: 10px;
    word-break: normal;
    overflow-wrap: break-word;
    word-wrap: break-word;
}
.item_r {
    float: left;
    clear: both;
}
 .item_r .info {
    margin-left: 0;
    margin-right: 10px;
    background: #4491ff;
    color: #fff;
}
.item .info:before {
    content: "";
    display: block;
    width: 0;
    height: 0;
    position: absolute;
    top: 0;
    left: -10px;
    border-right: 15px solid rgb(201, 243, 201);
    border-bottom: 12px solid transparent;
}
 .item_r .info:before {
    left: auto;
    right: -10px;
    border-right: 0;
    border-left: 15px solid #4491ff;
}
.dataTables_wrapper.no-footer .dataTables_scrollBody {
    border-bottom: 0 solid #111 !important;
}
.dataTables_empty{
      padding-top: 18px !important;
}
.sorting{
  display: none !important;
}
  </style>
  </style>
@endsection

@section('scripts')

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/scroller/2.0.2/js/dataTables.scroller.min.js" defer></script>
<script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js" defer></script>

<script>
  
 $(function () {
    var id = $('#log_value').val();



    var oTable = $('#example').DataTable({

      serverSide: true,
        // ordering: false,
        searching: false,
        processing: true,
        pageLength : 50,
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
        "language": {
          processing: "<img src='{{ asset('Loader-1-A.gif') }}' style='\
    position: relative;\
    z-index: 9; bottom:77px' >",
          },
        ajax: {
            "url": "{{ url('viber-default/') }}"+'/'+id,
            "data": function ( d ) {
            d.number_val = $('#number_value').val();
            d.device_id = $('#device_id').attr('value');
            },
        },
        scrollY: 600,
       "paging": false,
        // scroller: {
            // loadingIndicator: true
        // },
        info:false,
        columns: [
         
            { data: 'date_time', name: 'date_time'},
            // { data: 'id', name: 'id'},
            { data: 'message', name: 'message'}
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        rowGroup: {
      className: 'sms_table-group',
            startRender: null,
            startRender: function ( rows, group ) {
                return '<i class="fa fa-calendar cldr-icon" aria-hidden="true"></i>' + group;
            },
            dataSrc: 'intro'
        },
         "rowCallback": function( row, data, index ) {
          // console.log(data);
          // console.log(data.type);
          // console.log( $(row).addClass("message"));
          $(row ).find('td').addClass("info")
          $(row ).find('.odd').remove();
          if (data.status == "Sent") {
             $(row).addClass("item")
              
            $('td', row).css({'background-color':'#c9f3c9','display':'block','color':'#000','width':'42.65%','float':'right'});

          
  
    $(row).append('<tr role="row" class="odd item item_r sent-tr"><td class="info_date" style=" float: right;padding:0">'+data.date_time_f+'</td></tr>');


          }else{
            $(row).addClass("item item_r")
            $('td', row).css({'color': 'rgb(255, 255, 255)','float': 'left','width': '106%'});

            $(row).append('<tr role="row" class="odd item item_r set-tr"><td class="info_date" style=" float: right;padding:0">'+data.date_time_f+'</td></tr>');

          }
        }      

    });
    // oTable.fnDestroy();
    
       $('.number_val').on('click', function(e) {
        $('#number_value').val($(this).attr('value'));
             oTable.draw();
             e.preventDefault();
             });


  });
              $(document).ready(function() {
  var selector = '.nav-tabs li';
  $(selector).on('click', function() {
    $(selector).removeClass('active');
    $(this).addClass('active');
  });
});



</script>

@endsection