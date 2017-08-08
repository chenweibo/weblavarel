@extends('layouts.admin')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>编辑管理员</h5>
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
                      <form class="form-horizontal m-t" id="commentForm" method="post" onsubmit="return toVaild()">
                          <input type="hidden" name="id" value="{{$data->id}}">
                          <div class="form-group">
                              <label class="col-sm-3 control-label">会员名称：</label>
                              <div class="input-group col-sm-4">
                                  <input id="name" type="text" value="{{$data->name}}" class="form-control" name="name" required=""
                                         aria-required="true">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">帐号：</label>
                              <div class="input-group col-sm-4">
                                  <input id="email" type="text" value="{{$data->email}}" class="form-control" name="email" required=""
                                         aria-required="true">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">登录密码：</label>
                              <div class="input-group col-sm-4">
                                  <input id="password" type="text" value="" class="form-control" name="password" required
                                         aria-required="true" placeholder="输入新密码">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">是否启用：</label>
                              <div class="input-group col-sm-4">

                                  @foreach ($status as $key => $value)
                                      <div class="radio i-checks col-sm-4">
                                          <label>
                                              <input type="radio" value="{{$key}}" @if ($key == $data->status) checked
                                                     @endif  name="status"> <i></i>{{$value}}</label>
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-4 col-sm-offset-3">
                                  <!--<input type="button" value="提交" class="btn btn-primary" id="postform"/>-->
                                  <button class="btn btn-primary" type="submit">提交</button>
                                  <a class="btn btn-primary" onclick="history.go(-1)" href="#">返回</a>
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
    <script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('static/admin/css/layui/layui.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>
    <script src="{{asset('static/admin/js/other.js')}}"></script>
    <script type="text/javascript">
        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",});
        function toVaild() {
            var jz;
            var url = "{{ route('MemberEdit')}}";
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
