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
