@extends('layouts.admin') @section('content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>消息管理</h5>

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
                @if(!empty(session('tongbu')))
                    <div class="alert alert-success">
                        {{session('tongbu')}}
                    </div>
                @endif
                <div class="alert alert alert-info">
             发送消息，且有48小时时间限制。即用户主动发消息给公众号后48小时内，可以随时给用户发客服消息。超过时间后无法发送
                </div>

                <div class="layui-form">
                    <div class="table-min">
                        <table class="layui-table">
                            <colgroup>
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>微信名称</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

                              @foreach ($list as $v)
                                  <tr data-id="">
                                      <td>{{$v->name}}</td>
                                      <td>{{ date('Y-m-d H:i:s',$v->time)}}</td>
                                      <td>
                                          <a href="{{route('MessageRead',$v->id)}}"
                                             class="layui-btn  layui-btn-small">查看</a>
                                          <a href="javascript:Del({{$v->id}},'{{ route('MessageDelete') }}')"
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
            </script>



@endsection
