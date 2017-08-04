@extends('layouts.admin') @section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>产品管理</h5>

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
                <a href="{{route('ProductCreate')}}" class="btn btn-primary">添加</a>
                <a href="" class="btn btn-primary">批量删除</a>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">更多操作
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="buttons.html#">移动</a>
                        </li>
                        <li><a href="buttons.html#">复制</a>
                        </li>
                        <li><a href="buttons.html#">导出excel</a>
                        </li>

                    </ul>
                </div>

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
                                <col width="100">
                                <col width="200">
                            </colgroup>
                            <thead>
                            <tr>
                                <th><input name="" lay-skin="primary" lay-filter="allChoose" type="checkbox"></th>
                                <th>id</th>
                                <th>名称</th>
                                <th>分类</th>
                                <th>排序</th>
                                <th>缩略图</th>
                                <th>状态</th>
                                <th>推荐</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($list as $v)
                                <tr>
                                    <td><input name="ck" lay-skin="primary" type="checkbox"></td>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->id }}</td>
                                    <td data-id="{{ $v->id }}"
                                        onclick="sortAjax(event,'{{route("ajaxSort")}}','content')">{{ $v->sort }}</td>
                                    <td>@if ($v->img == null)
                                            <img title="点击放大" class="iconmig"
                                                 onclick="imgicon('{{ asset('static/admin/images/img.png') }}')"
                                                 src="{{ asset('static/admin/images/img.png') }}" alt="">
                                        @else
                                            <img title="点击放大" class="iconmig"
                                                 onclick="imgicon('{{ asset('static/uploads') }}/{{$key['img']}}')"
                                                 src="{{ asset('static/uploads') }}/{{$key['img']}}" alt="">
                                        @endif</td>
                                    <td>
                                        <input type="checkbox" data-tid="{{ $v->id }}" @if ($v->show == 1)    checked=""
                                               @endif  lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                                    </td>
                                    <td>
                                        <input type="checkbox" data-tid="{{ $v->id }}"
                                               @if ($v->recommend == 1)    checked="" @endif  lay-skin="switch"
                                               lay-filter="switchrec" lay-text="ON|OFF">
                                    </td>
                                    <td>
                                        <a href="" class="layui-btn  layui-btn-small">编辑</a>
                                        <a href="javascript:ProductDel()"
                                           class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                {{ $list->links() }}
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
                    //全选
                    form.on('checkbox(allChoose)', function (data) {
                        var child = $(data.elem).parents('table').find('tbody td input[name="ck"]');
                        child.each(function (index, item) {
                            item.checked = data.elem.checked;
                        });
                        form.render('checkbox');
                    });

                    form.on('switch(switchTest)', function (data) {
                        var id = this.attributes['data-tid'].nodeValue;
                        var state = this.checked ? '1' : '0';
                        var url = "{{route('ajaxState')}}";
                        var type = "column";
                        alert(state);
                    });

                    form.on('switch(switchrec)', function (data) {
                        var id = this.attributes['data-tid'].nodeValue;
                        var state = this.checked ? '1' : '0';
                        var url = "{{route('ajaxState')}}";
                        var type = "column";
                        alert(state);
                    });
                });


                function ProductDel(id) {

                    layer.confirm('确认删除?', {icon: 3, title: '提示'}, function (index) {
                        $.ajax({
                            url: "",
                            type: "post",
                            data: {'id': id},
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (res) {
                                if (res.code == 1) {
                                    window.location.href = res.url;

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
