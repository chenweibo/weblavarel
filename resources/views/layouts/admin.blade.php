<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站后台</title>
    {{-- <link rel="shortcut icon" href="favicon.ico"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('static/admin/css/bootstrap.min.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/font-awesome.min.css?v=4.7.0') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/style.min.css?v=4.1.0') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/other.css') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/layui/css/layui.css') }}" rel="stylesheet">
    <script src="{{ asset('static/admin/js/jquery.min.js?v=2.1.4') }}"></script>
    <script src="{{ asset('static/admin/js/bootstrap.min.js?v=3.3.6') }}"></script>


</head>

<body class="gray-bg">


    @yield('content')


</body>
</html>
