@extends('layouts.superadmin')

@section('content')
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit {{$singlesuer->name}}</h4></div>
                    
                    </div>
					<div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
	<form method="post" action="{{url('superadmin/users/'.$singlesuer->id.'/edit')}}">
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
			<label for="title">Full Name</label>
            <input type="text" class="form-control" name="name" value="{{$singlesuer->name}}"/>
			<label for="title">Email</label>
            <input type="text" class="form-control" name="email" value="{{$singlesuer->email}}"/>
			<label for="title">User Role</label>
			<select class="form-control" name="role_id">
				<option value="2">
					Super Admin
				</option>
				<option value="1">
					Admin
				</option>
				<option value="3">
					User
				</option>
			</select>
		</div>
		<button type="submit" class="">Update</button>
	</form>
	</div>
	</div>
	</div>
	
@endsection