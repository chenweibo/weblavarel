//单文件上传
var up = $("#photoCover");
var upfile = $("#lefile");
$('input[id=lefile]').change(function () {
    $('#photoCover').val($(this).val());
});
function uploads() {

    if (up.val() == 0 || upfile.val() == 0) {

        up.focus();
        swal("请选择文件!", "", "error");
        return false;
    }
    else {
        var formElement = document.getElementById("lefile");
        var formData = new FormData();
        formData.append("image", formElement.files[0]);


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
                $('#photoCover').val(data);
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
        return ture;
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
       removeValue('<img src="/static/uploads/'+img+'">');
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
