@extends('layouts.admin')
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>角色管理</h5>
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
                <a class="layui-btn w" href="{{route('RoleCreate')}}">添加角色</a>
                <div class="layui-form">
                    <div class="table-min">
                        <table class="layui-table">
                            <colgroup>
                                <col>
                                <col>
                                <col>
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>角色ID</th>
                                <th>角色名称</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($str as $v)
                                <tr data-id="{{$v->id}}">
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->rolename }}</td>
                                    <td>
                                        @if ($v->id != 1)
                                            <a href="{{route('RoleEdit',['id'=>$v->id])}}"
                                               class="layui-btn  layui-btn-small">编辑</a>
                                            <a href="javascript:RoleDel('{{$v->id}}')"
                                               class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                            <a href="javascript:giveQx('{{$v->id}}')"
                                               class="layui-btn layui-btn-warm layui-btn-small dc">权限</a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
        <!-- 角色分配 -->


        <script src="{{asset('static/admin/js/content.min.js?v=1.0.0')}}"></script>
        <script src="{{asset('static/admin/js/plugins/validate/jquery.validate.min.js')}}"></script>
        <script src="{{asset('static/admin/js/plugins/validate/messages_zh.min.js')}}"></script>
        <script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
        <script src="{{asset('static/admin/css/layui/layui.js')}}"></script>
        <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('static/admin/js/plugins/zTree/zTreeStyle.css')}}" type="text/css">
        <script type="text/javascript"
                src="{{asset('static/admin/js/plugins/zTree/jquery.ztree.core-3.5.js')}}"></script>
        <script type="text/javascript"
                src="{{asset('static/admin/js/plugins/zTree/jquery.ztree.excheck-3.5.js')}}"></script>
        <script type="text/javascript"
                src="{{asset('static/admin/js/plugins/zTree/jquery.ztree.exedit-3.5.js')}}"></script>

        <script>
            layui.use('element', function () {
                var $ = layui.jquery,
                    element = layui.element();
                var layid = location.hash.replace(/^#test=/, '');
                element.tabChange('test', layid);

                element.on('tab(test)', function (elem) {
                    location.hash = 'test=' + $(this).attr('lay-id');

                });

            });

            layui.use('form', function () {
                var $ = layui.jquery,
                    form = layui.form();

                //全选
                form.on('checkbox(allChoose)', function (data) {
                    var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
                    child.each(function (index, item) {
                        item.checked = data.elem.checked;
                    });
                    form.render('checkbox');
                });

            });

            //delete slide
            function RoleDel(id) {

                layer.confirm('确认删除?', {icon: 3, title: '提示'}, function (index) {

                    $.ajax({
                        url: "{{ route('RoleDelete') }}",
                        type: "post",
                        data: {'id': id},
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (res) {
                            if (res.code == 1) {
                                location.reload();
                            } else {
                                layer.alert('删除失败');
                            }
                        },
                        error: function (msg) {
                            var json = JSON.parse(msg.responseText);
                            console.log(json);
                        },
                    })
                    layer.close(index);
                })

            }

            var index = '';

            var index2 = '';

            //分配权限
            function giveQx(id) {

                $("#nodeid").val(id);

                //加载层

                index2 = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2

                //获取权限信息

                $.getJSON('{{ route('giveAccess') }}', {'type': 'get', 'id': id}, function (res) {

                    layer.close(index2);

                    if (res.code == 1) {

                        zNodes = JSON.parse(res.data); //将字符串转换成obj

                        //页面层

                        index = layer.open({

                            type: 1,

                            area: ['350px', '600px'],

                            title: '权限分配',

                            skin: 'layui-layer-demo', //加上边框

                            content: $('#role'),

                        });

                        //设置位置

                        layer.style(index, {

                            top: '150px'

                        });

                        //设置zetree

                        var setting = {

                            check: {

                                enable: true

                            },

                            data: {

                                simpleData: {

                                    enable: true

                                }

                            }

                        };

                        $.fn.zTree.init($("#treeType"), setting, zNodes);

                        var zTree = $.fn.zTree.getZTreeObj("treeType");

                        zTree.expandAll(true);

                    } else {

                        layer.alert(res.msg);

                    }

                });

            }

            //确认分配权限

            $("#postform").click(function () {

                var zTree = $.fn.zTree.getZTreeObj("treeType");

                var nodes = zTree.getCheckedNodes(true);

                var NodeString = '';

                $.each(nodes, function (n, value) {

                    if (n > 0) {

                        NodeString += ',';

                    }

                    NodeString += value.id;

                });

                var id = $("#nodeid").val();

                //写入库

                // $.post('{{ route('giveAccess') }}', { 'type': 'give', 'id': id, 'rule': NodeString }, function(res) {
                //
                // 	layer.close(index);
                //
                // 	if(res.code == 1) {
                //
                // 		layer.alert(res.msg, function() {
                //
                // 			 location.reload() ;
                //
                // 		});
                //
                // 	} else {
                //
                // 		layer.alert(res.msg);
                //
                // 	}
                //
                // }, 'json')

                $.ajax({
                    type: "POST",
                    url: '{{ route('giveAccess') }}',
                    data: {'type': 'give', 'id': id, 'rule': NodeString},// 你的formid
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
                    success: function (res) {
                        //关闭加载层
                        layer.close(index);

                        if (res.code == 1) {

                            layer.alert(res.msg, function () {

                                location.reload();

                            });

                        } else {

                            layer.alert(res.msg);

                        }
                    }
                });

            })


        </script>

        @endsection


        <div class="zTreeDemoBackground left" style="display: none" id="role">
            <input type="hidden" id="nodeid">
            <div class="form-group">
                <div class="col-sm-5 col-sm-offset-2">
                    <ul id="treeType" class="ztree"></ul>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-4" style="margin-bottom: 15px">
                    <input type="button" value="确认分配" class="btn btn-primary" id="postform"/>
                </div>
            </div>
        </div>
        <script type="text/javascript">

            zNodes = '';

        </script>
