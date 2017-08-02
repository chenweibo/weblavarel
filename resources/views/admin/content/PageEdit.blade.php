@extends('layouts.admin')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>单篇编辑</h5>
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
        <form class="form-horizontal m-t" id="commentForm" method="post" onsubmit="return toVaild()">
          <div class="form-group">
              <label class="col-sm-1 control-label">名称：</label>
              <div class="input-group col-sm-4">
                  <input id="name" type="text" class="form-control" value="{{ $data->name }}"  disabled name="name" required  aria-required="true">
              </div>
          </div>
      <div class="form-group">
              <label class="col-sm-1 control-label">主要内容：</label>
              <div class="input-group col-sm-8"  >
                <div id="editor"   >

                </div>
               </div>
          </div>



          <div class="form-group">
              <label class="col-sm-1 control-label">关键字：</label>
              <div class="input-group col-sm-4">
                  <input id="keywords" type="text" value="{{ $data->keywords }}" class="form-control" name="keywords"  aria-required="true">
              </div>
          </div>

          <div class="form-group">
              <label class="col-sm-1 control-label">关键字描述：</label>
              <div class="input-group col-sm-4">
                  <input id="description" type="text" value="{{ $data->description }}" class="form-control" name="description"  aria-required="true">
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
<script src="{{asset('static/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('static/admin/css/layui/layui.js')}}"></script>
<script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>
<script src="{{asset('static/admin/js/other.js')}}"></script>
<script src="{{asset('static/admin/wangEditor.min.js')}}"></script>
<script type="text/javascript">
$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",});
function toVaild(){
    var jz;
    var url = "{{ route('ColumnCreate')}}";
    $.ajax({
        type:"POST",
        url:url,
        data: $('#commentForm').serialize(),// 你的formid
        async: false,
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        beforeSend:function(){
            jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        },
        error: function(request) {
            layer.close(jz);
             swal("网络错误!", "", "error");
        },
        success: function(data) {
            //关闭加载层
            layer.close(jz);
            if(data.code == 1){
              window.location.href = data.data;
            }else{
                swal(data.msg, "", "error");
            }
        }
    });

    return false;
}

layui.use(['form', 'layedit', 'laydate'], function(){
    var form = layui.form()
        ,layer = layui.layer


    //监听指定开关
    form.on('switch(switchTest)', function(data){
         $('.cate_recommend').attr('value',this.checked ? '1' : '0')

    });

    form.on('switch(switchTestshow)', function(data){
        $('.show').attr('value',this.checked ? '1' : '0')

    });

});



</script>

<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#editor')
    editor.customConfig.uploadImgServer = '/Editupload'
    editor.customConfig.uploadFileName = 'images'
    editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
    // 或者 var editor = new E( document.getElementById('#editor') )
    editor.create()

</script>

@endsection
