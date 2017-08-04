@extends('layouts.admin') @section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>幻灯片管理</h5>
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
                <div class="layui-tab" lay-filter="test">
                    <ul class="layui-tab-title">
                        <li class="layui-this" lay-id="1">幻灯片组1</li>
                        <li lay-id="2">幻灯片组2</li>
                        <li lay-id="3">幻灯片组3</li>
                        <li lay-id="4">幻灯片组4</li>
                        <li lay-id="5">幻灯片组5</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">

                            <a class="layui-btn w" href="{{route('SlideCreate',['slide_type'=>1])}}">添加幻灯片</a>
                            <div class="layui-form">
                                <div class="table-min">


                                    <table class="layui-table">
                                        <colgroup>
                                            <col width="2%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th><input name="" lay-skin="primary" lay-filter="allChoose"
                                                       type="checkbox"></th>
                                            <th>id</th>
                                            <th>名称</th>
                                            <th>排序</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($str as $v)
                                            @if ($v->slide_type==1)
                                                <tr data-id="{{$v->id}}">
                                                    <td><input name="" lay-skin="primary" type="checkbox"></td>
                                                    <td>{{ $v->id }}</td>
                                                    <td>{{ $v->slide_name }}</td>
                                                    <td>{{ $v->slide_sort }}</td>
                                                    <td>

                                                        <a href="{{route('SlideEdit',['id'=>$v->id])}}"
                                                           class="layui-btn  layui-btn-small">编辑</a>
                                                        <a href="javascript:slideDel('{{$v->id}}')"
                                                           class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                                        {{-- <div class="btn-group">
                                                            <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 操作 <span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="{{route('SlideEdit',['id'=>$v->id])}}">编辑</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:slideDel('{{$v->id}}')">删除</a>
                                                                </li>
                                                            </ul>
                                                        </div> --}}

                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <a class="layui-btn w" href="{{route('SlideCreate',['slide_type'=>2])}}">添加幻灯片</a>
                            <div class="layui-form">
                                <div class="table-min">
                                    <table class="layui-table">
                                        <colgroup>
                                            <col width="2%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th><input name="" lay-skin="primary" lay-filter="allChoose"
                                                       type="checkbox"></th>
                                            <th>id</th>
                                            <th>名称</th>
                                            <th>排序</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($str as $v)
                                            @if ($v->slide_type==2)
                                                <tr data-id="{{$v->id}}">
                                                    <td><input name="" lay-skin="primary" type="checkbox"></td>
                                                    <td>{{ $v->id }}</td>
                                                    <td>{{ $v->slide_name }}</td>
                                                    <td>{{ $v->slide_sort }}</td>
                                                    <td>
                                                        <a href="{{route('SlideEdit',['id'=>$v->id])}}"
                                                           class="layui-btn  layui-btn-small">编辑</a>
                                                        <a href="javascript:slideDel('{{$v->id}}')"
                                                           class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <a class="layui-btn w" href="{{route('SlideCreate',['slide_type'=>3])}}">添加幻灯片</a>
                            <div class="layui-form">
                                <div class="table-min">
                                    <table class="layui-table">
                                        <colgroup>
                                            <col width="2%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th><input name="" lay-skin="primary" lay-filter="allChoose"
                                                       type="checkbox"></th>
                                            <th>id</th>
                                            <th>名称</th>
                                            <th>排序</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($str as $v)
                                            @if ($v->slide_type==3)
                                                <tr data-id="{{$v->id}}">
                                                    <td><input name="" lay-skin="primary" type="checkbox"></td>
                                                    <td>{{ $v->id }}</td>
                                                    <td>{{ $v->slide_name }}</td>
                                                    <td>{{ $v->slide_sort }}</td>
                                                    <td>
                                                        <a href="{{route('SlideEdit',['id'=>$v->id])}}"
                                                           class="layui-btn  layui-btn-small">编辑</a>
                                                        <a href="javascript:slideDel('{{$v->id}}')"
                                                           class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <a class="layui-btn w" href="{{route('SlideCreate',['slide_type'=>4])}}">添加幻灯片</a>
                            <div class="layui-form">
                                <div class="table-min">
                                    <table class="layui-table">
                                        <colgroup>
                                            <col width="2%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th><input name="" lay-skin="primary" lay-filter="allChoose"
                                                       type="checkbox"></th>
                                            <th>id</th>
                                            <th>名称</th>
                                            <th>排序</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($str as $v)
                                            @if ($v->slide_type==4)
                                                <tr data-id="{{$v->id}}">
                                                    <td><input name="" lay-skin="primary" type="checkbox"></td>
                                                    <td>{{ $v->id }}</td>
                                                    <td>{{ $v->slide_name }}</td>
                                                    <td>{{ $v->slide_sort }}</td>
                                                    <td>
                                                        <a href="{{route('SlideEdit',['id'=>$v->id])}}"
                                                           class="layui-btn  layui-btn-small">编辑</a>
                                                        <a href="javascript:slideDel('{{$v->id}}')"
                                                           class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <a class="layui-btn w" href="{{route('SlideCreate',['slide_type'=>5])}}">添加幻灯片</a>
                            <div class="layui-form">
                                <div class="table-min">
                                    <table class="layui-table">
                                        <colgroup>
                                            <col width="2%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th><input name="" lay-skin="primary" lay-filter="allChoose"
                                                       type="checkbox"></th>
                                            <th>id</th>
                                            <th>名称</th>
                                            <th>排序</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($str as $v)
                                            @if ($v->slide_type==5)
                                                <tr data-id="{{$v->id}}">
                                                    <td><input name="" lay-skin="primary" type="checkbox"></td>
                                                    <td>{{ $v->id }}</td>
                                                    <td>{{ $v->slide_name }}</td>
                                                    <td>{{ $v->slide_sort }}</td>
                                                    <td>
                                                        <a href="{{route('SlideEdit',['id'=>$v->id])}}"
                                                           class="layui-btn  layui-btn-small">编辑</a>
                                                        <a href="javascript:slideDel('{{$v->id}}')"
                                                           class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="{{asset('static/admin/js/content.min.js?v=1.0.0')}}"></script>
    <script src="{{asset('static/admin/js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/validate/messages_zh.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('static/admin/css/layui/layui.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>

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
        function slideDel(id) {

            layer.confirm('确认删除?', {icon: 3, title: '提示'}, function (index) {

                $.ajax({
                    url: "{{ route('SlideDelete') }}",
                    type: "post", //请求类型
                    data: {'id': id}, //请求的数据
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
                        layer.alert('权限不足联系管理员');
                    },
                })
                layer.close(index);
            })

        }


    </script>

@endsection
