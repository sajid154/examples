@extends('layouts.superadmin')
@section('content')
<style type="text/css">
     .overline { 
            text-decoration: line-through solid; 
        } 
          
</style>
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4></div>
                    </div>
                    <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        @if(session('success'))
                        <!--  <h1>{{session('success')}}</h1> -->
                        <div class="alert alert-success alert-dismissible">
                        <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  -->
                        <strong>{{session('success')}}</strong>
                        </div>
                        @endif
                        <div class="white-box">
                          
                            <a href="{{url('addmonth')}}">Add New Month</a>

                            <h3 class="box-title">All Months</h3>
                            @foreach ($months as $month)
                                <div class="device-box">
                                <div class="col-md-8">
                                  <!--   <div class="col-md-4">
                                        <i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>
                                    </div> -->
                                    <div class="col-md-8">
                                        <h4 class="device-title"><!-- <a href=""> -->{{$month->months_description}}<!-- </a> --></h4>
                                     <!--    <li data-toggle="tooltip" title=""> <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>test</li> -->
                                        <li data-toggle="tooltip" title=""><strong>Days:</strong>:{{$month->month_days}}</li>
                                        <!--   <li data-toggle="tooltip" title=""><i class="fa fa-user fa-fw" aria-hidden="true"></i>test</li> -->

                                        <a class="btn alert-info" href="{{url('editmonth/'.$month->id)}}" class=""><i class="fa fa-edit"></i></a>

                                      <!--   <a class="btn btn-danger" onclick="return myFunction();" href="test.com?id=1"><i class="fa fa-trash"></i></a> -->
                                      
                                     <!--<a href="{{url('superadmin/users/1/delete')}}" class="">Delete</a> -->
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            {!! $months->links() !!}
                            <!-- <span class="overline">33.33</span>
                            <a class="btn btn-danger" onclick="return myFunction();" href="test.com?id=1"><i class="fa fa-trash"></i></a>
                            <a class="btn alert-info" onclick="return myFunction();" href="test.com?id=1"><i class="fa fa-edit"></i></a> -->
                            <script>
                            function myFunction() {
                            if(!confirm("Are You Sure to delete this"))
                                event.preventDefault();
                            }
                            </script>     
                        </div>
                    </div>
                </div>
@endsection