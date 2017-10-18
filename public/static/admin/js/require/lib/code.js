require(["codemirror", "mode_javascript"], function(CodeMirror) {

    CodeMirror.fromTextArea(document.getElementById("textarea"), {
        lineNumbers: true,
        mode: "javascript"
    });

});
