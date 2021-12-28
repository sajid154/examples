@extends('layouts.dashboard')
@section('content')

		<div class="row bg-title">

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <h4 class="page-title"> Photos </h4></div>

                    </div>

					<div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <div class="white-box">
							@foreach ($clientlists as $photo)
								<div class="parent-container">
									<div class="col-md-3">
										<a href="{{ url('storage/'.$photo->path) }}">
										<img src="{{ url('storage/'.$photo->path) }}" alt="" title="">
										</a>
									</div>
								</div>
							@endforeach
						</div>

					</div>

					</div>
					

@endsection