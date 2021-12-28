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
	                 <form method="post" action="{{url('editstoremonth/'.$month->id)}}">
                              <div class="form-group">
                              <input type="hidden" value="{{csrf_token()}}" name="_token" />
                               <input type="hidden" value="{{$month->id}}" name="month_id" />
                              <label for="title">Month Description</label>
                              <input type="text" class="form-control" name="months_description" value="{{$month->months_description}}"/>
                              <label for="title">Month days</label>
                              <input type="number" class="form-control" name="month_days" value="{{$month->month_days}}" />
                              </div>
                              <button type="submit" class="">Update</button>
                        </form>
			</div>
		</div>
	</div>
@endsection