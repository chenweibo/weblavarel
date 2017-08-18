<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')"/>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('static/home/img/icon.ico') }}">
    <link href="{{ asset('static/home/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('static/home/css/bootstrapValidator.css') }}" rel="stylesheet" />
    <link href="{{ asset('static/home/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('static/home/css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('static/home/css/pc.css') }}" rel="stylesheet">
    <link href="{{ asset('static/home/css/ipad.css') }}" rel="stylesheet">
    <link href="{{ asset('static/home/css/mobile.css') }}" rel="stylesheet">
    <link href="{{ asset('static/home/css/animate.min.css') }}"rel="stylesheet" >
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('static/home/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('static/home/js/respond.min.js') }}"></script>
    <![endif]-->
    <script src="{{ asset('static/home/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/home/js/jquery.SuperSlide.2.1.1.js') }}"></script>
    <script src="{{ asset('static/home/js/wow.min.js') }}"></script>
    <script src="{{ asset('static/home/layer/layer.js') }}" type="text/javascript"></script>
</head>
<body>

    @yield('content')

  <script>
      new WOW().init();
  </script>
  <script src="{{ asset('static/home/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('static/home/js/bootstrapValidator.js') }}"></script>

</body>
</html>
