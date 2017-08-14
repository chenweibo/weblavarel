@extends('layouts.admin')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加菜单</h5>
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
                                <label class="col-sm-3 control-label">名称：</label>
                                <div class="input-group col-sm-4">
                                    <input id="username" type="text" class="form-control" value="{{$data->name}}" name="name" required
                                           aria-required="true">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">类别：</label>
                                <div class="input-group col-sm-4">
                                    <select class="form-control" name="pid" required="" aria-required="true">
                                        <option value="0">顶级分类</option>
                                        @foreach ($str as $v)
                                          <option @if($v['id']==$data->pid) selected="select" @endif value="{{$v['id']}}">{{$v['html']}}{{$v['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">排序：</label>
                                <div class="input-group col-sm-4">
                                    <input id="sort" type="text" class="form-control" value="{{$data->sort}}" name="sort" required
                                           aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">url地址：</label>
                                <div class="input-group col-sm-4">
                                    <input id="url" type="text" value="{{$data->url}}" class="form-control" name="url" required
                                           aria-required="true">
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
    <script src="{{asset('static/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('static/admin/css/layui/layui.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>
    <script src="{{asset('static/admin/js/other.js')}}"></script>
    <script type="text/javascript">
        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",});
        function toVaild() {
            var jz;
            var url = "{{ route('MenuEdit')}}";
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
