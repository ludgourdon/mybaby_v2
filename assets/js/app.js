/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('bootstrap/dist/js/bootstrap.bundle');

// loads the jquery package from node_modules
var $ = require('jquery');
require('bootstrap');
require('../css/main.scss');
require('../js/jquery.fancybox.min.js')
require('../js/dropzone.min.js')

$(document).ready(function() {
    $(".fancybox").fancybox({
        smallBtn : true,
        toolbar : true,
        keyboard : true,
        arrows : true,
        buttons : [
            'zoom',
            'close',
            'thumbs'
        ]
    });

    $('#sidebar').affix({
        offset: {
            top: 20
        }
    });

    /* activate scrollspy menu */
    var $body   = $(document.body);
    var navHeight = $('.navbar').outerHeight(true) + 10;

    $body.scrollspy({
        target: '#rightCol',
        offset: navHeight
    });

    /* smooth scrolling sections */
    $('a[href*=\\#]:not([href=\\#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });
});
