require(['jquery','layer','file'],function ($,layer,file) {
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

        layer.open({
              type: 1,
              skin: 'layui-layer-filemove',
              offset: '20px',
               area: ['95%', '95%'],
              title: '编辑',
              anim: 1,
              content: '<html>\
      </html>',
       success: function(layero, index){
         layui.use('form', function(){
        var form = layui.form();
        form.render();
      });
        }
          }
        );

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
