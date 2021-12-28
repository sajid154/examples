@extends('layouts.dashboard')

@section('content')
<div class="row bg-title">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h4 class="page-title">Web History Logs</h4> </div>
	</div>
	<!-- /.col-lg-12 -->
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">
<div class="container">
<input type="hidden" name="" id="client_id" value="{{ $id }}">
    <table id="example" class="uk-table uk-table-striped" style="width:100%">
        <thead class="call-log-heading">
            <tr>
				<th>URL</th>
                <th>Browser</th>
                <th>Last Visit Time</th>
                <th>Bookmark</th>
                <!--<th>Date Time</th>
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
        processing: true,
        serverSide: true,
         "ajax": {
    "url": "{{ route('browsing-history.default') }}",
    "data": function ( d ) {
        d.client_id = $('#client_id').val();
    }
  },
        columns: [
            {data: 'url', name: 'url',
			"render": function (data, type, row) 
                {
                    return '<a href="'+ data + '">' + data + '</a>';
                }},
            {data: 'title', name: 'title'},
            {data: 'last_vist_time', name: 'last_vist_time'},
            {data: 'bookmark', name: 'bookmark'},
            // {data: 'date_time', name: 'date_time'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endsection