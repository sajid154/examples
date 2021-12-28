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
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKXfDGMESlSPw39YxuSjTz6jWywMPvZxk&callback=initMap">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('template/css/magnific-popup.css') }}" rel="stylesheet">
    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.uikit.min.css" rel="stylesheet">
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
                    <a class="logo" href="https://www.thewispy.com/">
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
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li>
                    <li>
                        <a class="profile-pic" href=""> <img src="{{ asset('template/plugins/images/users/varun.jpg') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->name }}</b></a>
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
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 60px 0 0;">
                        <a href="{{url('superadmin')}}" class="waves-effect"><i class="fa fa-mobile fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="{{url('/account')}}" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Account</a>
                    </li>
                    <li>
                        <a href="{{url('superadmin/users')}}" class="waves-effect"><i class="fa fa-users fa-fw" aria-hidden="true"></i>Users</a>
                    </li>
                    <li>
                        <a href="{{url('superadmin/add-new')}}" class="waves-effect"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>Add New User</a>
                    </li>

                    <li>
                        <a href="{{url('monthsmanagement')}}" class="waves-effect"><i class="fa fa-calendar fa-fw" aria-hidden="true"></i>Months</a>
                    </li>

                    <li>
                        <a href="{{url('plansmanagement')}}" class="waves-effect"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i>Plans Management</a>
                    </li>

                    <li>
                        <a href="{{url('commissions')}}" class="waves-effect"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i>Commission Settings</a>
                    </li>

                    <li>
                        <a href="{{url('showfeaturelist')}}" class="waves-effect"><i class="fa fa-cogs fa-fw" aria-hidden="true"></i>Features Management</a>
                    </li>


                     <li class="submenu"> <a href="#"><i class="fa fa-cogs fa-fw"></i> <span>Coupons</span></a>
                      <ul>
                        <li><a href="{{ url('/superadmin/add-coupon')}}">Add Coupon</a></li>
                        <li><a href="{{ url('/superadmin/view-coupons')}}">View Coupons</a></li>
                      </ul>
                    </li>

                    <li class="submenu"> <a href="#"><i class="fa fa-cogs fa-fw"></i> <span>Reports</span> </a>
                      <ul>
                   <li>
                        <a href="{{url('agent-users')}}" class="waves-effect"><i class="fa fa-registered fa-fw" aria-hidden="true"></i>Agent Users</a>
                    </li>
                    <li>
                        <a href="{{url('registered-users')}}" class="waves-effect"><i class="fa fa-registered fa-fw" aria-hidden="true"></i>Registered Users</a>
                    </li>
                    <li>
                        <a href="{{url('report-by-all-users')}}" class="waves-effect"><i class="fa fa-registered fa-fw" aria-hidden="true"></i>Report by Users</a>
                    </li>
                     <li>
                        <a href="{{url('superadmin/view-email-templates')}}" class="waves-effect"><i class="fa fa-registered fa-fw" aria-hidden="true"></i>Email Templates</a>
                    </li>

                      </ul>
                    </li>




                    <li>
                        <a href="{{url('registered-users')}}" class="waves-effect"><i class="fa fa-registered fa-fw" aria-hidden="true"></i>Registered Users</a>
                    </li>

                   <!--  <li>
                        <a href="{{url('listfeatureplan')}}" class="waves-effect">
                            <i class="fa fa-user fa-fw" aria-hidden="true"></i>Plans Features
                        </a>
                    </li> -->

                    <li>
                        <a class="waves-effect" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                    </li>
               </ul>
               <!---  <div class="center p-20">
                     <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger btn-block waves-effect waves-light">Upgrade to Pro</a>
                 </div> -->
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


        <script src="{{ asset('template/js/custom.min.js') }}"></script>
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
    


        <script>

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@yield('scripts')
</body>
</html>
