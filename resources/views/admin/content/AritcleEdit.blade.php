@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('static/admin/css/plugins/webuploader/webuploader.css')}}">
    <script src="{{asset('static/admin/wangEditor.min.js')}}"></script>
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('static/admin/css/demo/webuploader-demo.min.css')}}"> --}}
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>文章编辑</h5>
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
                                <input type="hidden" name="id" value="{{$data['id']}}">
                                <label class="col-sm-1 control-label">名称：</label>
                                <div class="input-group col-sm-4">
                                    <input id="name" type="text" class="form-control" value="{{$data['name']}}"
                                           name="name" required aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">英文名称：</label>
                                <div class="input-group col-sm-4">
                                    <input id="enname" type="text" class="form-control" value="{{$data['enname']}}"
                                           name="enname"
                                           aria-required="true">

                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">伪静态</label>
                                <div class="col-md-4 input-group">
                                    <input id="jt" name="rewrite" class="form-control" type="text"
                                           value="{{$data['rewrite']}}" name="icon"
                                           required aria-required="true">
                                    <span class="input-group-addon shengcheng " onclick="rewrite()"
                                          style="width:80px;cursor: pointer;pointer-events: auto;">自动生成</span>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-sm-1 control-label">所属分类：</label>
                                <div class="input-group col-sm-4">
                                    <select class="form-control" name="path" id="path" required="">
                                        @foreach ($str as $v)
                                            @if ($v['id'] != $data['id'])
                                                <option @if ($v['id'] == $data['id'])  selected="select"
                                                        @endif    value="{{$v['path']}}-{{$v['id']}}">{{$v['html']}}{{$v['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-1 control-label">发布时间：</label>
                               <div class="input-group col-sm-4">
                                <input class="layui-input form-control" required name="time" value="{{$data['time']}}" placeholder="YYYY-MM-DD" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD'})">
                               </div>
                              </div>
                                       <div class="form-group">
                                           <label class="col-sm-1 control-label">点击量：</label>
                                           <div class="input-group col-sm-1">
                                               <input id="click" type="text" value="{{$data['click']}}" class="form-control" name="click"
                                                      aria-required="true">
                                           </div>
                                       </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">排序：</label>
                                <div class="input-group col-sm-1">
                                    <input id="site_sort" type="text" value="{{$data['sort']}}" class="form-control"
                                           name="sort"
                                           aria-required="true">
                                </div>
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
                                <label class="col-sm-1 control-label">主要内容：</label>
                                <div class="input-group col-sm-8">
                                    <div id="editor">
                                    </div>
                                </div>
                                <input type="hidden" name="info" id="info" value='{{$data['info']}}'>
                            </div>
                            <div class="form-group layui-form">
                                <label class="col-sm-1 control-label">推荐：</label>
                                <div class=" col-sm-1">
                                    <input type="checkbox" lay-skin="switch" @if ($data['recommend'] == 1) checked=""
                                           @endif lay-filter="switchTest" lay-text="ON|OFF">
                                    <input type="hidden" class="recommend" name="recommend"
                                           value="{{ $data['recommend'] }}">
                                </div>

                                <label class=" control-label" style="float: left; margin-right: 15px">显示：</label>
                                <div class="input-group col-sm-1">
                                    <input type="checkbox" @if ($data['show'] == 1) checked="" @endif lay-skin="switch"
                                           lay-filter="switchTestshow" lay-text="ON|OFF">
                                    <input type="hidden" class="show" name="show" value="{{ $data['show'] }}">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">缩略图：</label>
                                <div class="col-md-4 input-group">
                                    <input type="file" name="image" style="display:none">
                                    <span class="input-group-addon" onclick="readyUp(event)"
                                          style="cursor: pointer; background-color: #e7e7e7"><i
                                                class="fa fa-folder-open"></i>选择</span>
                                    <input name="img" class="form-control" type="text" value="{{ $data['img'] }}">
                                    <span class="input-group-addon ut2" onclick="uploads(event)"
                                          style="width:80px;cursor: pointer;pointer-events: auto;"><i
                                                class="fa fa-folder-open"></i>点击上传</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">下载：</label>
                                <div class="col-md-4 input-group">
                                    <input type="file" name="image" style="display:none">
                                    <span class="input-group-addon" onclick="readyUp(event)"
                                          style="cursor: pointer; background-color: #e7e7e7"><i
                                                class="fa fa-folder-open"></i>选择</span>
                                    <input name="down" class="form-control" type="text" value="{{ $data['down'] }}">
                                    <span class="input-group-addon ut2" onclick="uploads(event)"
                                          style="width:80px;cursor: pointer;pointer-events: auto;"><i
                                                class="fa fa-folder-open"></i>点击上传</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">外链：</label>
                                <div class="input-group col-sm-4">
                                    <input id="keywords" type="text" value="{{ $data['link'] }}" class="form-control"
                                           name="link"
                                           aria-required="true">

                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">多图上传：</label>
                                <div class="input-group col-sm-8">
                                    <div id="uploader-demo">
                                        <!--用来存放item-->
                                        <div id="thelist" class="uploader-list clearfix">
                                            @foreach (codeimg($data['moreimg']) as $v)
                                                <div class="file-item thumbnail upfa upload-state-done"
                                                     data-img="{{$v}}"><img src="{{ asset('static/uploads') }}/{{$v}}">
                                                    <a id="fancybox-close" onclick="removeimg(event)"
                                                       style="display: inline;"></a></div>
                                            @endforeach
                                        </div>
                                        <div>
                                            <div id="filePicker">选择图片</div>

                                        </div>
                                    </div>
                                    <input type="hidden" id="moreimg" name="moreimg" value="{{ $data['moreimg'] }}">
                                </div>
                            </div>

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
                            <div class="form-group layui-form">
                                <label class="col-sm-1 control-label">语言：</label>
                                <div class=" col-sm-4">
                                    <input type="radio" name="lang" value="cn" @if ($data['lang'] == 'cn') checked=""
                                           @endif title="中文">
                                    <input type="radio" name="lang" value="en" @if ($data['lang'] == 'en') checked=""
                                           @endif title="英文">
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
    <script src="{{asset('static/admin/wangEditor.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/webuploader/webuploader.min.js')}}"></script>
    <script src="{{asset('static/admin/js/demo/upload.js')}}"></script>


    <script type="text/javascript">
        function toVaild() {
            var jz;
            var url = "{{ route('AritcleEdit')}}";
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
            var info = '{!! $data['info'] !!}';
            editor(info);
        })
    </script>
@endsection
