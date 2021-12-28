@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<!--  <link href="https://cdn.datatables.net/scroller/2.0.2/css/scroller.dataTables.min.css" rel="stylesheet"> -->
 <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css" rel="stylesheet">

<div class="row bg-title">
  <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
    <h4 class="page-title dashboard">Remote Lock</h4> 
  </div>
             <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
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

      @if(session()->get('unsuccess'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('unsuccess') }}
    </div>

    @endif
      <div class="white-box for-all">
 
        <div class="container no-padding text-center">


<form method="POST" action="{{ url('remote-lock/'.$id) }}">
    @csrf
    <input type="hidden" name="run_command" value="remote-lock">
    <button type="submit">Remote Lock</button>
    
</form>          

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

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyCjUXxgn7g4ZhpNqimJa3z7jwHZYGA0n8A",
    authDomain: "thewispy-6b883.firebaseapp.com",
    databaseURL: "https://thewispy-6b883.firebaseio.com",
    projectId: "thewispy-6b883",
    storageBucket: "thewispy-6b883.appspot.com",
    messagingSenderId: "568245370038",
    appId: "1:568245370038:web:d9b64d23fffa0c885c7a17",
    measurementId: "G-GV1X7SG5KR"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>


@endsection