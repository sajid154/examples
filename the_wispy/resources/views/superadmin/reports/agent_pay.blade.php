@extends('layouts.superadmin')

@section('styles')

<style>
    body{
    background:#eee;    
}
.main-box.no-header {
    padding-top: 20px;
}
.main-box {
    background: #FFFFFF;
    -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
    box-shadow: 1px 1px 2px 0 #CCCCCC;
    margin-bottom: 16px;
    -webikt-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.table a.table-link.danger {
    color: #e74c3c;
}
.label {
    border-radius: 3px;
    font-size: 0.875em;
    font-weight: 600;
}
.user-list tbody td .user-subhead {
    font-size: 0.875em;
    font-style: italic;
}
.user-list tbody td .user-link {
    display: block;
    font-size: 1.25em;
    padding-top: 3px;
    margin-left: 60px;
}
a {
    color: #3498db;
    outline: none!important;
}
.user-list tbody td>img {
    position: relative;
    max-width: 50px;
    float: left;
    margin-right: 15px;
}

.table thead tr th {
    text-transform: uppercase;
    font-size: 0.875em;
}
.table thead tr th {
    border-bottom: 2px solid #e7ebee;
}
.table tbody tr td:first-child {
    font-size: 1.125em;
    font-weight: 300;
}
.table tbody tr td {
    font-size: 0.875em;
    vertical-align: middle;
    border-top: 1px solid #e7ebee;
    padding: 12px 8px;
}
a:hover{
text-decoration:none;
}
</style>



@endsection





@section('content')
  <br>
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}} (Commisions)</div>

                <div class="panel-body">


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                           <div class="col-md-6 text-center">
                                    <form method="POST" action="{{ route('pay-via-paypal') }}">
                                        @csrf
                                        <input type="hidden" name="account" value="{{ $user->agent_details->paypal_account }}">
                                        <input type="hidden" name="pay_id" value="{{ $commission->id }}">
                                        <button type="submit" class="btn btn-secondary"><i class="fa fa-paypal text-light">   
                                        </i> Paypal</button>
                                    </form>
                                </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('pay-via-bank') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="pay_id" value="{{ $commission->id }}">
                                    <div class="form-group">
                                        <label>Account Title</label>
                                        <input type="text" name="ac_title" value="{{ $user->agent_details->bank_ac_title }}" class="form-control" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" name="ac_bank" class="form-control" value="{{ $user->agent_details->bank_name }}" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>IBAN Number</label>
                                        <input type="text" name="ac_iban" class="form-control" value="{{ $user->agent_details->bank_iban }}" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Recipt</label>
                                        <input type="file" name="recipt" class="form-control" required="required">
                                    </div>
                                 <button type="submit" class="btn btn-secondary"><i class="fa fa-bank text-light"></i> Submit</button>

                                </form>
                            </div>
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>
@endsection