@extends('layouts.admin') @section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>下载管理</h5>

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

                <a href="{{route('DownCreate',['pid'=>$id])}}" class="btn btn-primary">添加</a>
                <a href="#" onclick="javascript:Del(arr,'{{route("DownMoreDelete")}}')"
                   class="btn btn-primary">批量删除</a>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">更多操作
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#" onclick="movefile(arr,5)">移动</a>
                        </li>
                        <li><a href="#" onclick="copyfile(arr,5)">复制</a>
                        </li>
                    </ul>
                </div>

                <div class="admin_search row" style=" height:35px; float:right">
                    <form class="navbar-form navbar-left zz" action="{{route('Image')}}" method="get" role="search">
                        <div class="form-group">
                            <select class="form-control" name="path" required>

                                <option value="0">全部分类</option>
                                @foreach ($cate as $v)
                                    <option @if($id ==$v['id'] ) selected="select"
                                            @endif value="{{$v['id']}}">{{$v['html']}}{{$v['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <input id="keys" type="text" value="{{$keys}}" class="form-control" name="keys">
                        </div>
                        <button type="submit" style="margin-bottom:0" class="btn btn-primary">搜索</button>
                    </form>
                </div>

                <div class="clearfix" style="clear:both"></div>
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
                                    <td><input data-id="{{ $v->id }}" name="ck" lay-skin="primary" lay-filter="son"
                                               type="checkbox"></td>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->colums }}</td>
                                    <td data-id="{{ $v->id }}"
                                        onclick="sortAjax(event,'{{route("ajaxSort")}}','content')">{{ $v->sort }}</td>
                                    <td>@if ($v->img == null)
                                            <img title="点击放大" class="iconmig"
                                                 onclick="imgicon('{{ asset('static/admin/images/img.png') }}')"
                                                 src="{{ asset('static/admin/images/img.png') }}" alt="">
                                        @else
                                            <img title="点击放大" class="iconmig"
                                                 onclick="imgicon('{{ asset('static/uploads') }}/{{$v->img}}')"
                                                 src="{{ asset('static/uploads') }}/{{$v->img}}" alt="">
                                        @endif</td>
                                    <td>
                                        <input type="checkbox" data-tid="{{ $v->id }}" @if ($v->show == 1)    checked=""
                                               @endif  lay-skin="switch" lay-filter="show" lay-text="ON|OFF">
                                    </td>
                                    <td>
                                        <input type="checkbox" data-tid="{{ $v->id }}"
                                               @if ($v->recommend == 1)    checked="" @endif  lay-skin="switch"
                                               lay-filter="recommend" lay-text="ON|OFF">
                                    </td>
                                    <td>
                                        <a href="{{route('DownCreate',['id'=>$v->id])}}"
                                           class="layui-btn  layui-btn-small">编辑</a>
                                        <a href="javascript:Del({{$v->id}},'{{route("DownDelete")}}')"
                                           class="layui-btn layui-btn-danger layui-btn-small dc">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                {{ $list->appends(['path'=>$id,'keys'=>$keys])->links() }}
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
                    form.on('switch(show)', function (data) {
                        var id = this.attributes['data-tid'].nodeValue;
                        var state = this.checked ? '1' : '0';
                        var url = "{{route('ajaxState')}}";
                        var type = "content_show";
                        stateAjax(id, state, url, type)
                    });

                    form.on('switch(recommend)', function (data) {
                        var id = this.attributes['data-tid'].nodeValue;
                        var state = this.checked ? '1' : '0';
                        var url = "{{route('ajaxState')}}";
                        var type = "content_recommend";
                        stateAjax(id, state, url, type)
                    });
                });


            </script>

@endsection
