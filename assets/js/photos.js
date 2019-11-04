var $ = require('jquery');
window.Dropzone = require('../js/dropzone.min.js');
Dropzone.autoDiscover = false;
$(function() {
    let _actionToDropZone = $("#form_snippet_image").attr('data-action');
    // var myDropzone = new Dropzone("#form_snippet_image", {url: _actionToDropZone});
    $("div#form_snippet_image").dropzone({url: _actionToDropZone});
    // myDropzone.on("addedfile", function (file) {
    //     alert('nouveau fichier reçu');
    // });
});