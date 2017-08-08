@extends('layouts.admin') @section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>会员列表管理</h5>
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

                <a class="layui-btn w" href="{{route('MemberCreate')}}">添加会员</a>
                <div class="layui-form">
                    <div class="table-min">
                        <table class="layui-table">
                            <colgroup>
                                <col>
                                <col>
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>用户名称</th>
                                <th>用户帐号</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                             @foreach ($list as $v)
                                <tr >
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->email }}</td>
                                    <td>
                                        <input type="checkbox" data-tid="{{ $v->id }}"
                                               @if ($v->status == 1)    checked="" @endif  lay-skin="switch"
                                               lay-filter="switchTest" lay-text="ON|OFF">
                                    </td>
                                    <td>
                                      <a href="{{route('MemberEdit',['id'=>$v->id])}}"
                                         class="layui-btn  layui-btn-small">编辑</a>
                                      <a href="javascript:Del({{$v->id}},'{{route("MemberDelete")}}')"
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
                    var type = "member";
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




            </script>

@endsection
