@extends('layouts.admin')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-10">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加栏目</h5>
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
                                    <input id="name" type="text" class="form-control" name="name" required
                                           aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">英文名称：</label>
                                <div class="input-group col-sm-4">
                                    <input id="enname" type="text" class="form-control" name="enname"
                                           aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">伪静态</label>
                                <div class="col-md-4 input-group">
                                    <input id="jt" name="rewrite" class="form-control" type="text" value="" name="icon"
                                           required aria-required="true">
                                    <span class="input-group-addon shengcheng " onclick="rewrite()"
                                          style="width:80px;cursor: pointer;pointer-events: auto;">自动生成</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">所属父分类：</label>
                                <div class="input-group col-sm-4">
                                    <select class="form-control" name="path" required>

                                        <option value="0">顶级分类</option>
                                        @foreach ($data as $v)
                                            <option value="{{$v['path']}}-{{$v['id']}}">{{$v['html']}}{{$v['name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">类型：</label>
                                <div class="input-group col-sm-4">
                                    <select class="form-control" name="type" required>
                                        <option value="0">常规</option>
                                        <option value="1">单篇</option>
                                        <option value="2">产品</option>
                                        <option value="3">文章</option>
                                        <option value="4">图片</option>
                                        <option value="5">下载</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">排序：</label>
                                <div class="input-group col-sm-4">
                                    <input id="sort" type="text" value="99" class="form-control" name="sort"
                                           aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">url：</label>
                                <div class="input-group col-sm-4">
                                    <input id="url" type="text" class="form-control" name="url" required
                                           aria-required="true">
                                </div>
                            </div>
                            <div class="form-group layui-form">
                                <label class="col-sm-3 control-label">推荐：</label>
                                <div class=" col-sm-1">
                                    <input type="checkbox" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                                    <input type="hidden" class="recommend" name="recommend" value="0">
                                </div>

                                <label class=" control-label" style="float: left; margin-right: 15px">显示：</label>
                                <div class="input-group col-sm-1">
                                    <input type="checkbox" checked="" lay-skin="switch" lay-filter="switchTestshow"
                                           lay-text="ON|OFF">
                                    <input type="hidden" class="show" name="state" value="1">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">缩略图：</label>
                                <div class="col-md-4 input-group">
                                    <input type="file" name="image" style="display:none">
                                    <span class="input-group-addon" onclick="readyUp(event)"
                                          style="cursor: pointer; background-color: #e7e7e7"><i
                                                class="fa fa-folder-open"></i>选择</span>
                                    <input name="img" class="form-control" type="text" value="">
                                    <span class="input-group-addon ut2" onclick="uploads(event)"
                                          style="width:80px;cursor: pointer;pointer-events: auto;"><i
                                                class="fa fa-folder-open"></i>点击上传</span>
                                </div>
                            </div>

                            <div class="form-group layui-form">
                                <label class="col-sm-3 control-label">语言：</label>
                                <div class=" col-sm-4">
                                    <input type="radio" name="lang" value="cn" title="中文" checked="">
                                    <input type="radio" name="lang" value="en" title="英文">
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
            var url = "{{ route('ColumnCreate')}}";
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

        layui.use(['form', 'layedit', 'laydate'], function () {
            var form = layui.form()
                , layer = layui.layer


            //监听指定开关
            form.on('switch(switchTest)', function (data) {
                $('.cate_recommend').attr('value', this.checked ? '1' : '0')

            });

            form.on('switch(switchTestshow)', function (data) {
                $('.show').attr('value', this.checked ? '1' : '0')

            });

        });

    </script>



@endsection
