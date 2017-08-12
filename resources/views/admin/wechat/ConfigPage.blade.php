@extends('layouts.admin')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>微信配置</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                      <div class="alert alert alert-info">
                   以下是公众号配置，全部必填 token字段自定义字符串，公众号配置里token和本页面token配置必须相同。
                      </div>
                        <form class="form-horizontal m-t" id="commentForm" method="post" onsubmit="return toVaild()">
                          <div class="form-group">
                              <label class="col-sm-3 control-label">url：</label>
                              <div class="input-group col-sm-4">
                                  <input id="username" type="text" class="form-control" name="url" disabled value="http://网站域名/wechat"
                                         aria-required="true">
                              </div>
                          </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">app_id：</label>
                                <div class="input-group col-sm-4">
                                    <input id="username" type="text" class="form-control" value="{{$data['app_id']}}" name="app_id" required=""
                                           aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">secret：</label>
                                <div class="input-group col-sm-4">
                                    <input id="username" type="text" class="form-control" name="secret" value="{{$data['secret']}}" required=""
                                           aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">token：</label>
                                <div class="input-group col-sm-4">
                                    <input id="username" type="text" class="form-control" name="token" value="{{$data['token']}}" required=""
                                           aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">JS接口安全域名：</label>
                                <div class="input-group col-sm-4">
                                    <input id="username" type="text" class="form-control" name="username" disabled value="http://你的域名"
                                           aria-required="true">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <!--<input type="button" value="提交" class="btn btn-primary" id="postform"/>-->
                                    <button class="btn btn-primary" type="submit">保存</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script src="{{asset('static/admin/js/content.min.js?v=1.0.0')}}"></script>
    <script src="{{asset('static/admin/js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/validate/messages_zh.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('static/admin/css/layui/layui.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>
    <script src="{{asset('static/admin/js/other.js')}}"></script>
    <script type="text/javascript">
        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",});
        function toVaild() {
            var jz;
            var url = "{{ route('WechatConfig')}}";
            $.ajax({
                type: "POST",
                url: url,
                data: $('#commentForm').serialize(),// 你的formid
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
                },
                error: function (request) {
                    layer.close(jz);
                    swal("网络错误!", "", "error");
                },
                success: function (data) {
                    //关闭加载层
                    layer.close(jz);
                    if (data.code == 1) {
                        window.location.href = data.data;
                    } else {
                        swal(data.msg, "", "error");
                    }
                }
            });

            return false;
        }


    </script>



@endsection
