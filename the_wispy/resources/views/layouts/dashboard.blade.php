<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('template/plugins/images/favicon.png') }}">
    <title>TheWiSpy Remote Monitoring Dashboard </title>
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') - TheWiSpy</title>
    <style>
body.modal-open .background-container{
    -webkit-filter: blur(4px);
    -moz-filter: blur(4px);
    -o-filter: blur(4px);
    -ms-filter: blur(4px);
    filter: blur(4px);
    filter: url("https://gist.githubusercontent.com/amitabhaghosh197/b7865b409e835b5a43b5/raw/1a255b551091924971e7dee8935fd38a7fdf7311/blur".svg#blur);
filter:progid:DXImageTransform.Microsoft.Blur(PixelRadius='4');
}
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('template/css/magnific-popup.css') }}" rel="stylesheet">
    <!-- Styles -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=9dbcc21e-b39c-40e0-9483-9a8500949a39"> </script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet">
    <!--<link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet">-->
    <link href="{{ asset('template/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('template/css/colors/default.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('template/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('template/plugins/bower_components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('template/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css " rel="stylesheet">
    <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->

</head>
<body class="fix-header background-container">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="wrapper">
    <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="#">
                        <!-- Logo icon image, you can use font-icon also -->
                        <b>
                            <!--This is light logo icon-->
                            <img src="{{ asset('template/plugins/images/logo.png') }}" alt="home" class="light-logo" />
                        </b>
                         
                    </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars" style="line-height: 50px;"></i></a>
                    </li>
                    <!-- <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> 
                            <a href="">
                                <i class="fa fa-search"></i>
                            </a> 
                        </form>
                    </li> -->
                                                     @if(Auth::user()->id == 19)
													                <li >
                   <div class="demo try-head">
                        <a class="profile-pic" href="{{ url('register') }}"> <span>
                        <!-- <a class="profile-pic" href="https://globalsiptrunking.com/register" style="color: red">  -->
                        Try Now</span></a></div>
                    </li>
					@endif
			
                    <li>

                        @php
    if(Auth::user()->roles->first()->name == "SuperAdmin"){
 
    $res = App\ClientList::Join('users','users.id','clientlist.user_id')->where('clientlist.id', $id)->first();
    $check_id = $res->avatar;

    }else{
      $check_id =  Auth::user()->avatar;

    }
@endphp
   <a class="profile-pic setting" href=""> <img src="{{ ($check_id)?asset('uploads/avatars'.'/'.$check_id):asset('uploads/avatars/dummy.jpg')  }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->name }}</b></a>
   

                     {{--    <a class="profile-pic" href=""> <img src="{{ (Auth::user()->avatar)?asset('uploads/avatars'.'/'.Auth::user()->avatar):asset('uploads/avatars/dummy.jpg')  }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->name }}</b></a> --}}
                        <!-- <a class="profile-pic" href=""> <img src="{{ asset('template/plugins/images/users/varun.jpg') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->name }}</b></a> -->
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <a class="btn"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></h3>
					<!---<a class="btn">Close</a> -->
                </div>

                 @php
                   $client_data =App\ClientList::Join('plans','plans.id','clientlist.plan_id')->where('clientlist.id', $id)->first();



    $supperesed_features = App\DevicesFeatures::where('uniqueid',$id)->select('features_id')->get();
                   
                    $assigned_features = App\PlanFeatures::with(['features' => function($query){
                            $query->whereNotNull('icon')->select('id','feature_name','feature_description','slug','icon')->get();
                        }])
                    
                    ->where('plans_id', $client_data->plan_id)
                    ->whereNotIn('feature_id', $supperesed_features)
                    ->get(); 






                   @endphp

                <ul class="nav" id="side-menu">

                <li style="padding: 90px 0 0; color: white">
                                    <div class="nav-sync"> 
                        {{ ucfirst(Auth::user()->email) }}
            <p>{{ isset($client_data->last_sync)? 'Updated: '.date('M d,Y, h:i:s A', strtotime($client_data->last_sync)) :'Click to update ' }}</p>
            <a class="nav-sync-btn" href="{{url('last-sync/'.$id)}}">
            <!-- <a class="waves-effect" href="{{url('run-command-syn/'.$client_data->id)}}"> -->
                <i class="fa fa-refresh" aria-hidden="true"></i>
            </a></div>
            </li>


                    <li>
                        <a href="{{url('devices')}}" class="waves-effect"><i class="fa fa-mobile fa-fw" aria-hidden="true"></i>My Devices</a>
                    </li>
                    <li>
                        <a href="{{url('dashboard/'.$id)}}" class="waves-effect"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                  
           {{--
           {{ Carbon\Carbon::now() }}<br>
    {{ $client_data->device_end_date }}<br>
                                    <!--    <h4 class="device-title">{{ucfirst(trans($client_data->modal))}}</h4> -->
    @if( $client_data->device_end_date > Carbon\Carbon::now())--}}

                    @foreach($assigned_features as $assigned_feature)



                        @if($assigned_feature->features != null)
                    <li>
                        <a href="{{url($assigned_feature->features['slug'].'/'.$id)}}" class="waves-effect"><i class="fa {{ $assigned_feature->features['icon'] }} fa-fw" aria-hidden="true"></i> {{ $assigned_feature->features['feature_name'] }}</a>
                    </li>
                        @endif

                    @endforeach

                      
        {{--<a href="#">Renewal Subscription</a>
    @endif--}}
                    <li style="margin-bottom: 20px;">
                        <a href="{{url('/device-settings'.'/'.$id)}}" class="waves-effect"><i class="fa fa-cogs fa-fw" aria-hidden="true"></i>Settings</a>
                    </li>
                   <!--  <li>
                        <a href="{{url($id.'/calls')}}" class="waves-effect"><i class="fa fa-phone fa-fw" aria-hidden="true"></i>Calls</a>
                    </li>
                    <li>
                        <a href="{{url($id.'/sms')}}" class="waves-effect"><i class="fa fa-comments fa-fw" aria-hidden="true"></i>Text Message</a>
                    </li>
                    <li>
                        <a href="{{url($id.'/contacts')}}" class="waves-effect"><i class="fa fa-phone fa-fw" aria-hidden="true"></i>Contact</a>
                    </li>
                    <li>
                        <a href="{{url($id.'/locations')}}" class="waves-effect"><i class="fa fa-location-arrow fa-fw" aria-hidden="true"></i>Location</a>
                    </li>
                    <li>
                        <a href="{{url($id.'/applications')}}" class="waves-effect"><i class="fa fa-location-arrow fa-fw" aria-hidden="true"></i>Applications</a>
                    </li>
                    <li>
                        <a href="{{url($id.'/calendars')}}" class="waves-effect"><i class="fa fa-location-arrow fa-fw" aria-hidden="true"></i>Calendars</a>
                    </li>
                    <li>
                        <a href="{{url($id.'/browsing-history')}}" class="waves-effect"><i class="fa fa-location-arrow fa-fw" aria-hidden="true"></i>Browser History</a>
                    </li>
                    <li>
                        <a href="{{url($id.'/wifi-logger')}}" class="waves-effect"><i class="fa fa-location-arrow fa-fw" aria-hidden="true"></i>WiFi Logger</a>
                    </li>
                    <li>
                        <a href="{{url($id.'/photos')}}" class="waves-effect"><i class="fa fa-picture-o fa-fw" aria-hidden="true"></i>Photo</a></li>
                        <li>
                        <a href="{{url($id.'/videos')}}" class="waves-effect"><i class="fa fa-video-camera fa-fw" aria-hidden="true"></i>Videos</a></li>
                        <li><a href="{{url($id.'/recordings')}}" class="waves-effect"><i class="fa fa-video-camera fa-fw" aria-hidden="true"></i>Recordings</a>
                    </li> -->
               </ul>
            </div>
            
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('content')
                <footer class="footer-text"><p>&copy; Copyright 2021 TheWiSpy</p></footer>
            </div>
        </div>
        </div>
    

   

        
        <!-- <script src="{{ asset('template/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script> -->
        
        <script src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('template/js/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('template/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('template/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('template/js/waves.js') }}"></script>
        <script src="{{ asset('template/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
        <script src="{{ asset('template/plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>


        <script src="{{ asset('template/js/custom.js') }}"></script>
        <script src="{{ asset('template/js/dashboard1.js') }}"></script>


        <script src="{{ asset('template/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script> 
        <script src="{{ asset('template/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('template/plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('template/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
        <script src="{{ asset('template/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

        <script>

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@yield('scripts')
</body>
</html>
