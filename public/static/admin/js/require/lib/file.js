define(['jquery','layer'],function ($,layer) {
  Date.prototype.Format = function (fmt) { //author: meizz
  var o = {
    "M+": this.getMonth() + 1, //月份
    "d+": this.getDate(), //日
    "h+": this.getHours(), //小时
    "m+": this.getMinutes(), //分
    "s+": this.getSeconds(), //秒
    "q+": Math.floor((this.getMonth() + 3) / 3), //季度
    "S": this.getMilliseconds() //毫秒
  };
  if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
  for (var k in o)
  if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
  return fmt;
  }
  var showHmtl = function(data){
  $('.neir').empty();
  if(data.path!=data.root)
  {
   $(".fileback").removeClass('filebackhidden');

   $(".ibox-content").off('click').on("click",".fileback",function(){
        strpath=data.path.split('/');
        backpath = data.path.replace('/'+strpath[strpath.length-1],'');
        fileAjax(backpath);
   });

  }
  $.each(data.dir, function(i,item){
  str=item.split(';');
  $('.neir').append("<tr path='"+data.path+"'>\
  <td><input data-id='' name='ck' lay-skin='primary' lay-filter='son' type='checkbox'></td>\
  <td class='column-name'><span class='cursor' data-name='"+data.path+"/"+str[0] +"' ><span class='ico ico-folder'></span><a class='text' >"+str[0] +"</a></span></td>\
  <td>"+str[1] +"kb</td>\
  <td>"+new Date(parseInt(str[2])*1000).Format("yyyy/MM/dd hh:mm:ss")+"</td>\
  <td class='editmenu'><span>\
  <a  class='btlink' >重命名</a> |\
  <a  class='btlink' >压缩</a> |\
  <a  class='btlink' >删除</a> \
  </span>\
  </td>\
  </tr>");
  }) ;
  $.each(data.file, function(i,item){
  str=item.split(';');
  $('.neir').append("<tr>\
  <td><input data-id='' name='ck' lay-skin='primary' lay-filter='son' type='checkbox'></td>\
  <td class='column-name'><span ><span class='ico ico-file'></span><span class='text' >"+str[0] +"</span></span></td>\
  <td>"+str[1] +"kb</td>\
  <td>"+new Date(parseInt(str[2])*1000).Format("yyyy/MM/dd hh:mm:ss")+"</td>\
  <td class='editmenu'><span>\
  <a  class='btlink' >编辑</a> |\
  <a  class='btlink' >重命名</a> |\
  <a  class='btlink' >压缩</a> |\
  <a  class='btlink' >删除</a> \
  </span>\
  </td>\
  </tr>");

  }) ;
  layui.use('form', function(){
  var form = layui.form();
  form.render();
  });
  };

  function fileAjax(path){
    $.ajax({
        url: '/GetFiles',
        type: 'GET',
        data: {'path':path},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        },
        success: function (data) {
          layer.close(jz);
          //html(data);
          showHmtl(data);
        },
        error: function () {
            layer.close(jz);
            swal("错误联系管理员!", "", "error");
        }
    });
  }


  return {
   showHmtl: showHmtl,
   fileAjax: fileAjax,

};

});
