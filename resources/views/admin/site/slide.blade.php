@extends('layouts.admin')

@section('content')

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
                          <div class="layui-form">
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
        <th><input name="" lay-skin="primary" lay-filter="allChoose" type="checkbox"></th>
        <th>id</th>
        <th>名称</th>
        <th>排序</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input name="" lay-skin="primary" type="checkbox"></td>
        <td>贤心</td>
        <td>汉族</td>
        <td>1989-10-14</td>
        <td>
          <div class="btn-group">
    <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        操作 <span class="caret"></span>
    </button>
    <ul class="dropdown-menu"><li><a href="/jksm.php/siteset/slideedit/id/2.html">编辑</a></li><li><a href="javascript:slideDel('2')">删除</a></li></ul></div>

  </td>
      </tr>
      <tr>
        <td><input name="" lay-skin="primary" type="checkbox"></td>
        <td>张爱玲</td>
        <td>汉族</td>
        <td>1920-09-30</td>
        <td>  <div class="btn-group">
    <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        操作 <span class="caret"></span>
    </button>
    <ul class="dropdown-menu"><li><a href="/jksm.php/siteset/slideedit/id/2.html">编辑</a></li><li><a href="javascript:slideDel('2')">删除</a></li></ul></div>
</td>
      </tr>
      <tr>
        <td><input name="" lay-skin="primary" type="checkbox"></td>
        <td>Helen Keller</td>
        <td>拉丁美裔</td>
        <td>1880-06-27</td>
        <td>  <div class="btn-group">
    <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        操作 <span class="caret"></span>
    </button>
    <ul class="dropdown-menu"><li><a href="/jksm.php/siteset/slideedit/id/2.html">编辑</a></li><li><a href="javascript:slideDel('2')">删除</a></li></ul></div>
</td>
      </tr>
      <tr>
        <td><input name="" lay-skin="primary" type="checkbox"></td>
        <td>岳飞</td>
        <td>汉族</td>
        <td>1103-北宋崇宁二年</td>
        <td>  <div class="btn-group">
    <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        操作 <span class="caret"></span>
    </button>
    <ul class="dropdown-menu"><li><a href="/jksm.php/siteset/slideedit/id/2.html">编辑</a></li><li><a href="javascript:slideDel('2')">删除</a></li></ul></div>
</td>
      </tr>
      <tr>
        <td><input name="" lay-skin="primary" type="checkbox"></td>
        <td>孟子</td>
        <td>华夏族（汉族）</td>
        <td>公元前-372年</td>
        <td>  <div class="btn-group">
    <button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        操作 <span class="caret"></span>
    </button>
    <ul class="dropdown-menu"><li><a href="/jksm.php/siteset/slideedit/id/2.html">编辑</a></li><li><a href="javascript:slideDel('2')">删除</a></li></ul></div>
</td>
      </tr>
    </tbody>
  </table>
</div>
                        </div>
                        <div class="layui-tab-item">

                        </div>
                        <div class="layui-tab-item">内容3</div>
                        <div class="layui-tab-item">内容4</div>
                        <div class="layui-tab-item">内容5</div>
                      </div>
                    </div>

                          </div>

                      </div>

  </div>


  <script src="{{asset('static/admin/js/content.min.js?v=1.0.0')}}"></script>
  <script src="{{asset('static/admin/js/plugins/validate/jquery.validate.min.js')}}"></script>
  <script src="{{asset('static/admin/js/plugins/validate/messages_zh.min.js')}}"></script>
  <script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>
  <script src="{{asset('static/admin/css/layui/layui.js')}}"></script>
  <script>
  layui.use('element', function(){
    var $ = layui.jquery
    ,element = layui.element();
    //Hash地址的定位
    var layid = location.hash.replace(/^#test=/, '');
    element.tabChange('test', layid);

    element.on('tab(test)', function(elem){
      location.hash = 'test='+ $(this).attr('lay-id');

    });

  });
 function redt(a){

   layui.use('element', function(){
     var $ = layui.jquery
     ,element = layui.element();
     element.tabChange('test', a);
   });
 }
 layui.use('form', function(){
   var $ = layui.jquery, form = layui.form();

   //全选
   form.on('checkbox(allChoose)', function(data){
     var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
     child.each(function(index, item){
       item.checked = data.elem.checked;
     });
     form.render('checkbox');
   });

 });

  </script>


@endsection
