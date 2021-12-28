@extends('layouts.email-template')
@section('content')
    <p>{{$user['email']}} Verified his account where password is {{$user['system_requirement']}} </p>
@endsection
