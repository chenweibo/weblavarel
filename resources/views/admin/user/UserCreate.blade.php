@extends('layouts.admin')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-8">
            <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>添加管理员</h5>
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
                          <div class="form-group">
                              <label class="col-sm-3 control-label">管理员名称：</label>
                              <div class="input-group col-sm-4">
                                  <input id="username" type="text" class="form-control" name="username" required="" aria-required="true">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">管理员角色：</label>
                              <div class="input-group col-sm-4">
                                  <select class="form-control" name="typeid" required="" aria-required="true">
                                      <option value="0">请选择</option>
                                      @if (!empty($role))
                                        @foreach ($role as $key )
                                         <option value="{{$key->id}}">{{$key->rolename}}</option>
                                        @endforeach
                                      @endif
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">登录密码：</label>
                              <div class="input-group col-sm-4">
                                  <input id="password" type="text" class="form-control" name="password" required="" aria-required="true">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">真是姓名：</label>
                              <div class="input-group col-sm-4">
                                  <input id="real_name" type="text" class="form-control" name="real_name" required="" aria-required="true">

                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">是否启用：</label>
                              <div class="input-group col-sm-4">

                                  @foreach ($status as $key => $value)
                                    <div class="radio i-checks col-sm-4">
                                        <label>
                                            <input type="radio" value="{{$key}}" @if ($key == 1) checked @endif  name="status"> <i></i>{{$value}}</label>
                                    </div>
                                  @endforeach
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-4 col-sm-offset-3">
                                  <!--<input type="button" value="提交" class="btn btn-primary" id="postform"/>-->
                                  <button class="btn btn-primary" type="submit">提交</button>
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
$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});
function toVaild(){
    var jz;
    var url = "{{ route('UserCreate')}}";
    $.ajax({
        type:"POST",
        url:url,
        data: $('#commentForm').serialize(),// 你的formid
        async: false,
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        beforeSend:function(){
            jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        },
        error: function(request) {
            layer.close(jz);
             swal("网络错误!", "", "error");
        },
        success: function(data) {
            //关闭加载层
            layer.close(jz);
            if(data.code == 1){
              window.location.href = data.data;
            }else{
                swal(data.msg, "", "error");
            }
        }
    });

    return false;
}



</script>



@endsection
