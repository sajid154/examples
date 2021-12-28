@extends('layouts.superadmin')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring')
@section('content')
<style>
  select.form-control:not([size]):not([multiple]){
    height: 36px;
  }
  #btnFiterSubmitSearch {margin-top:0px;}
</style>
<div class="row bg-title">
  <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Registered Users  </h4> </div>
  </div>
  <!-- /.col-lg-12 -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="white-box">
{{--        @if($user_id->user == Auth::user()->id)
<input type="hidden" name="" id="log_value" value="{{ $id }}">
<input type="hidden" name="" id="device_id" value="{{ $device_id }}"> --}}
              <div class="row">
                  <div class="col-sm-12 col-md-4">
                      <div class="setting-btn">
                          <select class="form-control" id="sel1">
                              <option class="paid_user" name="paid_user" value="all" selected>Open this select menu</option>
                              <option class="paid_user" name="paid_user" value="paid_user">Paid User</option>
                              <option class="paid_user" name="paid_user" value="free_user">Unpaid User</option>
                          </select>
<!--                           <div class="dropdown left">
  <button class="anchor-btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Plan
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <button class="dropdown-item" type="button">A</button>
    <button class="dropdown-item" type="button">B</button>
  </div>
  </div> -->
</div>
</div><div class="col-sm-12 col-md-8">
<h5 class="col-md-2">Start Date</h5>
            <div class="form-group col-md-3">
        <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose" placeholder="Please select start date">
    </div>
<h5 class="col-md-2">End Date</h5>
 <div class="form-group col-md-3">
        <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose" placeholder="Please select end date">
    </div>
    <div class="text-left col-md-2" style="">
    <button type="text" id="btnFiterSubmitSearch" class="btn btn-info">Submit</button>
    </div>
                    </div>
                    </div>

                <div id="User_stats" class="modal" style="">
                    <div class="modal-dialog">
                       <div class="modal-content" style="padding:10px;box-sizing:border-box;width: 1267px;height: 721px;align-items: center;text-align: center;float: left;">
            <div id="modal-body" class="modal-body" style="width:100%; height:230px;">

                         <div id="chart_area" style="width: 100%;height: 650px;overflow-y: hidden;"></div>
                       </div>
                     </div>
                    </div>
                </div>


        <div class="container">
    <table id="example" class="uk-table uk-table-striped" style="width:100%">
        <thead class="call-log-heading">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Email Verified At</th>
                <th>Last Login</th>
                <!-- <th>Current Plan</th> -->
                <th>Registration Date</th>
                <th>View Devices</th>
            </tr>
        </thead>
        <tbody class="call_log_table">
        </tbody>
    </table>
</div>
{{-- @else
    @include('user.device_check');
@endif --}}
      </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content" style="padding:10px;box-sizing:border-box;width: 1067px;height: 421px;align-items: center;text-align: center;float: left;position: absolute;top: -80px;left: -120px">
            <div id="modal-body" class="modal-body" style="width:100%; height:230px;">
                <table id="example1" class="uk-table uk-table-striped" style="width:100%">
                  <thead class="call-log-heading">
                    <tr>
                      <th>Device ID</th>
                      <th>Child Name</th>
                      <th>Device Name</th>
                      <th>Device Plan</th>
                      <th>Device Status</th>
                      <th>Payment Date</th>
                      <th>Device Start Date</th>
                      <th>Device End Date</th>
                      <th>Device Expiry Date</th>
                      <th>Card Number</th>
                      <th>Subscription Status</th>
                      <th>Last Seen</th>

                    </tr>
                  </thead>
    <tbody class="show_devices">

    </tbody>
  </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

        


@endsection
@section('scripts')
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
  $(function () {

    var created_at = function ( data, type, row ) {
        if (data == null){
           return '';
       }else{
        return moment(data).format('MMM DD,Y, h:mm:ss A')
       }
    };
    var email_verified_at = function ( data, type, row ) {
        if (data == null){
           return '';
       }else{
        return moment(data).format('MMM DD,Y, h:mm:ss A')
       }
    };
    var last_login_at = function ( data, type, row ) {
        if (data == null){
           return '';
       }else{
        return moment(data).format('MMM DD,Y, h:mm:ss A')
       }
    };
  var title = function ( data, type, row ) {
        if (data == null){
           return '';
       }else{
        return data;
       }
    };


$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

     $('#example1').DataTable({
      "ordering": false,
      "dom": '',

     });
    // var id = $('#log_value').val();
    var oTable = $('#example').DataTable({
                       'columnDefs': [
        { 'visible': true, 'targets': [0] }
    ],
        order: [ [0, 'desc'] ],
         pageLength : 5,
         "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
         "scrollX": true,
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
    "dom": '<"row view-filter"<"col-sm-12"<"pull-right"f><"clearfix">>>rt\
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
            "url": "{{ url('registered-users-default') }}",
            data: function (d) {
          d.start_date = $('#start_date').val();
          d.end_date = $('#end_date').val();
          d.paid_user = $('#sel1').select().val();
          }
        },
        columns: [
            { data: 'id', name: 'id'},
            { data: 'name', name: 'name'},
            { data: 'email', name: 'email'},
            { render: email_verified_at ,data: 'email_verified_at', name: 'email_verified_at'},
            { render: last_login_at ,data: 'last_login_at', name: 'last_login_at'},
            // { render: title ,data: 'title', name: 'title'},
            { render: created_at ,data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
  /* Custom filtering function which will search data in column four between two values */
      $('#btnFiterSubmitSearch').click(function(){
          oTable.draw();
      });
      // $('#sel1').change(function(){
      //     oTable.draw();
      // });

  });

      function myFunction(id){
        // alert(id);


                  // var id = $('#log_value').val();
        // $('#take_picture').on('click', function(){
             
             // var camera_type = $('#camera_type').val();
            // alert(camera_type);
             // $('#spinner').show();
            // $('#record_audio').prop({'disabled':'disabled'});
             $('#myModal').modal('show');
            // $('#loader').show();
            $.ajax({
                url:"{{ url('get-user-devices') }}"+'/'+id,
                type:"post",
                // data:{camera_type:camera_type},
                // async: false,
                success: function(data){
                     // alert("aa");
                     // if(data){
                        console.log(data);
                        $('show_devices').html('');
                        $('.show_devices').html(data);
                     // }
                     // else{
                     //  $('#modal-body').html('<tr>\
                     //      <td>No Data Available</td>\
                     //    </tr>');
                     // }
                    // $('#spinner').hide();
                     // $('.append').html('');
                    // $('#take_picture').prop({'disabled':false});
              
                }
            })
        // })


      }
      function auto_login_user(id){

            $.get({
                url:"{{ url('auto-login-user') }}"+'/'+id,
                success: function(data){
                if(data.success == true){
                  console.log(data);
                  window.open( "{{ url('devices') }}");
                    }
                }
            })
        // })
      }


//     function user_device_stats(id){
//       var temp_title = 'title';
//             $.get({
//                 url:"{{ url('user-device-stats') }}"+'/'+id,
//                  success:function(data)
//                   {
//                  drawMonthwiseChart(data, temp_title);
//                 // $.each(data, function(i, jsonData){
//                 //     console.log(jsonData);
//                 //     console.log(i);
//                 // });
//                   }
//             })
//         // })
//       }
// google.charts.load('current', {packages: ['corechart', 'bar']});
// google.charts.setOnLoadCallback();

//    function drawMonthwiseChart(chart_data, chart_main_title){

//     var jsonData = chart_data;
//     var data = new google.visualization.arrayToDataTable();
//     data.addColumn('string', 'Month');
//     data.addColumn('number', 'Profit');
//     $.each(jsonData, function(i, jsonData){
//         var month = jsonData.month;
//         var profit = parseFloat($.trim(jsonData.profit));
//         data.addRows([[i, jsonData]]);
//     });
//     var options = {
//         title:chart_main_title,
//         hAxis: {
//             title: "Months"
//         },
//         vAxis: {
//             title: 'Profit'
//         }
//     };
//         var chart = new google.charts.Bar(document.getElementById('barchart_material'));
//         chart.draw(data, google.charts.Bar.convertOptions(options));
//       }


  




google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback();

// function load_monthwise_data(year, title)
// {
//     var temp_title = title + ' '+year+'';
//     $.ajax({
//         url:"fetch.php",
//         method:"POST",
//         data:{year:year},
//         dataType:"JSON",
//         success:function(data)
//         {
//             drawMonthwiseChart(data, temp_title);
//         }
//     });
// }
  
      function user_device_stats(id){
      var temp_title = 'title';
            $.get({
                url:"{{ url('user-device-stats') }}"+'/'+id,
                 success:function(data)
                  {
                        $('#User_stats').show();               
                 drawMonthwiseChart(data, temp_title);

                // $.each(data, function(i, jsonData){
                //     console.log(jsonData);
                //     console.log(i);
                // });
                  }
            })
        // })
      }

function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Modules');
    data.addColumn('number', 'Total Records');
    $.each(jsonData, function(key, value){
        $.each(value, function(key, value){

                    console.log(key);
                    console.log(value);

        data.addRows([[key, value]]);

      });
    });
        var options = {
          title: 'Company Performance',
          // chartArea:{left:0,top:0},
          // hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          // vAxis: {minValue: 0},

                  title:chart_main_title,
        hAxis: {
            title: "Module"
        },
        vAxis: {
            title: 'Count',
            gridlines: { count: 4 },
            scaleType: 'log',
            // ticks: [0, 5, 10, 50, 100, 500]
        },

          width:1500,
          height:550,
          bars: 'vertical',
          bar: {groupWidth: '95%'}
        };
 var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}

</script>




</script>
@endsection