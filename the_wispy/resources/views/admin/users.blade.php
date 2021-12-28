@extends('layouts.admin')

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
                        	<h3 class="box-title">All Users</h3>
							@foreach ($users as $user)
								<div class="device-box">
								<div class="col-md-8">
									<div class="col-md-4">
										<i class="fa fa-user-circle fa-fw" aria-hidden="true"></i>
									</div>
									<div class="col-md-8">
										<h4 class="device-title"><a href="{{url('/admin/users/'.preg_replace('/\+/', '-', urlencode($user->id)))}}">{{$user->name}}</a></h4>
										<li data-toggle="tooltip" title=""><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>{{$user->email}}</li>
										
									<li data-toggle="tooltip" title=""><i class="fa fa-user fa-fw" aria-hidden="true"></i>{{$user->getRole()}}</li>
									
									</div>
								</div>
							</div>
							@endforeach
						</div>
                    </div>
                </div>
@endsection