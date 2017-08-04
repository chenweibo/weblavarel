<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>网站后台登录</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('static/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/font-awesome.min.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('static/admin/css/login.min.css') }}" rel="stylesheet">

    <script>
        if (window.top !== window.self) {
            window.top.location = window.location
        }
        ;
    </script>

</head>

<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <div class="logopanel m-b">
                </div>
                <div class="m-b"></div>
                <h4>欢迎使用 <strong>网站后台</strong></h4>
                <ul class="m-b">

                </ul>
            </div>
        </div>
        <div class="col-sm-5">
            <form method="post" action="index.html">
                <p class="m-t-md" id="err_msg">登录到后台</p>
                <input type="text" class="form-control uname" placeholder="用户名" id="username"/>
                <input type="password" class="form-control pword m-b" placeholder="密码" id="password"/>
                <div style="margin-bottom:70px">
                    <input type="text" class="form-control" placeholder="验证码"
                           style="color:black;width:120px;float:left;margin:0px 0px;" name="captcha" id="code"/>
                    <img id="imgcode" src="{{captcha_src('default')}}"
                         onclick="javascript:this.src='{{captcha_src('default')}}?default='+Math.random();"
                         style="float:right;cursor: pointer"/>

                </div>
                {{ csrf_field() }}
                <input class="btn btn-success btn-block" id="login_btn" value="登录"/>
            </form>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            &copy; 2017 All Rights Reserved.
        </div>
    </div>
</div>
<script src="{{ asset('static/admin/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('static/admin/js/bootstrap.min.js?v=3.3.6') }}"></script>
<script type="text/javascript">
    document.onkeydown = function (event) {
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if (e && e.keyCode == 13) { // enter 键
            $('#login_btn').click();
        }
    };

    $(function () {
        $('#login_btn').click(function () {
            var username = $('#username').val();
            var password = $('#password').val();
            var token = $('input[name=_token]').val();
            var code = $('#code').val();

            $.ajax({
                url: "{{ url('jksm') }}",
                type: "post", //请求类型
                data: {'username': username, 'password': password, 'captcha': code, '_token': token}, //请求的数据
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.code != 1) {
                        $('#err_msg').show().html("<span style='color:red'>" + data.msg + "</span>");
                        $('#imgcode').attr('src', '{{captcha_src("default")}}?default=' + Math.random());

                    } else {

                        window.location.href = data.data;
                    }
                },
                error: function (msg) {
                    var json = JSON.parse(msg.responseText);
                    console.log(json);
                },

            })

        });
    });
</script>
</body>

</html>
