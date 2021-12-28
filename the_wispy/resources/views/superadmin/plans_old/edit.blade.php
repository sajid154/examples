@extends('layouts.superadmin')
@section('content')
	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <!--   <h4 class="page-title">Add New Package</h4> -->
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
            	<form method="post" action="{{url('editplanstore/'.$plan->id)}}">
                    <div class="form-group">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <input type="hidden" value="{{$plan->id}}" name="plan_id" />

            	     <label for="title">Plan Title</label>
                        <input type="text" class="form-control" name="title" value="{{$plan->title}}" />
            		    <label for="title">Type</label>
                              <select name="type" class="form-control">
                                    <option value="basic">Basic</option>
                                    <option value="pro">Pro</option>
                                    <option value="ultimate">Ultimate</option>
                                    <option value="promotional">Promotional</option>
                              </select>
                        <label for="title">Cost Price</label>
                        <input type="number" class="form-control" name="cost_price" value="{{$plan->cost_price}}" step="0.01"/>
            			<label for="title">Sale Price</label>
                        <input type="number" class="form-control" name="sale_price" value="{{$plan->sale_price}}" step="0.01"/>

                        <label for="title">Status</label>
                        <select name="status" class="form-control">
                        	<option disabled="disabled" selected="selected">select status</option>
                        	<option value="1" {{ ( $plan->status =='1') ? 'selected' : '' }}>Active</option>
                        	<option value="0" {{ ( $plan->status =='0') ? 'selected' : '' }}>In Active</option>
                        </select>

                        <label for="title">Months</label>
                        <select name="month" class="form-control">
                        	<option disabled="disabled" selected="selected">select months</option>
                        	@foreach($months as $val)
                        	<option value="{{$val->id}}" {{( $val->id == $plan->month_id) ? 'selected' : '' }}>{{$val->months_description}}</option>
                        	@endforeach
                        	
                        	<!-- <option value="0">In Active</option> -->
                        </select>
            		</div>
            		<button type="submit" class="">Update</button>
            				</form>
            			</div>
            		</div>
	</div>
@endsection