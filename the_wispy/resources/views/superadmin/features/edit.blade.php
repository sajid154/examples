@extends('layouts.superadmin')
@section('content')
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <!-- <h4 class="page-title">Add New Month</h4> -->
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">
				<form method="post" action="{{url('updatefeaturerecord')}}">
			        <div class="form-group">
			            <input type="hidden" value="{{csrf_token()}}" name="_token" />

			            <input type="hidden" value="{{$singlefeature->id}}" name="feature_id"/>

						<label for="title">Feature name</label>
			            <input type="text" class="form-control" name="feature_name" value="{{$singlefeature->feature_name}}" />
						<label for="title">Feature Description</label>
			            <input type="text" class="form-control" name="feature_description" value="{{$singlefeature->feature_description}}" />
			            <label for="title">Slug</label>
			            <input type="text" class="form-control" name="slug" value="{{ $singlefeature->slug }}"/>
			            <label for="title">icon</label>
			            <input type="text" class="form-control" name="icon" value="{{ $singlefeature->icon }}"/>


					</div>
					<button type="submit" class="">Update</button>
				</form>
			</div>
		</div>
	</div>
@endsection