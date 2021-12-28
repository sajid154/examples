@extends('layouts.superadmin')
@section('content')
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Add New User</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">
				<form method="post" action="{{url('superadmin/add-new')}}">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
			<label for="title">Full Name</label>
            <input type="text" class="form-control" name="name"/>
			<label for="title">Email</label>
            <input type="text" class="form-control" name="email"/>
			<label for="title">Password</label>
            <input type="password" class="form-control" name="password"/>
		</div>
		<button type="submit" class="">Update</button>
				</form>
			</div>
		</div>
	</div>
@endsection