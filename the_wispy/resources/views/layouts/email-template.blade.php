<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head><meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('template/plugins/images/favicon.png') }}">
   <title>TheWiSpy Remote Monitoring Dashboard </title>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TheWiSpy') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/email-template.css') }}" rel="stylesheet">
</head>
<body>
<section class="email-template-section" style="width: auto;background:#F1F2F2; margin: 0px auto;padding: 60px 0px;; text-align: center;">
    <article class="email-template-container" style="max-width: 600px; margin: 0px auto; text-align: center;">
        @yield('content')
    </article>
</section>

</body>
</html>
