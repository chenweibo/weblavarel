@extends('layouts.admin')

@section('content')
        <script src="{{asset('static/admin/wangEditor.min.js')}}"></script>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>单篇编辑</h5>
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
                                <input type="hidden" name="id" value="{{ $data['id'] }}">
                                <label class="col-sm-1 control-label">名称：</label>
                                <div class="input-group col-sm-4">
                                    <input id="name" type="text" class="form-control" value="{{ $data['name'] }}" disabled
                                           name="name" required aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">主要内容：</label>
                                <div class="input-group col-sm-8">
                                    <div id="editor">
                                    </div>
                                </div>
                                <input type="hidden" name="info" id="info" value=''>
                            </div>
                            @foreach ($file as $v)
                             @if ($v->column_type==0)
                               <div class="form-group">
                                   <label class="col-sm-1 control-label">{{$v->column_name}}：</label>
                                   <div class="input-group col-sm-4">
                                       <input id="{{$v->column_name}}" type="text" class="form-control" value="{{$data[$v->column_name]}}"
                                              name="{{$v->column_name}}" required aria-required="true">
                                   </div>
                               </div>
                             @endif
                             @if ($v->column_type==1)
                               <div class="form-group">
                                   <label class="col-sm-1 control-label">{{$v->column_name}}：</label>
                                   <div class="input-group col-sm-4">
                                       <textarea class="layui-textarea" name="{{$v->column_name}}" rows="8" cols="80">{{$data[$v->column_name]}}</textarea>
                                   </div>
                               </div>
                             @endif
                             @if ($v->column_type==2)
                               <div class="form-group">
                                   <label class="col-sm-1 control-label">{{$v->column_name}}：</label>
                                   <div class="input-group col-sm-8">
                                       <div id="{{$v->column_name}}">
                                       </div>
                                   </div>
                            <input type="hidden" name="{{$v->column_name}}" class="{{$v->column_name}}" value=''>
                               </div>
                               <script type="text/javascript">
                               var E = window.wangEditor
                               var str = '{!! $data[$v->column_name] !!}';
                               var {{$v->column_name}} = new E('#{{$v->column_name}}')
                               {{$v->column_name}}.customConfig.uploadImgServer = '/EditUploads'
                               {{$v->column_name}}.customConfig.uploadFileName = 'images[]'
                               {{$v->column_name}}.customConfig.uploadImgHeaders = {
                                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               }
                               {{$v->column_name}}.customConfig.onchange = function (html) {
                                   $('.{{$v->column_name}}').attr('value', html)
                               }
                               {{$v->column_name}}.create()
                               {{$v->column_name}}.txt.html(str)
                               </script>
                             @endif
                             @if ($v->column_type==3)
                               <div class="form-group">
                                   <label class="col-sm-1 control-label">{{$v->column_name}}：</label>
                                   <div class="col-md-4 input-group">
                                       <input type="file" name="image" style="display:none">
                                       <span class="input-group-addon" onclick="readyUp(event)"
                                             style="cursor: pointer; background-color: #e7e7e7"><i
                                                   class="fa fa-folder-open"></i>选择</span>
                                       <input name="{{$v->column_name}}" class="form-control" type="text" value="{{$data[$v->column_name]}}">
                                       <span class="input-group-addon ut2" onclick="uploads(event)"
                                             style="width:80px;cursor: pointer;pointer-events: auto;"><i
                                                   class="fa fa-folder-open"></i>点击上传</span>
                                   </div>
                               </div>
                             @endif
                            @endforeach

                            <div class="form-group">
                                <label class="col-sm-1 control-label">关键字：</label>
                                <div class="input-group col-sm-4">
                                    <input id="keywords" type="text" value="{{ $data['keywords'] }}" class="form-control"
                                           name="keywords" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">关键字描述：</label>
                                <div class="input-group col-sm-4">
                                    <input id="description" type="text" value="{{ $data['description'] }}"
                                           class="form-control" name="description" aria-required="true">
                                </div>
                            </div>
                            <div class="btn-group jj ">
                                <button class="btn btn-primary" type="submit">提交</button>
                                <a class="btn btn-primary" style="margin-left:10px" onclick="history.go(-1)"
                                   href="#">返回</a>
                            </div>
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
        function toVaild() {
            var jz;
            var url = "{{ route('PageEdit')}}";
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


        $(function () {
            var info = '{!! compress_html($data["info"]) !!}';
            editor(info);
        })

    </script>



@endsection
