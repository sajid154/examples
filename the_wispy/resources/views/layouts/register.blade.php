<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') - TheWiSpy</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>

<!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<link href="{{ asset('css/offcanvas-mobile.css') }}" rel="stylesheet">


<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/common-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    @yield('styles')

</head>
    <section class="main_wrapper">
        <header>
<form class="hidden-form" id="demo-login-user" method="post" action="https://cp.thewispy.com/login" style="display: none;">
                                        <input id="email" type="hidden" class="form-control" name="email" value="demo@thewispy.com">
                                        <input id="password" type="hidden" class="form-control" name="password" value="12345678">
                                    </form>
 <nav class="navbar navbar-white bg-white">
    <section class="logo mobile">
                                <a href="https://www.thewispy.com/"><img src="https://www.thewispy.com/wp-content/themes/twentysixteen/images/logo.png" alt="TheWiSpy Official Brand Logo"></a>
                            </section>
    <button class="navbar-toggler" type="button" data-trigger="#navbar_main">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg navbar-dark bg-primary">
<div class="offcanvas-header">  
    <button class="btn btn-danger btn-close float-right"> <i class="fa fa-times" aria-hidden="true"></i>
</button>
</div>
<div class="container">
 <section class="logo desktop">
                                <a href="https://www.thewispy.com/"><img src="https://www.thewispy.com/wp-content/themes/twentysixteen/images/logo.png" alt="TheWiSpy Official Brand Logo"></a>
                            </section>
<ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link  dropdown-toggle"  data-toggle="dropdown"> Products </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="https://www.thewispy.com/android-spy/"> Andriod Spy App</a></li>
          <!-- <li><a class="dropdown-item" href="https://www.thewispy.com/kids-monitoring/"> Kids Monitoring </a></li> -->
          <li><a class="dropdown-item" href="https://www.thewispy.com/employee-monitoring/"> Employee Monitoring </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/parental-control/"> Parental Control </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/mobile-tracker/"> Mobile Tracker </a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link  dropdown-toggle" href="https://www.thewispy.com/features/" data-toggle="dropdown"> Features </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="https://www.thewispy.com/spy-phone-calls/">Call Recording</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/track-call-history/">Track Call History</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/hack-phone-contacts/">Hack Phone Contacts</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/monitor-photos/"> Monitor Saved Photos </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/spy-microphone/">Spy Microphone Surroundings </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/app-monitoring/">App Monitoring </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/spy-text-messages/">Spy Text Messages </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/spy-video-recordings/">Video Recording </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/voice-message-recording/">Voice Message Recording </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/monitor-calendar-activities/">Monitor Calendar Dates</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/hack-wifi-logs/">Wifi Log</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/photo-capturing-spy/">Photo Capturing Spy</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/remote-access-to-target-phone/">Remote Access to Target Phone</a></li>
          <li><a class="dropdown-item" href="24/7 Instant Alerts">24/7 Instant Alerts</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/memos-reminder/">Memos Reminder</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/track-gps-location/">GPS Location</a></li>
        </ul>
    </li>
    <li class="nav-item"><a class="nav-link" href="https://www.thewispy.com/pricing/"> Pricing </a></li>
    <li class="nav-item dropdown">
        <a class="nav-link  dropdown-toggle" data-toggle="dropdown"> Help </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="https://www.thewispy.com/how-it-works/"> How it Works</a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/android-installation-guide/"> How to install TheWispy </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/blog/"> Blog </a></li>
          <li><a class="dropdown-item" href="https://www.thewispy.com/faqs/"> FAQs </a></li>
        </ul>
    </li>
    <!-- <li class="nav-item"><a class="nav-link" href="#"> Demo </a></li> -->
    <li class="nav-item"><a class="nav-link" id="demo-login-user"> Demo </a></li>
    <li class="nav-item"><a class="nav-link" href="https://cp.thewispy.com/login"><img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAAVABUDASIAAhEBAxEB/8QAGAABAQEBAQAAAAAAAAAAAAAAAAcIBQb/xAAmEAABAwMEAgIDAQAAAAAAAAABAgMEAAURBgcSIQhhEyIxQXEU/8QAGAEAAwEBAAAAAAAAAAAAAAAAAAQGAQL/xAAfEQABAwUBAQEAAAAAAAAAAAABAAIRAwQFITESQYH/2gAMAwEAAhEDEQA/ANOeTvlVdtL6jk6S0c8mHIifSdcygLWHCAfjbBBAwD2rBOehjGTJn93N69qZkC43i6XAsy/uhi6LTIZdA7KVDJKD3+AUqrjbmaN+TyQ1Hab5PRZI8y7vyVTn1AJbZcUp1CsqIHaSkA56J9V77f5Nh1NotmRH17Euky1pCkQhJjOKkqUUpUrDeDyx3+x0eu81KZPNPsMnaWTWy2pPs+XGJ0yCBAl3Z4N66madEPpuf9HOfq1jsxupD3g0JEv8Vr/M/wAixLi8uXwvJxyTn9ggpUPShSpF4I2SbA20u9wfCm4k+4kxgr8LCEBKlj1yyn+oNKrCllS94NgdMbzMMruzbsO6R0/GxcohAdSnJPBWQQpOSTgjrJwRk1J9P+BOm4Nxaeu2op91iIIUYrTKY/P0pWVHH8wfYpSskoWmLTaodjtka32+M3DhRmw0ywykJQhIHQApSlC5X//Z" alt="TheWiSpy App Login icon" srcset="" sizes="" data-l=""> Login </a></li>
    <li class="nav-item"><a class="nav-link btn" href="https://cp.thewispy.com/register"> Sign Up </a></li>

</ul>

</nav>

</div>

</header>
    <main class="py-4">
            @yield('content')
    </main>

    <footer id="main_footer">
      <section class="footer-top desktop-footer">
        <article class="container">
          <figure class="footer-content footer-about">
            <img src="{{ asset('footer-logo.png') }}" alt="TheWiSpy app footer white logo hahah"/>
            <p>Why choose us?<br> We are the best solution provider as a mega app, you will get all features in one app.</p>
            <section class="socail-media-icon">
              <p style="padding-bottom:20px;">Payment</p>
            <img src="https://www.thewispy.com/wp-content/uploads/2020/04/payment_visa.png" alt="TheWiSpy app visa card payment icon"/>
            <img src="https://www.thewispy.com/wp-content/uploads/2020/04/payment_mm.png" alt="TheWiSpy app master card payment icon"/>
            <img src="https://www.thewispy.com/wp-content/uploads/2020/04/payment_ae.png" alt="TheWiSpy app American express payment icon"/>
            <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=thewispy.com','SiteLock','width=600,height=600,left=160,top=170');" ><img class="img-responsive" alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/thewispy.com" /></a>
            </section>
          </figure>
          <figure class="footer-content footer-feature footer-forth-section">
            <h6>Features</h6>
            <ul>
              <li><a href="https://www.thewispy.com/spy-phone-calls/">Spy Phone Calls</a></li>
              <li><a href="https://www.thewispy.com/voice-message-recording/">Spy Microphone</a></li>
              <li><a href="https://www.thewispy.com/hack-phone-contacts/">Hack Phone Contacts</a></li>
              <li><a href="https://www.thewispy.com/spy-text-messages/">Spy Text Messages</a></li>
              <li><a href="https://www.thewispy.com/monitor-photos/">Monitor Saved Photos</a></li>
            </ul>
          </figure>
          <figure class="footer-content footer-company footer-forth-section">
            <h6>Company</h6>
            <ul>
              <li><a href="https://www.thewispy.com/blog/">Blog</a></li>
              <li><a href="https://www.thewispy.com/about">About</a></li>
              <li><a href="https://www.thewispy.com/faqs/">FAQ</a></li>
              <li><a href="https://www.thewispy.com/compatibility/">Compatibility</a></li>
              <li><a href="https://www.thewispy.com/contact/">Contact</a></li>
              <!--<li><a href="https://www.thewispy.com/support/">Support</a></li>-->
            </ul>
          </figure>
          <figure class="footer-content footer-info scail-media-link footer-forth-section">
            <h6>Follow Us</h6>
            <ul>
              <li><a rel="nofollow" href="https://www.facebook.com/thewispyapp/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a rel="nofollow" href="https://twitter.com/thewispyapp"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <!--<li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>-->
              <li><a rel="nofollow" href="https://www.pinterest.com/thewispyapp/"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
              <!---<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
            </ul>
          </figure>
          <figure class="footer-content footer-info footer-forth-section">
            <h6>Legal Info</h6>
            <ul>
              <li><a href="https://www.thewispy.com/disclaimer/">Disclaimer</a></li>
              <li><a href="https://www.thewispy.com/eula">EULA</a></li>
              <li><a href="https://www.thewispy.com/privacy-policy/">Privacy Policy</a></li>
              <li><a href="https://www.thewispy.com/refund-policy/">Refund Policy</a></li>
              <li><a href="https://www.thewispy.com/terms/">Terms</a></li>
            </ul>
          </figure>
          <figure class="footer-content footer-info footer-forth-section">
            <h6>Follow Us</h6>
            <ul>
              <li><a rel="nofollow" href="https://www.facebook.com/thewispyapp/"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
              <li><a rel="nofollow" href="https://twitter.com/thewispyapp"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
              <li><a rel="nofollow" href="https://www.youtube.com/channel/UCpLV6oLY1Ot83LBcsKMa7Rg"><i class="fa fa-youtube-play" aria-hidden="true"></i> Youtube</a></li>
              <li><a rel="nofollow" href="https://www.pinterest.com/thewispyapp/"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
            </ul>
          </figure>
        </article>
      </section>
      <section id="accordionEx1" class="mobile-footer accordion md-accordion" role="tablist" aria-multiselectable="false">
        <div class="card">
<a id="headingTwo1" class="collapsed" href="#features" data-toggle="collapse" data-parent="#accordionEx1" aria-expanded="false" aria-controls="features"><div class="card-header" role="tab" style="font-weight:bold">Features<i class="fa fa-angle-down rotate-icon"></i></div></a>
<div id="features" class="collapse" role="tabpanel" aria-labelledby="headingTwo1" data-parent="#accordionEx1" style="">
<div class="card-body">
  <ul>
              <li><a href="https://www.thewispy.com/spy-phone-calls/">Spy Phone Calls</a></li>
              <li><a href="https://www.thewispy.com/voice-message-recording/">Spy Microphone</a></li>
              <li><a href="https://www.thewispy.com/hack-phone-contacts/">Hack Phone Contacts</a></li>
              <li><a href="https://www.thewispy.com/spy-text-messages/">Spy Text Messages</a></li>
              <li><a href="https://www.thewispy.com/spy-browser-history/">Spy Browser History</a></li>
            </ul>
</div>
</div>
</div><div class="card">
<a class="collapsed" href="#features_1" id="headingTwo2" data-toggle="collapse" data-parent="#accordionEx1" aria-expanded="false" aria-controls="features_1"  role="tab"><div class="card-header" style="font-weight:bold">Company<i class="fa fa-angle-down rotate-icon"></i></div></a>
<div id="features_1" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx1" style="">
<div class="card-body">
    <ul>
              <li><a href="https://www.thewispy.com/about">About</a></li>
              <li><a href="https://www.thewispy.com/faqs/">FAQ</a></li>
              <li><a href="https://www.thewispy.com/contact/">Contact</a></li>
              <li><a href="https://www.thewispy.com/blog/">Blog</a></li>
            </ul>
</div>
</div>
</div><div class="card">
<a class="collapsed" href="#features_2" data-toggle="collapse" data-parent="#accordionEx1" aria-expanded="false" aria-controls="collapseTwo1"><div id="headingTwo1" class="card-header" role="tab" style="font-weight:bold"> Legal Info <i class="fa fa-angle-down rotate-icon"></i></div></a>
<div id="features_2" class="collapse" role="tabpanel" aria-labelledby="headingTwo1" data-parent="#accordionEx1" style="">
<div class="card-body">
  <ul>
              <li><a href="https://www.thewispy.com/eula">EULA</a></li>
              <li><a href="https://www.thewispy.com/privacy-policy/">Privacy Policy</a></li>
              <li><a href="https://www.thewispy.com/refund-policy/">Refund Policy</a></li>
              <li><a href="https://www.thewispy.com/disclaimer/">Disclaimer</a></li>
              <li><a href="https://www.thewispy.com/terms/">Terms</a></li>
            </ul>
</div>
</div>
</div>
<!-- <article class="mobile-fellowus-section"> -->
  <div class="card">
<a class="collapsed" href="#features_3" data-toggle="collapse" data-parent="#accordionEx1" aria-expanded="false" aria-controls="collapseTwo1"><div id="headingTwo1" class="card-header" role="tab" style="font-weight:bold"> Follow Us<i class="fa fa-angle-down rotate-icon"></i></div></a>
<div id="features_3" class="collapse" role="tabpanel" aria-labelledby="headingTwo1" data-parent="#accordionEx1" style="">
<div class="card-body">
  <!-- <h6>Follow Us</h6>  -->
  <ul>
              <li><a rel="nofollow" href="https://www.facebook.com/thewispyapp/">Facebook<i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a rel="nofollow" href="https://twitter.com/thewispyapp">Twitter<i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a rel="nofollow" href="https://www.youtube.com/channel/UCpLV6oLY1Ot83LBcsKMa7Rg">Youtube<i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
              <li><a rel="nofollow" href="https://www.pinterest.com/thewispyapp/">Pinterest<i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
              <!---<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
            </ul>
          </div></div></div> 
<!-- </article> -->
<article class="mobile-fellowus-section mobile-pyment-section">
  <h6>Payment</h6> 
  <ul>
              <li><img src="https://www.thewispy.com/wp-content/uploads/2020/04/payment_visa.png" alt="TheWiSpy app visa card payment icon"/></li>
              <li><img src="https://www.thewispy.com/wp-content/uploads/2020/04/payment_mm.png" alt="TheWiSpy app master card payment icon"/></li>
              <li><img src="https://www.thewispy.com/wp-content/uploads/2020/04/payment_ae.png" alt="TheWiSpy app American express payment icon"/></li>
              <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=thewispy.com','SiteLock','width=600,height=600,left=160,top=170');" ><img class="img-responsive" alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/thewispy.com" /></a>
            </ul>
</article>
      </section>
      <section class="disclaimer-section">
        <article class="container">
  
          <p style="font-size:16px; color:#fff;font-weight:500;">Disclaimer</p>
          <p>
            TheWiSpy Desktop and Cell Phone Spy app are designed for legal use only. The software is intended for the ethical supervision of employees and children with their consent. Using the software for intrusion and stalking purposes is highly discouraged by us. We reserve the right to cancel your license if any illicit or illegal activity is reported. The user will be solely responsible if any violation in the state law occurs.
          </p>
        </article>
      </section>
      <section class="footer-bottom">
        <article class="container">
          <figure class="footer-bottom-content">
            <p>Copyright © 2020 <a href="https://www.thewispy.com/">TheWiSpy.com</a>. All trademarks are the property of their respective owners</p>
          </figure>
        </article>
      </section>
    </footer>

    </section>
        <script type="text/javascript">

$(document).ready(function() {
  // jQuery code


  $("[data-trigger]").on("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        var offcanvas_id =  $(this).attr('data-trigger');
        $(offcanvas_id).toggleClass("show");
        $('body').toggleClass("offcanvas-active");
        $(".screen-overlay").toggleClass("show");
    }); 

    // Close menu when pressing ESC
    $(document).on('keydown', function(event) {
        if(event.keyCode === 27) {
           $(".mobile-offcanvas").removeClass("show");
           $("body").removeClass("overlay-active");
        }
    });

    $(".btn-close, .screen-overlay").click(function(e){
      $(".screen-overlay").removeClass("show");
        $(".mobile-offcanvas").removeClass("show");
        $("body").removeClass("offcanvas-active");


    }); 


}); // jquery end

jQuery ( function($) {

$(document).on('click', '#demo-login-user', function(e) {
e.preventDefault();
            $.get({
                url:"{{ url('demo-login-user') }}",
                success: function(data){
                if(data.success == true){
                  console.log(data);
                  // window.open( "{{ url('dashboard/1') }}");
                  window.location.href ="{{ url('dashboard/1') }}";
                    }
                }
            })
});



// $(document).on('click', '', function(e) {
// e.preventDefault();
//  document.getElementById('demo-login-user').submit();
// $(this).parentsUntil('.x-off-canvas-content').parent().prev().trigger('click'); //this closes the off canvas
// });

} );
$(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});



</script>


@yield('scripts')

</html>
