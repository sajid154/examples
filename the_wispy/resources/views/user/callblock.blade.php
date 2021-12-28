@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<!--  <link href="https://cdn.datatables.net/scroller/2.0.2/css/scroller.dataTables.min.css" rel="stylesheet"> -->
 <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css" rel="stylesheet">

<div class="row bg-title">
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <h4 class="page-title dashboard">Call Block</h4> 
  </div>
             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                            @include('user.last_sync')
                        </div>
  </div>
  <!-- /.col-lg-12 -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
  @if(session()->get('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>

    @endif
      <div class="white-box for-all">

    <a href="{{ url('call-block-add/'.$id) }}" class="btn btn-primary float-right" style="margin-bottom: 20px;">Add New Block Number</a>
    
    <a href="{{ url('call-block-incoming/'.$id) }}" class="btn btn-primary float-right" style="margin-bottom: 20px; margin-right:20px;">Calls From Block Number</a>
        <div class="container no-padding">

          <table id="example" class="uk-table uk-table-striped sms-table" style="width:100%">
            <thead class="call-log-heading">
              <tr>
                <th>Serial No</th>
                <th>Phone Number</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tbody>
                  @php $sNo = 1 @endphp
                  @foreach($blockNumbers as $number)
                
                  <tr>
                      <td>{{ $sNo++ }}</td>
                      <td>{{ $number->phone_number }}</td>
                      <td>
                          <form method="post" action="{{ url('call-block/'.$number->id) }}">
                               <input type="hidden" name="_method" value="delete">
                               @csrf
                                  
                                <button type="submit"><i class="fa fa-trash"></i></button>
                          </form>

                      </td>
                  </tr>
                  @endforeach              
            </tbody>
          </table>
          {{ $blockNumbers->links() }}

           <!-- @include('user.no_data_found') -->

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


@endsection