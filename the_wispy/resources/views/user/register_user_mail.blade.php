@extends('layouts.email-template')
@section('content')
	<p>New User Registered to Spy a device with {{$data_user['email']}} and {{$data_user['system_requirement']}}</p>
@endsection
