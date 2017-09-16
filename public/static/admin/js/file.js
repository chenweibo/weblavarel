

function getfile(){

  var html ='';
    $.ajax({
        url: '/GetFiles',
        type: 'GET',
        data: {'path':'/'},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        },
        success: function (data) {
          layer.close(jz);
          html(data);
        },
        error: function () {
            layer.close(jz);
            swal("错误联系管理员!", "", "error");
        }
    });

}

function html(data)
{


$.each(str.dir, function(i,item){
// $('.neir').append('<tr>\
// <td><input data-id="" name="ck" lay-skin="primary" lay-filter="son" type="checkbox"></td>\
// <td>app.php</td>\
// <td>200k</td>\
// <td>2017-8-9</td>\
// <td class="editmenu"><span><a class="btlink" href="javascript:;"onclick="CopyFile()">复制</a> |\
// <a class="btlink" href="javascript:;"\
// onclick="CutFile()">剪切</a> |\
// <a  class="btlink" href="javascript:ReName(0,);">重命名</a> |\
// <a  class="btlink" href="javascript:SetChmod(0,'');">权限</a> |\
// <a  class="btlink" href="javascript:Zip('');">压缩</a> |\
// <a  class="btlink" href="javascript:;" onclick="DeleteDir()">删除</a>\
// </span>\
// </td>\
// </tr>');
//
}
) ;

}
