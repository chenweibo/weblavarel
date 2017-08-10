
function readyUp(event){

    var file =   $(event.target).prev();
     file.click();
     file.change(function () {
        $(event.target).next().val($(this).val());
    });
}
function uploads(event) {

      var file =$(event.target).parent().find("input[type='file']");
      var txt =$(event.target).parent().find("input[type='text']");


    if (file.val() == 0 || txt.val() == 0) {

        txt.focus();
        swal("请选择文件!", "", "error");
        return false;
    }
    else {
        //var formElement = document.getElementById("lefile");
        var formData = new FormData();
        //formData.append("image", formElement.files[0]);
        formData.append(file.attr('name'), file[0].files[0]);


        $.ajax({
            url: '/uploads',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
            },
            success: function (data) {
                layer.close(jz);
                txt.val(data);
            },
            error: function () {
                layer.close(jz);
                swal("错误联系管理员!", "", "error");
            }
        });


    }

}

function rewrite() {

    var name = $('#name').val();
    if (name == false) {
        swal("名称为空无法生成", "", "error");
        return false;
    }
    else {
        $.ajax({
            type: 'POST',
            url: '/admin/common/rewrite',
            data: {"name": name},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
            },
            success: function (data) {
                var info = data.res;
                layer.close(jz);
                $('#jt').attr('value', info);

            },
            error: function () {
                alert("出错,联系管理员")
            }
        });
        return true;
    }
}


function imgicon(str) {


    layer.open({
        type: 1,
        skin: 'layui-layer-demo', //样式类名
        title: '缩略图',
        anim: 2,
        area: ['500px'],
        shadeClose: true, //开启遮罩关闭
        content: '<img  src="' + str + '" style="width:100%" alt="">'
    });
}

function stateAjax(id, num, url, type) {

    $.ajax({
        type: 'POST',
        url: url,
        data: {"id": id, 'num': num, 'type': type},
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        },
        success: function (data) {
            layer.close(jz);

        },
        error: function () {
            alert("出错,联系管理员")
        }
    });

}

function sortAjax(event, url, type) {
    //  var id=$(event.target).data('id');
    var td = $(event.target);
    var txt = td.text();
    var id = $(event.target).data('id');
    var input = $("<input  class='ssort'   type='text' value='" + txt + "'/>");
    td.html(input);
    input.click(function () {
        return false;
    });
    input.trigger("focus");
    input.blur(function () {
        var newtxt = $(this).val();
        if (newtxt == txt) {
            td.html(newtxt);
        } else {
            //var id = td.data('id');
            $.ajax({
                type: 'POST',
                url: url,
                data: {"id": id, "sort": newtxt, 'type': type},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
                },
                success: function (data) {
                    layer.close(jz);
                    td.html(newtxt);
                },
                error: function () {
                    alert("出错,联系管理员")
                }
            });
        }
    });
    //console.log(event.target.attributes['data-id'].value);
}


function editor(str) {

    var E = window.wangEditor
    var editor = new E('#editor')
    editor.customConfig.uploadImgServer = '/EditUploads'
    editor.customConfig.uploadFileName = 'images[]'
    editor.customConfig.uploadImgHeaders = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    editor.customConfig.onchange = function (html) {
        $('#info').attr('value', html)
    }
    editor.create()
    editor.txt.html(str)

}

function removeValue(str){

    $( '#moreimg' ).attr('value',$( '#moreimg' ).attr('value').replace(str, ''));

}

function removeimg(event){
       var img= $(event.target).parent().data('img');
       removeValue('<img src="'+img+'">');
       $(event.target).parent().remove();
       console.log($( '#moreimg' ).val());
       $.ajax({
           type: 'POST',
           url: '/delImg',
           data: {"img": img},
           dataType: 'json',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           beforeSend: function () {
               jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
           },
           success: function (data) {
               layer.close(jz);
           },
           error: function () {
             layer.close(jz);
               alert("出错,联系管理员")
           }
       });

}

function contentIndexForm(){


  var arr=[];
  layui.use('form', function () {
      var $ = layui.jquery,
          form = layui.form();

      form.on('checkbox(allChoose)', function (data) {

          var child = $(data.elem).parents('table').find('tbody td input[name="ck"]');
          child.each(function (index, item) {
              item.checked = data.elem.checked;
          });
          if(data.elem.checked == false){
            arr=[];
          }else {
            child.each(function(){
             arr.push($(this).data('id'));
        });
          }
          form.render('checkbox');
          console.log(arr);
      });

      form.on('checkbox(son)', function (data) {
              if(data.elem.checked == false){
                arr.splice($.inArray($(data.elem).data('id'),arr),1);
              }
              else {
                arr.push($(data.elem).data('id'));
              }
               console.log(arr);

        });
      form.on('switch(show)', function (data) {
          var id = this.attributes['data-tid'].nodeValue;
          var state = this.checked ? '1' : '0';
          var url = "{{route('ajaxState')}}";
          var type = "column";
          alert(id);
      });

      form.on('switch(recommend)', function (data) {
          var id = this.attributes['data-tid'].nodeValue;
          var state = this.checked ? '1' : '0';
          var url = "{{route('ajaxState')}}";
          var type = "column";
          alert(id);
      });
  });


}

function Del(id,url){

  layer.confirm('确认删除?', {icon: 3, title: '提示'}, function (index) {
      $.ajax({
          url: url,
          type: "post",
          data: {'id': id},
          dataType: "json",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (res) {
              if (res.code == 1) {
                  window.location.href = res.data;

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

function removePro(url){

  $.ajax({
      type: "POST",
      url: "/getcate",
      data: $('#movefile').serialize(),// 你的formid
      async: false,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function () {
          jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
      },
      error: function (request) {
          layer.close(jz);
          swal("网络错误!", "", "error");
      },
      success: function (data) {
          //关闭加载层
          layer.close(jz);
         if(data.code==1){
           location.reload();
         }
      }
  });

}


function movefile(arr){
  var html;
 if(arr.length==0){
   layer.msg('没有选择产品哦', {icon: 5});
 }
 else {
  $.ajax({
      url: '/getcate',
      type: "get",
      dataType: "json",
      async: false,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        var demo ='<form id="movefile" style="margin-top:8px" class="navbar-form navbar-left zz" role="search"><div class="form-group"><select class="form-control" name="path" required>';
          $.each(data.res, function(i, item) {
             demo+='<option value="'+item.path+'-'+item.id+'">'+item.html+''+item.name+'</option>'
  					})
           demo +='</select></div><input type="hidden" name="type" value="move"><input type="hidden" name="id" value="'+arr+'"><button type="button" onclick="removePro()" style="margin-left:5px;"  class="btn btn-default">移动</button></form>';
             html=demo;
      },
  })
layer.open({
      type: 1,
      skin: 'layui-layer-filemove', //样式类名
      offset: '200px',
      title: '产品移动',
      anim: 1,
      content: html
  });
 }
}

function copyfile(arr){
  var html;
 if(arr.length==0){
   layer.msg('没有选择产品哦', {icon: 5});
 }
 else {
  $.ajax({
      url: '/getcate',
      type: "get",
      dataType: "json",
      async: false,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        var demo ='<form id="movefile" style="margin-top:8px" class="navbar-form navbar-left zz" role="search"><div class="form-group"><select class="form-control" name="path" required>';
          $.each(data.res, function(i, item) {
             demo+='<option value="'+item.path+'-'+item.id+'">'+item.html+''+item.name+'</option>'
  					})
           demo +='</select></div><input type="hidden" name="type" value="copy"><input type="hidden" name="id" value="'+arr+'"><button type="button" onclick="removePro()" style="margin-left:5px;"  class="btn btn-default">复制</button></form>';
             html=demo;
      },
  })
layer.open({
      type: 1,
      skin: 'layui-layer-filemove', //样式类名
      offset: '200px',
      title: '产品复制',
      anim: 1,
      content: html
  });
 }
}
