@extends('layouts.superadmin')
@section('content')
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
           <!--  <h4 class="page-title">Add New Month</h4> -->
		</div>
	</div>
	<div class="row">
		 @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                        @endforeach
                  </ul>
            </div>
            @endif
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">
				<form method="post" action="{{url('addnewfeature')}}">
			        <div class="form-group">
			            <input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label for="title">Feature Name</label>
			            <input type="text" class="form-control" name="feature_name" value="{{ old('feature_name') }}"/>
						<label for="title">Feature Description</label>
			            <input type="text" class="form-control" name="feature_description" value="{{ old('feature_description') }}"/>
			            <label for="title">Slug</label>
			            <input type="text" class="form-control" name="slug" value="{{ old('slug') }}"/>
			            <label for="title">icon</label>
			            <input type="text" class="form-control" name="icon" value="{{ old('icon') }}"/>

					</div>
				<button type="submit" class="">Save</button>
				</form>
			</div>
		</div>
	</div>
@endsection