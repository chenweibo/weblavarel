requirejs.config({
    baseUrl: '/static/admin/js/require/lib/',
    paths: {
        jquery: 'jquery.min',
        layer:'layer',
        file:'file',

    },
    shim: {
　　　　'layer': {
　　　　　　deps: ['jquery'],
　　　　　　exports: "layer"
　　　　}
　　}
});
require(['jquery','layer','file'],function ($,layer,file) {
      file.fileAjax('/');
      $(".neir").on("click",".column-name .cursor",function(){

          file.fileAjax($(this).data('name'));
      });
    });
