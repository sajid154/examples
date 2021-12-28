@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<div class="row bg-title">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <h4 class="page-title dashboard">Last Sync</h4> </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
            @include('user.last_sync')
        </div>
    </div>
    <!-- /.col-lg-12 -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box for-all">
                <div class="container">
                    <div class="no-data" id="show_possibilities">
                        <div class="no-data-content">
                            <h1>Sorry! We have tried very hard, but still no data received.</h1>
                            <p>Possible reasons for this situation as following:</p>
                            <ol>
                                <li>The user does not have records recently</li>
                                <li>The user does not have permission to access the records of this section</li>
                                <li>The user's device is not compatible.</li>
                                <li>The user's records are being acquired.</li>
                            </ol>
                            <p>If your problem is not caused by the above possibilities, please contact us. We are always here for help!</p>
                        </div>
                        <div class="no-data-content">
                            <img src="https://www.thewispy.com/wp-content/uploads/2020/04/what-can-we-do.png">
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection

