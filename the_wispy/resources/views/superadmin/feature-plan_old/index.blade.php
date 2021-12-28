


@extends('layouts.superadmin')
@section('content')
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4></div>
                    
                    </div>
                    <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                        @if(session('success'))
                                <h1>{{session('success')}}</h1>
                            @endif
                            <a href="{{url('addplan')}}">Add New</a>

                          <!--   <h3 class="box-title">All Plans</h3> -->
                            @foreach ($planfeatures as $planfeature)
                                <div class="device-box">
                                <div class="col-md-8">
                                    <div class="col-md-4">
                                        <i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="device-title"><!-- <a href=""> -->{{$planfeature->plan}}<!-- </a> --></h4>
                                     <!--    <li data-toggle="tooltip" title=""> <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>test</li> -->
                                        <li data-toggle="tooltip" title=""><strong>Feature Name:</strong>:{{$planfeature->feature_name}}</li>                                   
                                  		<!--   <li data-toggle="tooltip" title=""><i class="fa fa-user fa-fw" aria-hidden="true"></i>test</li> -->
                                    
                                        <a href="{{url('editfeatureplan/'.$planfeature->id)}}" class="">Edit</a>
                                       <!--  <a href="{{url('superadmin/users/1/delete')}}" class="">Delete</a> -->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
@endsection