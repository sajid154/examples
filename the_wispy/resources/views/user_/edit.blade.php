@extends('layouts.user')
@section('content')
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <h4 class="page-title">My Account</h4> </div>

                    </div>

                    <!-- /.col-lg-12 -->

                <div class="row">

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                        <div class="white-box">
						<form method="post" action="{{url('account/'.$clientlist->id.'/edit')}}">
    {{ csrf_field() }}

    <input type="text" name="name"  value="{{ $clientlist->name }}" />

    <input type="email" name="email"  value="{{ $clientlist->email }}" />
    <button type="submit">Send</button>
</form>
						</div>
						</div>
						</div>
@endsection