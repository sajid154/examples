@extends('layouts.dashboard')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
<style>
label {display:block;}
input[type="checkbox"]{
-webkit-appearance: initial;
appearance: initial;
width: 15px;
height: 15px;
position: relative;
border:1px solid #000;
/*background:#39b54a*/
}
input[type="checkbox"]:checked {
/*background: red;*/
}
input[type="checkbox"]:checked:after {
content: "X";
color: #fff;
position: absolute;
left: 50%;
top: 50%;
-webkit-transform: translate(-50%,-50%);
-moz-transform: translate(-50%,-50%);
-ms-transform: translate(-50%,-50%);
transform: translate(-50%,-50%);
}
input[type="checkbox"]:after {
/* Heres your symbol replacement */
content: "✔";
color: #000;
position: absolute;
left: 50%;
top: 50%;
-webkit-transform: translate(-50%,-50%);
-moz-transform: translate(-50%,-50%);
-ms-transform: translate(-50%,-50%);
transform: translate(-50%,-50%);
}
.device_updates {font-weight:400; display:inline}
.tab-content.right {width: 70%;float: right;margin-top: -100px!important;border: none;border-left: 2px solid #ec008c; padding-left: 20px;}
.nav > li > a:focus, .nav > li > a:hover{background-color: transparent!important;}
.nav-link.active {border-bottom: 2px solid #ec008c !important;color: #ec008c;}
.nav-link:hover {color: #ec008c;}
.nav-link {color: #000;padding-right: 10px;}
.nav.setting {display: grid;width: 30%;text-align: center;padding-right: 20px;}
.permission {width: 33%;float: left;}
.permission.title p:first-child {margin-top: 33px;}
.white-box input{margin-bottom: 13px!important;}
.billing-plan {
width: 33%;
float: left;}
.update-btn {
display: table-caption;
margin-top: 80px;
}

</style>
            @section('content')
            <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
            <!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
<div class="row bg-title">
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
<h4 class="page-title">Setting</h4></div>
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 new_syn_btn">
                            @include('user.last_sync')
                        </div>
</div>
<div class="">
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
<div class="">
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 featrue-setting-page">
<div class="white-box left-side setting">
    <ul class="nav setting" id="pills-tab" role="tablist"> 
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Features</a>
        </li>
        <li class="nav-item">
            <!-- <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Device Permission</a> -->
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-custom-tab" data-toggle="pill" href="#pills-custom" role="tab" aria-controls="pills-custom" aria-selected="false">Billing</a>
        </li>
    </ul>
    <div class="tab-content right" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 24px;">

            <form method="post" action="{{url('device-settings')}}">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <input type="hidden" name="device_id" value="{{ $id }}">
                    <label for="title">Features</label>
                    <br/>
                    @foreach($assigned_features as $assigned_feature)
                    <div class="col-md-6 col-sm-6">
                        <label class="device_updates" for="{{ $assigned_feature->features['feature_name'] }}">
                            <div class="toggle"></div>
                            <input type="checkbox" name="feature_id[]"  data-toggle="toggle" id="{{ $assigned_feature->features['feature_name'] }}" value="{{ $assigned_feature->features['id'] }}" 
                            abc
                            <?php 
                            if( sizeof($selected_features) > 0){
                                foreach($selected_features as $selected_feature){
// echo $selected_feature->features_id ;
// echo $assigned_feature->feature_id ;

                                    if($assigned_feature->feature_id == $selected_feature->features_id){
                                        echo '   class=" blocked"  ';break;
                                    }else{
                                        echo "elseaaa";
                                    }
                                }
                            }
                            ?>
                            />
                            {{ $assigned_feature->features['feature_name'] }}<br/></label></div>
                            @endforeach
                        </div>
                        @if(  auth::user()->id != 19)
                        <button class="update-btn" type="submit">Update</button>
                        @endif
                    </form>
                    <img src="{{ asset('Loader-1-A.gif') }}" style="display: none;width: 12%;position: relative;z-index: 9; bottom:-100px" id="loader" >
                    <form method="post" action="#" id="change_subs_form">
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="subscription_type" value="{{ $client_data->subscribed }}">
                        {{--<button class="unsubscribed-btn" type="submit">
                            {{($client_data->subscribed == '1')?'Unsubscribed':'Unsubscribed'}}</button> --}}
                            @if(  auth::user()->id != 19)

                            <button class="unsubscribed-btn" type="submit">
                                {{($client_data->subscribed == '1')?'Unsubscribed':'Unsubscribed'}}</button> 

                                @endif
                            </form>
                        </div>
<!--                         <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="permission title">
                                <p>App Permission</p>
                                <p>Msg Permission</p>
                                <p>Call Permission</p>
                            </div>
                            <div class="permission check"><p>Allow</p>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"><br>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"><br>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"><br>
                            </div>
                            <div class="permission check"><p>Deny</p>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"><br>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"><br>
                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"><br>
                            </div>
                        </div> -->
                        <div class="tab-pane fade" id="pills-custom" role="tabpanel" aria-labelledby="pills-custom-tab" style="margin-top: 25px;">


                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <!-- <th scope="col">Device Name</th> -->
                                  <th scope="col">Plan Name</th>
                                  <th scope="col">Paid Price</th>
                                  <th scope="col">Payment Date</th>
                                  <!-- <th scope="col">Plan Start Date</th> -->
                                  <!-- <th scope="col">Plan End Date</th> -->
                                  <th scope="col">Status</th>
                                </tr>
                              </thead>
                              <tbody>

                         @foreach($user_plans as $index=>$user_plan)

                        @php
    $now = Carbon\Carbon::now();
    $days = Carbon\Carbon::parse($user_plan->device_end_date)->diffInDays($now);
    $hours = Carbon\Carbon::now()->addDays($days)->diffInHours($user_plan->device_end_date);
$minutes = Carbon\Carbon::now()->addDays($days)->addHours($hours)->diffInMinutes($user_plan->device_end_date);

@endphp


                                <tr>
                                  <th scope="row">{{$index+1}}</th>
                                  <!-- <td>{{ $user_plan->modal }}</td> -->
                                  <td>{{ ( $user_plan->type == "one_dollar_Deal")? "Starter".' '. $user_plan->title :ucfirst($user_plan->type).' '. $user_plan->title }}</td>
                                  <td>{{ $user_plan->amount.' '. $user_plan->currency }}</td>
                                  <td>{{ ($user_plan->created_at)? date('M d,Y, h:i:s A', strtotime($user_plan->created_at)) :'' }}</td>
                                  <!-- <td>{{ ($user_plan->device_start_date)? date('M d,Y, h:i:s A', strtotime($user_plan->device_start_date)) :'' }}</td> -->
                                  <!-- <td>{{ ($user_plan->device_end_date)? date('M d,Y, h:i:s A', strtotime($user_plan->device_end_date)) :'' }}</td> -->


<td>  

    @if( $user_plan->device_end_date > Carbon\Carbon::now())
        <p class="col-md-12">{{ 'Expires in ' .$days .' days '. $hours. ' hours '. $minutes. ' minutes ' }}</p>@else<p>Expired</p>

    @endif

</td>

    </tr>

    @endforeach
                              </tbody>
                            </table>





                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">



$(document).ready(function(){
$('#change_subs_form').on('submit', function(e){
e.preventDefault();
if($('input[name="subscription_type"]').val() == 0){

swal({
title: "You are already Unsubscribed",
text: "",
icon: "warning",
// buttons: true,
dangerMode: true,

})
.then((result) => {
// alert(result);
if (result) {
// ajax_call(data)
}
});


}else{
var data = $(this).serialize();
subs_type = $('input[name="subscription_type"]').val();
if(subs_type == 1){
swal({
title: "Are you sure?",
text: "Really do you want to Unsubscribe?",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((result) => {
// alert(result);
if (result) {
ajax_call(data)
} else {
swal("Welcome Back!");
}
});
}else{
ajax_call(data)
}
}


});
});
    function ajax_call(data){
        $.ajax({
        url: "{{ url('change-subscription')}}",
        data: data,
        type:"post",
        success: function(data){
        if(data == '0'){

        $('input[name="subscription_type"]').val(data);
        $('#subscription_status').text('');
        $('#subscription_status').addClass('show');
        $('#subscription_status').append("<strong>{{ auth::user()->name }}!</strong> You are Successfully Unsubscribed!!");
        }
        // alert('done');
        }
        })

    }


// $(document).ready(function(){
//     // alert("asa");
//     // $('.toggle-demo').bootstrapToggle('off');
//     $('.blocked').parent().removeClass('toggle btn btn-primary').addClass('toggle btn btn-default off');

//     // $('.blocked').parent().find('btn btn-default').addClass('active');
//     // $('.toggle btn btn-default off').addClass('toggle btn btn-primary');
//     $('.elseaaa').parent().removeClass('toggle btn btn-default off').addClass('toggle btn btn-primary');
// })

// $('input[name="feature_id[]"]').change(function(){
//     alert("dfdf");
//     alert($(this).prop('checked'));
//     if($(this).prop('checked') == true){
//         console.log($(this).parent().removeClass('toggle btn btn-primary').addClass('toggle btn btn-default off'));
//     }
// })  



    $(document).ready(function(){

    $('input[name="feature_id[]"]').each(function(){
        if($(this).hasClass('blocked')) {
        // $(this).find('.toggle-demo').bootstrapToggle('off');
        $(this).bootstrapToggle('off');
        // $(this).closest('.nav-column').siblings('div.home').toggleClass("off");
        // alert("dfd");
        }else{
        // alert("else");
        // $(this).parent().addClass("oasaasaasan").find('.toggle').addClass('ccc');
        $(this).bootstrapToggle('on');
        // console.log($(this));

        // $( "ul li:nth-child(2)" ).addClass("dfere");
        // var par = $(this).parent().addClass("aaaaaqq");
        // $(".oasaasaasan").parent().find('.toggle').addClass("aawqwq");
        // par.
        }
    });  


    $('input[name="feature_id[]"]').each(function(){

        // console.log(($(this).prop('checked'));
        if($(this).prop('checked') == true){
        // alert($(this).prop('checked'));
        $(this).prop('checked',false);
        }else{
        $(this).prop('checked',true);
        }
    });  

    $('input[name="feature_id[]"]').change(function(){
    // alert("dfdf");
    // alert($(this).prop('checked'));
        if($(this).prop('checked') == true){
        console.log($(this).parent().removeClass('toggle btn btn-primary').addClass('toggle btn btn-default off'));
        }else{
        console.log($(this).parent().removeClass('toggle btn btn-default off').addClass('toggle btn btn-primary'));
        }
    })  


    })

</script>
@endsection