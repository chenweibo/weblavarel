@extends('layouts.admin') @section('content')

<div class="wrapper wrapper-content animated fadeInRight">

	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>单篇管理</h5>

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
			<div class="layui-form">
				<div class="table-min" >
				<table class="layui-table">
					<colgroup>

						<col>
						<col>
						<col width="200">
					</colgroup>
					<thead>
						<tr>
							<th>名称</th>
							<th>排序</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($str as $v)
							<tr data-id="">
							<td>{{ $v->name }}</td>
							<td>123</th>
							<td>操作</td>
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

	layui.use('form', function() {
		var $ = layui.jquery,
			form = layui.form();
		//全选
		form.on('checkbox(allChoose)', function(data) {
			var child = $(data.elem).parents('table').find('tbody td input[name="ck"]');
			child.each(function(index, item) {
				item.checked = data.elem.checked;
			});
			form.render('checkbox');
		});
	});


function ColumnDel(id) {

	layer.confirm('确认删除?', { icon: 3, title: '提示' }, function(index) {
    $.ajax({
      url: "{{ route('ColumnDelete') }}",
      type: "post",
      data: { 'id': id},
      dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(res) {
        if(res.code == 1) {
					window.location.href=res.url;
           location.reload() ;
        } else {
          layer.alert('删除失败');
        }
      },
      error: function(msg) {
      layer.alert('权限不足联系管理员');
      },
    })
    layer.close(index);
  })

}
</script>

@endsection
