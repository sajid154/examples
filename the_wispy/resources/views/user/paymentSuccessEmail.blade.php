@extends('layouts.email-template')
@section('content')
    <p> Hi admin, <strong>Congratulations</strong> {{$data_email['first_name']}} {{$data_email['last_name']}} purchased a new License {{$data_email['random']}} with email {{$data_email['user_email']}} from {{$data_email['address']}} {{$data_email['city']}}. 
    </p>
	<p>Paid Amount: ${{$data_email['amount']}}</p>
	<p>Payer ID: {{$data_email['payer_id']}}</p>
	<p>Payment ID: {{$data_email['payment_id']}}</p>
@endsection
