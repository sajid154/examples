@extends('layouts.user')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<style>
label {width:100%; float:left; padding-right:10px; box-sizing:border-box;}
label input[type=text] {width:100%; padding:10px; box-sizing:border-box;}
label input[type=email] {width:100%; padding:10px; box-sizing:border-box;}
button {color: #fff;
border-radius: 4px;
background: #ec008c;
font-size: 14px;
font-weight: 500;
display: inline-block;
margin-right: 20px;
border: 1px solid #ec008c;
box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
margin-bottom: 10px;
margin-top: 10px;}
.upload-img {width:100%; margin:15px 0px;}
.box-left{width:30%;}
.white-box input::placeholder {
 font-weight: 400;
}
</style>

<div class="row bg-title">
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

<h4 class="page-title dashboard">User Settings</h4> </div>
           <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                            @include('user.last_sync')
                        </div>

</div>

<!-- /.col-lg-12 -->

<div class="row">

<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
<div class="col-md-12">
<div class="white-box profile-edit">

<div class="card-body update-profile">


<h4 class="page-title">Change Password</h4>
 @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger">
               {{$error}}
         </div>
     @endforeach
 @endif

             @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

<div class="setting-lable">
	<form method="post" action="{{url('account/'.$clientlist->id.'/edit')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<!-- <label>
			Name
			<input type="text" name="name"  value="{{ $clientlist->name }}" />
		</label>

		<label>
			Email Address
			<input type="email" name="email"  value="{{ $clientlist->email }}" disabled="" />
		</label> -->

		<label>
			Current Password
			   <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password" value="{{ old('current-password') }}">
		</label>

		<label>
			New Password
			<input type="password" class="form-control" id="password" name="password" placeholder="New Password" value="{{ old('password') }}">
		</label>

		<label>
			Re-enter Password
			<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password" value="{{ old('password_confirmation') }}">
		</label>




<!-- 		<label class="upload-img">
			Upload Profile Image
			<div class="box-left">
				<div class="box">
					<input type="file" name="avatar" id="file-3" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple  onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"/>
					<label for="file-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
				</div></div>
				<img id="output" src="{{ ($clientlist->avatar)?asset('uploads/avatars'.'/'.$clientlist->avatar):asset('uploads/avatars/dummy.jpg')  }}" width="100" height="100">
			</label> -->
			@if(Auth::user()->id !=19 )
			<div class="update-form">
			<button type="submit">Update</button></div>
			@endif
		</form></div>
	</div>
	</div>
</div>
<div class="col-md-6"></div>
<div class="white-box"style="display: none;">
	<h4 class="page-title">Your Plan</h4>

	@foreach($client_data as $client_row)
	@if($client_row->device_status == "active")
	<div class="col-md-12">
		@if(isset($client_row->title))
		<p class="imei-number">{{isset($client_row->title)?$client_row->title:''}}</p>
		<p>  <a href="{{ url('plans/').'/'.$client_row->id }}" class="upgrade_plan">Upgrade</a></p>
		@else
		<h5>Your Plan</h5>
		<p class="imei-number">{{ "You did't select any plan Yet" }}</p>
		<p> <a href="{{ url('plans') }}">Select Plan</button></p>
			@endif 
			<h5>Plans History</h5>

			@foreach($client_data as $index=>$row)

			@if ($index == 0 )
			<p class="imei-number " >{{ $index+1 .' - '.$row->title }} {{ ($row->device_status == 'active')?'':'' }} </p>

			<p class="imei-number">{{ date("m-d-Y h:i:s", strtotime($row->created_at))  }}</p>	
			<button type="button" data-toggle="modal" data-target="#myModal">
				Read More
			</button>
			@endif
			@if ($index > 0 )
			<!-- The Modal -->
			<div class="modal" id="myModal">
				<div class="modal-dialog">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Plans History</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<p class="imei-number col-md-7">{{ $index+1 .' - '.$row->title }} {{ ($row->device_status == 'active')?'':'' }} </p>

							<p class="imei-number col-md-5">{{ date("m-d-Y h:i:s", strtotime($row->created_at))  }}</p>	
						</div>

					</div>
				</div>
			</div>
			<div class="show_read_more" style="display: none;">
				<p class="imei-number " >{{ $index+1 .' - '.$row->title }} {{ ($row->device_status == 'active')?'':'' }} </p>

				<p class="imei-number">{{ date("m-d-Y h:i:s", strtotime($row->created_at))  }}</p>	
				<!-- <a href="" id="read_more_close">Read More</a> -->
			</div>
			@endif
			@endforeach
		</div>
		@endif
		<style type="text/css">
			.actives{
				background-color: green;
			}
		</style>
		@endforeach
	</div>
</div>
</div>

@endsection
@section('scripts')
<script>
function loadPreview(input, id) {
	id = id || '#preview_img';
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$(id)
			.attr('src', e.target.result)
			.width(200)
			.height(150);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
</script>
@endsection