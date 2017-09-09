@extends('layouts.admin') @section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>文件管理</h5>

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
                @if(!empty(session('error')))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif

                <a href="" class="btn btn-primary">上传</a>
                <a href="#"
                   class="btn btn-primary">批量删除</a>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">更多操作
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#" onclick="">移动</a>
                        </li>
                        <li><a href="#" onclick="">复制</a>
                        </li>
                    </ul>
                </div>


                <div class="clearfix" style="clear:both"></div>
                <div class="layui-form">
                    <div class="table-min">
                        <table class="layui-table" lay-skin="line">
                            <colgroup>
                                <col width="50">
                                <col>
                                <col>
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th><input name="" lay-skin="primary" lay-filter="allChoose" type="checkbox"></th>
                                <th>文件名</th>
                                <th>大小</th>
                                <th>修改时间</th>
                                <th style="text-align: right;" width="300">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input data-id="" name="ck" lay-skin="primary" lay-filter="son"
                                           type="checkbox"></td>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td class="editmenu"><span><a class="btlink" href="javascript:;"
                                onclick="CopyFile('/www/wwwroot/xtld.dqzd.com/app/Console')">复制</a> |<a
                                class="btlink" href="javascript:;"
                                onclick="CutFile('/www/wwwroot/xtld.dqzd.com/app/Console')">剪切</a> | 						<a
                                class="btlink" href="javascript:ReName(0,'Console');">重命名</a> | 						<a
                                class="btlink"
                                href="javascript:SetChmod(0,'/www/wwwroot/xtld.dqzd.com/app/Console');">权限</a> | 						<a
                                class="btlink"
                                href="javascript:Zip('/www/wwwroot/xtld.dqzd.com/app/Console');">压缩</a> | 						<a
                                class="btlink" href="javascript:;"
                                onclick="DeleteDir('/www/wwwroot/xtld.dqzd.com/app/Console')">删除</a></span>
                                </td>
                            </tr>
                            <tr>
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>


            <script src="{{asset('static/admin/js/content.min.js?v=1.0.0')}}"></script>
            <script src="{{asset('static/admin/js/plugins/validate/jquery.validate.min.js')}}"></script>
            <script src="{{asset('static/admin/js/plugins/validate/messages_zh.min.js')}}"></script>
            <script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
            <script src="{{asset('static/admin/css/layui/layui.js')}}"></script>
            <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>
            <script src="{{asset('static/admin/js/other.js')}}"></script>

            <script>
                var arr = [];
                layui.use('form', function () {
                    var $ = layui.jquery,
                        form = layui.form();
                    //全选
                    form.on('checkbox(allChoose)', function (data) {

                        var child = $(data.elem).parents('table').find('tbody td input[name="ck"]');
                        child.each(function (index, item) {
                            item.checked = data.elem.checked;
                        });
                        if (data.elem.checked == false) {
                            arr = [];
                        } else {
                            child.each(function () {
                                arr.push($(this).data('id'));
                            });
                        }
                        form.render('checkbox');
                        //  console.log(arr);
                    });

                    form.on('checkbox(son)', function (data) {
                        if (data.elem.checked == false) {
                            arr.splice($.inArray($(data.elem).data('id'), arr), 1);
                        }
                        else {
                            arr.push($(data.elem).data('id'));
                        }
                        //     console.log(arr);

                    });
                });



            </script>



@endsection
