@extends('layouts.register')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<style>
    .purchase-progress {
    background: #F1F2F2;
    padding: 15px 0;
    overflow:hidden;
    margin-bottom:25px; border-radius:4px;
    
}
.purchase-progress .wrapper {
    width: 570px;
    margin: 0 auto;
}
.purchase-progress .item.active {
    background: #ec008c;
    color: #fff;
}
.purchase-progress .item {
    float: left;
width: 32px;
line-height: 30px;
background: #fff;
border: 2px solid #ec008c;
border-radius: 50%;
text-align: center;
color: #333;
font-size: 17px;
}
.purchase-progress .line-cut {
    float: left;
    width: 235px;
    height: 2px;
    background: #ec008c;
    position: relative;
    top: 15px;
}
.clear:after {
    display: block;
    clear: both;
}
</style>
<section class="checkout-back">
<section class="checkout-img">
    <div class="new-lable-img">
        <img src="{{ asset('uploads/checkout/icon-dashboard-normal.png')}}">
        <div class="arrow-not-active">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>

        </div><div class="checkout-not-active">
        <p>1.<span>Dashboard</span></p>
        </div>

    </div>
    <div class="new-lable-img">
        <img src="{{ asset('uploads/checkout/icon-checkout-normal.gif')}}">
        <div class="arrow-not-active">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </div>
        <div class="checkout-not-active">
        <p>2.<span>Checkout</span></p>
    </div>
    </div>
    <div class="new-lable-img">
        <img src="{{ asset('uploads/checkout/icon-thanks-active.png')}}">
        <div class="arrow-not-active">

        </div>
        <div class="checkout-active">
        <p>3.<span>Review & Thanks</span></p>
    </div>
    </div>
</section>

</section>
  <div class="thanku-page">
    <div class="container">
        <div class="thanku-box">
            <img src="{{ asset('uploads/checkout/check.png')}}">
            <h2>Thank You For Subscription</h2>
            <a class="dashbaord-anchor" href="{{url('devices')}}">Go to Dashboard</a>
            <a href="https://www.youtube.com/watch?v=ieJEvs2zbr4" target="_blank">Installation Guides</a>
        </div>
    </div>
  </div>
@endsection
