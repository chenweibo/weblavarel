@extends('layouts.admin') @section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>栏目列表管理</h5>

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
                <a class="layui-btn w" href="{{route('ColumnCreate')}}">添加栏目</a>
                <div class="layui-form">
                    <div class="table-min">
                        <table class="layui-table">
                            <colgroup>
                                <col width="50">
                                <col width="50">
                                <col>
                                <col>
                                <col width="80">
                                <col width="80">
                                <col width="100">
                                <col width="200">
                            </colgroup>
                            <thead>
                            <tr>
                                <th><input name="" lay-skin="primary" lay-filter="allChoose" type="checkbox"></th>
                                <th>id</th>
                                <th>名称</th>
                                <th>排序</th>
                                <th>类型</th>
                                <th>缩略图</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($list as $key)
                                <tr data-id="">
                                    <td><input name="ck" lay-skin="primary" type="checkbox"></td>
                                    <td>{{$key['id']}}</td>
                                    <td>{{$key['html']}}{{$key['name']}}</td>
                                    <td width="80" data-id="{{$key['id']}}"
                                        onclick="sortAjax(event,'{{route("ajaxSort")}}','column')">{{$key['sort']}}</td>
                                    <td>{{ config('admin.comlumtype.'.$key['type'])}}</td>
                                    <td>@if ($key['img'] == null)
                                            <img title="点击放大" class="iconmig"
                                                 onclick="imgicon('{{ asset('static/admin/images/img.png') }}')"
                                                 src="{{ asset('static/admin/images/img.png') }}" alt="">
                                        @else
                                            <img title="点击放大" class="iconmig"
                                                 onclick="imgicon('{{ asset('static/uploads') }}/{{$key['img']}}')"
                                                 src="{{ asset('static/uploads') }}/{{$key['img']}}" alt="">
                                        @endif</td>
                                    <td>
                                        <input type="checkbox" data-tid="{{$key['id']}}"
                                               @if ($key['state'] == 1)    checked="" @endif  lay-skin="switch"
                                               lay-filter="switchTest" lay-text="ON|OFF">
                                    </td>
                                    <td>
                                        <a href="{{route('ColumnEdit',['id'=>$key['id']])}}"
                                           class="layui-btn  layui-btn-small">编辑</a>
                                        <a href="javascript:ColumnDel({{$key['id']}})"
                                           class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                    </td>
                                </tr>
                            @endforeach
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

                layui.use('form', function () {
                    var $ = layui.jquery,
                        form = layui.form();
                    form.on('switch(switchTest)', function (data) {
                        var id = this.attributes['data-tid'].nodeValue;
                        var state = this.checked ? '1' : '0';
                        var url = "{{route('ajaxState')}}";
                        var type = "column";
                        stateAjax(id, state, url, type);
                    });
                    //全选
                    form.on('checkbox(allChoose)', function (data) {
                        var child = $(data.elem).parents('table').find('tbody td input[name="ck"]');
                        child.each(function (index, item) {
                            item.checked = data.elem.checked;
                        });
                        form.render('checkbox');
                    });
                });


                function ColumnDel(id) {

                    layer.confirm('确认删除?', {icon: 3, title: '提示'}, function (index) {
                        $.ajax({
                            url: "{{ route('ColumnDelete') }}",
                            type: "post",
                            data: {'id': id},
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (res) {
                                if (res.code == 1) {
                                    window.location.href = res.url;
                                    location.reload();
                                } else {
                                    layer.alert('删除失败');
                                }
                            },
                            error: function (msg) {
                                layer.alert('权限不足联系管理员');
                            },
                        })
                        layer.close(index);
                    })

                }
            </script>

@endsection
