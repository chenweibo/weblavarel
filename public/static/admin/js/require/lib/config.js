requirejs.config({
    baseUrl: '/static/admin/js/require/lib/',
    paths: {
        jquery: 'jquery.min',
        layer:'layer',
        file:'file',

    },
    packages: [{
       name: "codemirror",
       location: "codemirror",
       main: 'codemirror'
   },{
        name: "php",
        location: "mode/php",
        main: 'php'
    }],
    shim: {
　　　　'layer': {
　　　　　　deps: ['jquery'],
　　　　　　exports: "layer"
　　　　}
　　}
});
