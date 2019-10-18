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