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
                        	<h3 class="box-title">{{$singlesuer->name}}</h3>
						</div>
					</div>
					</div>		
@endsection