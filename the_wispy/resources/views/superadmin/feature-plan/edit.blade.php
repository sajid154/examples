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
				<form method="post" action="{{url('editplanfeatures')}}">
			        <div class="form-group">
			            <input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label for="title">Plans</label>
			           	<input type="text" readonly="readonly" value="{{$plans->title}}" name="plans" class="form-control">
			           	<label for="title">Type</label>
			           	<select name="type" class="form-control">

			           		      @php
      
      $options = array('basic'=>'Basic','pro'=>'Pro','ultimate'=>'Ultimate','Premium'=>'Premium','promotional'=>'Promotional','trial'=>'Trial');
      
      @endphp
                          
                              @foreach($options as $key=>$option)
                                    <option value="{{$key}}" {{($key == $plans->type)?'selected':''}}>{{$option}}</option>
                              @endforeach
                              
			           	</select>
			           	<input type="hidden" value="{{$plans->id}}" name="plan_id" class="form-control">

						<label for="title">Features</label>
						<br/>
							@foreach($features as $feature)
				           		<input type="checkbox" name="features[]" value="{{$feature->id}}" {{ (in_array($feature->id,$featureslt)) ? 'checked' : '' }}/> {{$feature->feature_name}}<br/>
				            @endforeach

					</div>
					<button type="submit">Update</button>
				</form>
			</div>
		</div>
	</div>
@endsection