@extends('layouts.superadmin')
@section('content')
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4></div>
                    
                    </div>
                    <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <strong>{{session('success')}}</strong>
                        </div>
                        @endif
                        <div class="white-box">
                          
                            <a href="{{url('addplan')}}">Add New Plan</a>

                            <h3 class="box-title">All Plans</h3>
                            @foreach ($plans as $plan)
                                <div class="device-box">
                                <div class="col-md-8">
                                   <!--  <div class="col-md-4">
                                        <i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>
                                    </div> -->
                                    <div class="col-md-8">
                                        <h4 class="device-title"><!-- <a href=""> -->{{$plan->title}}<!-- </a> --></h4>
                                     <!--    <li data-toggle="tooltip" title=""> <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>test</li> -->
                                        <li data-toggle="tooltip" title=""><strong>Cost Price:</strong>:{{$plan->cost_price}} <strong>Sale Price:</strong>:{{$plan->sale_price}} <strong>Status:</strong>:{{($plan->status == '1') ? 'Active' : 'Inactive'}}</li>
                                        <li data-toggle="tooltip" title=""></li>
                                        <li data-toggle="tooltip" title=""></li>
                                  <!--   <li data-toggle="tooltip" title=""><i class="fa fa-user fa-fw" aria-hidden="true"></i>test</li> -->
                                        <a href="{{url('editplan/'.$plan->id)}}" class="">Edit</a>
                                        | <a href="{{url('editfeatureplan/'.$plan->id)}}" class="">Show features</a>
                                      <!--   <a href="{{url('superadmin/users/1/delete')}}" class="">Delete</a> -->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
@endsection