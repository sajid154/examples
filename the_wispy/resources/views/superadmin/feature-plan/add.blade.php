@extends('layouts.superadmin')
@section('content')
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
           <!--  <h4 class="page-title">Add New Month</h4> -->
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="white-box">
				<form method="post" action="{{url('savefutureplan')}}">
			        <div class="form-group">
			            <input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label for="title">Plans</label>
			           	<select name="plans" class="form-control">
			           		<option disabled="disabled" selected="selected">Select Plans</option>
			           		@foreach($plans as $plan):
			           		<option value="{{$plan->id}}">{{$plan->title}}</option>
			           		@endforeach;
			           	</select>
						<label for="title">Features</label>
						<br/>
						@foreach($features as $feature):
			           <input type="checkbox" name="features[]" value="{{$feature->id}}"/> {{$feature->feature_name}}<br/>
			            @endforeach;

					</div>
					<button type="submit">Save</button>
				</form>
			</div>
		</div>
	</div>
@endsection