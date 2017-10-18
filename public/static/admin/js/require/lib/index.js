require(['jquery','layer','file','codemirror/codemirror','mode/htmlmixed/htmlmixed'],function ($,layer,file,CodeMirror) {
      var npath
      file.fileAjax('/');
      $(".neir").on("click",".column-name .cursor",function(){
          file.fileAjax($(this).data('name'));
      });
      $(".neir").on("click","#FileDelete",function(){
        var type = $(this).data('type');
        var name = $(this).parent().parent().parent().find('.text').html();
        var newpath = $(this).parent().parent().parent().attr('path');

            layer.confirm('确认删除?', {icon: 3, title: '提示'}, function (index) {
                $.ajax({
                    url: '/DelFile',
                    type: "post",
                    data: {'type': type,'name': name,'path': newpath},
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.code == 1) {
                            file.fileAjax(newpath);
                        } else {
                            layer.alert('删除失败');
                        }
                    },
                    error: function (msg) {
                        layer.alert('可能文件已经被打开无法删除');
                    },
                })
                layer.close(index);
            })
      });

      $(".neir").on("click","#editFile",function(){
        var name = $(this).parent().parent().parent().find('.text').html();
        var newpath = $(this).parent().parent().parent().attr('path');
        var  fileinfo;

        $.ajax({
            url: '/GetFileContent',
            type: "post",
            data: {'file': newpath+'/'+name},
            dataType: "json",
            async : false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
            },
            success: function (res) {
                layer.close(jz);
               fileinfo = res.data;
            },
            error: function (msg) {
               layer.close(jz);
            },
        })
        layer.open({
              type: 1,
              skin: 'layui-layer-filemove',
              offset: '10px',
               area: ['98%', '98%'],
              title: '编辑:'+name,
              anim: 1,
              content: '<html>\
              <form class="form-editfile" style="height:95%" >\
              <textarea id="textarea" >'+fileinfo+'</textarea>\
              <div class="layui-input-block">\
                <div class="clear"></div>\
                <div class="bt-form-submit-btn" style=""><button type="button" class="btn btn-danger btn-sm btn-editor-close">关闭</button><button   type="button" style="margin-left: 5px;" class="btn btn-success btn-sm zz">保存</button></div>\
              </div>\
              </form>\
      </html>',
       success: function(layero, index){
         var qt=CodeMirror.fromTextArea(document.getElementById("textarea"), {
             lineNumbers: true,
             mode: 'text/html',
             autoMatchParens: true
         });

         $('.zz').click(function(event) {
           $.ajax({
               url: '/EditFile',
               type: "post",
               data: {'file': newpath+'/'+name,'content':qt.getValue()},
               dataType: "json",
               async : false,
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (res) {
                 if (res.code==1) {
                  layer.msg('保存成功');
                 }
                 else {
                  layer.msg('保存失败');
                 }
               },
               error: function (msg) {

               },
           })
         });
         $('.btn-editor-close').click(function(event) {
             layer.close(index)
         });
        }
          }
        );

      });
       $("#uploadfile").click(function() {
            layer.msg(11);
       });
      $(".neir").on("click","#Zip",function(){

        var name = $(this).parent().parent().parent().find('.text').html();
        var newpath = $(this).parent().parent().parent().attr('path');

            layer.confirm('确认压缩到当前目录?', {icon: 3, title: '提示'}, function (index) {
                $.ajax({
                    url: '/ZipFile',
                    type: "post",
                    data: {'name': name,'path': newpath},
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.code == 1) {
                            file.fileAjax(newpath);
                        } else {
                            layer.alert('失败');
                        }
                    },
                    error: function (msg) {
                        layer.alert('权限不足联系管理员');
                    },
                })
                layer.close(index);
            })
      });

      $(".neir").on("click","#renameFile",function(){
         var name = $(this).parent().parent().parent().find('.text').html();
         var newpath = $(this).parent().parent().parent().attr('path');
        layer.prompt({title: '重复名',offset: '200px',  formType: 3,value: name}, function(pass, index){
          if (pass==name) {
            layer.msg('空操作');
          }
          else {
            $.ajax({
                url: '/RenameFile',
                type: 'POST',
                data: {'path':newpath,'name':pass ,'oldname':name},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
                },
                success: function (data) {
                  layer.close(jz);
                  if (data.code==1) {
                       file.fileAjax(newpath);
                  }
                  else {
                       layer.msg('未知错误，修改失败!');
                  }

                },
                error: function () {
                    layer.close(jz);
                    layer.msg('错误联系管理员!');

                }
            });
          }

        layer.close(index);
        });
});
    });
