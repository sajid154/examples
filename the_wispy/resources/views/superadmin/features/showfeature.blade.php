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
                        <div class="alert alert-success alert-dismissible">
                            <strong>{{session('success')}}</strong>
                        </div>
                        @endif
                            <a href="{{url('addfeature')}}">Add New Feature</a>

                          <!--   <h3 class="box-title">All Months</h3> -->
                            @foreach ($features as $feature)

                                <div class="device-box">
                                <div class="col-md-8">
                             <!--        <div class="col-md-4">
                                        <i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>
                                    </div> -->
                                    <div class="col-md-8">
                                        <h4 class="device-title"><!-- <a href=""> -->{{$feature->feature_name}}<!-- </a> --></h4>
                                     <!--    <li data-toggle="tooltip" title=""> <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>test</li> -->
                                     <!--    <li data-toggle="tooltip" title=""><strong>Days:</strong>:</li> -->
                                        <!--   <li data-toggle="tooltip" title=""><i class="fa fa-user fa-fw" aria-hidden="true"></i>test</li> -->
                                        <a href="{{url('editfeature/'.$feature->id)}}" class="">Edit</a>
                                        <!-- <a href="{{url('superadmin/users/1/delete')}}" class="">Delete</a>-->
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
@endsection