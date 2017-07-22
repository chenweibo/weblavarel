@extends('layouts.admin') @section('content')

<div class="wrapper wrapper-content animated fadeInRight">

	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>用户列表管理</h5>
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
    <a class="layui-btn w" href="{{route('UserCreate')}}">添加管理员</a>
			<div class="layui-form">
				<div class="table-min" >
				<table class="layui-table">
					<colgroup>
						<col >
						<col >
						<col >
						<col >
						<col>
					</colgroup>
					<thead>
						<tr>
							<th>管理员名称</th>
							<th>管理员角色</th>
							<th>登录次数</th>
							<th>上次登录ip</th>
							<th>上次登录时间</th>
							<th>真是姓名</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($str as $v)
						<tr data-id="{{$v->id}}">
							<td>{{ $v->username }}</td>
							<td>{{ $v->rolename }}</td>
							<td>{{ $v->loginnum }}</td>
							<td>{{ $v->last_login_ip }}</td>
							<td>{{  date("Y-m-d h:i",$v->last_login_time) }}</td>
							<td>{{ $v->real_name }}</td>
							<td>{{ $v->status ? '正常' : '禁用' }}</td>
							<td>
								<div class="btn-group">
									<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 操作 <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li>
											<a href="{{route('UserCreate',['id'=>$v->id])}}">编辑</a>
										</li>
										<li>
											<a href="javascript:UserDel('{{$v->id}}')">删除</a>
										</li>
									</ul>
								</div>
							</td>
						</tr>
					 @endforeach

					</tbody>
				</table>
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
	layui.use('element', function() {
		var $ = layui.jquery,
			element = layui.element();
		var layid = location.hash.replace(/^#test=/, '');
		element.tabChange('test', layid);

		element.on('tab(test)', function(elem) {
			location.hash = 'test=' + $(this).attr('lay-id');

		});

	});

	layui.use('form', function() {
		var $ = layui.jquery,
			form = layui.form();

		//全选
		form.on('checkbox(allChoose)', function(data) {
			var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
			child.each(function(index, item) {
				item.checked = data.elem.checked;
			});
			form.render('checkbox');
		});

	});

//delete slide
function UserDel(id) {

  layer.confirm('确认删除?', { icon: 3, title: '提示' }, function(index) {

    $.ajax({
      url: "{{ route('UserDelete') }}",
      type: "post", //请求类型
      data: { 'id': id}, //请求的数据
      dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(res) {
        if(res.code == 1) {

           location.reload() ;
        } else {
          layer.alert('删除失败');
        }
      },
      error: function(msg) {
        var json = JSON.parse(msg.responseText);
        console.log(json);
      },
    })
    layer.close(index);
  })

}


</script>

@endsection