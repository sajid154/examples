@extends('layouts.dashboard')

@section('content')
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Monitored Device Contact List</h4></div>
                    </div>
					<div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                         <div class="white-box">				<!--			@foreach ($clientlists as $clientlist)
							<div class="contact-list-box">
							<div class="col-md-4">
								<h4><i class="fa fa-user fa-fw" aria-hidden="true"></i>  {{$clientlist->name}}</h4>
								<p>Mobile: {{$clientlist->number}}</p>
							</div>
							<div class="col-md-4">
								<h4>Last Connected</h4>
								<p>05:30:00 am | Thu, Jan 9, 2020</p>								
							</div>
							<div class="col-md-4">
								<a href="#">WatchLsit</a>
							</div>
						</div>@endforeach
						 -->
						<div class="container">
<input type="hidden" name="" id="client_id" value="{{ $id }}">
    <table class="uk-table uk-table-striped data-table-1">
        <thead class="call-log-heading">
            <tr>
                <th>Name</th>
                <th>Number</th>
                <!-- <th width="100px">Action</th> -->
            </tr>
        </thead>
        <tbody class="call_log_table">
        </tbody>
    </table>
</div>
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
    var table = $('.data-table-1').DataTable({
        processing: true,
        serverSide: true,
         "ajax": {
    "url": "{{ route('contacts.default') }}",
    "data": function ( d ) {
        d.client_id = $('#client_id').val();
    }
  },
        columns: [
            {render:otherIcon, data: 'name', name: 'name'},
            {render: editIcon, data: 'number', name: 'number'},
            // {data: 'date_time', name: 'date_time'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endsection