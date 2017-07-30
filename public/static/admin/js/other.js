
//单文件上传
var up=$("#photoCover");
var upfile=$("#lefile");
$('input[id=lefile]').change(function() {
    $('#photoCover').val($(this).val());
});
function uploads(){

  if(up.val()==0 ||upfile.val()==0){

      up.focus();
       swal("请选择文件!", "", "error");
      return false;
  }
  else{
      var formElement = document.getElementById("lefile");
      var formData = new FormData();
      formData.append("image",formElement.files[0]);


      $.ajax({
          url: '/uploads' ,
          type: 'POST',
          data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
          headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
          beforeSend:function(){
              jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
          },
          success: function (data) {
              layer.close(jz);
              $('#photoCover').val(data);
          },
          error: function () {
            layer.close(jz);
               swal("错误联系管理员!", "", "error");
          }
      });


  }

}

function rewrite(){

  var name= $('#name').val();
  if(name==false)
  {
      swal("名称为空无法生成", "", "error");
      return false;
  }
  else {
      $.ajax({
          type:'POST',
          url:'/admin/common/rewrite' ,
          data: { "name" :name } ,
          dataType:'json',
          headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
           beforeSend:function(){
               jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
           },
          success:function(data){
              var info=data.res;
               layer.close(jz);
              $('#jt').attr('value',info);

          },
          error: function () { alert("出错,联系管理员") }
      });
      return ture;
  }
}
