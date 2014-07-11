/*!
 * jQuery Cycle Lite Plugin
 * http://malsup.com/jquery/cycle/lite/
 * Copyright (c) 2008-2012 M. Alsup
 * Version: 1.7 (20-FEB-2013)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Requires: jQuery v1.3.2 or later
 */
;(function($) {
"use strict";

var ver = 'Lite-1.7';
var msie = /MSIE/.test(navigator.userAgent);

$.fn.cycle = function(options) {
    return this.each(function() {
        options = options || {};
        
        if (this.cycleTimeout) 
            clearTimeout(this.cycleTimeout);

        this.cycleTimeout = 0;
        this.cyclePause = 0;
        
        var $cont = $(this);
        var $slides = options.slideExpr ? $(options.slideExpr, this) : $cont.children();
        var els = $slides.get();
        if (els.length < 2) {
            if (window.console)
                console.log('terminating; too few slides: ' + els.length);
            return; // don't bother
        }

        // support metadata plugin (v1.0 and v2.0)
        var opts = $.extend({}, $.fn.cycle.defaults, options || {}, $.metadata ? $cont.metadata() : $.meta ? $cont.data() : {});
        var meta = $.isFunction($cont.data) ? $cont.data(opts.metaAttr) : null;
        if (meta)
            opts = $.extend(opts, meta);
            
        opts.before = opts.before ? [opts.before] : [];
        opts.after = opts.after ? [opts.after] : [];
        opts.after.unshift(function(){ opts.busy=0; });
            
        // allow shorthand overrides of width, height and timeout
        var cls = this.className;
        opts.width = parseInt((cls.match(/w:(\d+)/)||[])[1], 10) || opts.width;
        opts.height = parseInt((cls.match(/h:(\d+)/)||[])[1], 10) || opts.height;
        opts.timeout = parseInt((cls.match(/t:(\d+)/)||[])[1], 10) || opts.timeout;

        if ($cont.css('position') == 'static') 
            $cont.css('position', 'relative');
        if (opts.width) 
            $cont.width(opts.width);
        if (opts.height && opts.height != 'auto') 
            $cont.height(opts.height);

        var first = 0;
        $slides.css({position: 'absolute', top:0}).each(function(i) {
            $(this).css('z-index', els.length-i);
        });
        
        $(els[first]).css('opacity',1).show(); // opacity bit needed to handle reinit case
        if (msie) 
            els[first].style.removeAttribute('filter');

        if (opts.fit && opts.width) 
            $slides.width(opts.width);
        if (opts.fit && opts.height && opts.height != 'auto') 
            $slides.height(opts.height);
        if (opts.pause) 
            $cont.hover(function(){this.cyclePause=1;}, function(){this.cyclePause=0;});

        var txFn = $.fn.cycle.transitions[opts.fx];
        if (txFn)
            txFn($cont, $slides, opts);
        
        $slides.each(function() {
            var $el = $(this);
            this.cycleH = (opts.fit && opts.height) ? opts.height : $el.height();
            this.cycleW = (opts.fit && opts.width) ? opts.width : $el.width();
        });

        if (opts.cssFirst)
            $($slides[first]).css(opts.cssFirst);

        if (opts.timeout) {
            // ensure that timeout and speed settings are sane
            if (opts.speed.constructor == String)
                opts.speed = {slow: 600, fast: 200}[opts.speed] || 400;
            if (!opts.sync)
                opts.speed = opts.speed / 2;
            while((opts.timeout - opts.speed) < 250)
                opts.timeout += opts.speed;
        }
        opts.speedIn = opts.speed;
        opts.speedOut = opts.speed;

        opts.slideCount = els.length;
        opts.currSlide = first;
        opts.nextSlide = 1;

        // fire artificial events
        var e0 = $slides[first];
        if (opts.before.length)
            opts.before[0].apply(e0, [e0, e0, opts, true]);
        if (opts.after.length > 1)
            opts.after[1].apply(e0, [e0, e0, opts, true]);
        
        if (opts.click && !opts.next)
            opts.next = opts.click;
        if (opts.next)
            $(opts.next).unbind('click.cycle').bind('click.cycle', function(){return advance(els,opts,opts.rev?-1:1);});
        if (opts.prev)
            $(opts.prev).unbind('click.cycle').bind('click.cycle', function(){return advance(els,opts,opts.rev?1:-1);});

        if (opts.timeout)
            this.cycleTimeout = setTimeout(function() {
                go(els,opts,0,!opts.rev);
            }, opts.timeout + (opts.delay||0));
    });
};

function go(els, opts, manual, fwd) {
    if (opts.busy) 
        return;
    var p = els[0].parentNode, curr = els[opts.currSlide], next = els[opts.nextSlide];
    if (p.cycleTimeout === 0 && !manual) 
        return;

    if (manual || !p.cyclePause) {
        if (opts.before.length)
            $.each(opts.before, function(i,o) { o.apply(next, [curr, next, opts, fwd]); });
        var after = function() {
            if (msie)
                this.style.removeAttribute('filter');
            $.each(opts.after, function(i,o) { o.apply(next, [curr, next, opts, fwd]); });
            queueNext(opts);
        };

        if (opts.nextSlide != opts.currSlide) {
            opts.busy = 1;
            $.fn.cycle.custom(curr, next, opts, after);
        }
        var roll = (opts.nextSlide + 1) == els.length;
        opts.nextSlide = roll ? 0 : opts.nextSlide+1;
        opts.currSlide = roll ? els.length-1 : opts.nextSlide-1;
    } else {
      queueNext(opts);
    }

    function queueNext(opts) {
        if (opts.timeout)
            p.cycleTimeout = setTimeout(function() { go(els,opts,0,!opts.rev); }, opts.timeout);
    }
}

// advance slide forward or back
function advance(els, opts, val) {
    var p = els[0].parentNode, timeout = p.cycleTimeout;
    if (timeout) {
        clearTimeout(timeout);
        p.cycleTimeout = 0;
    }
    opts.nextSlide = opts.currSlide + val;
    if (opts.nextSlide < 0) {
        opts.nextSlide = els.length - 1;
    }
    else if (opts.nextSlide >= els.length) {
        opts.nextSlide = 0;
    }
    go(els, opts, 1, val>=0);
    return false;
}

$.fn.cycle.custom = function(curr, next, opts, cb) {
    var $l = $(curr), $n = $(next);
    $n.css(opts.cssBefore);
    var fn = function() {$n.animate(opts.animIn, opts.speedIn, opts.easeIn, cb);};
    $l.animate(opts.animOut, opts.speedOut, opts.easeOut, function() {
        $l.css(opts.cssAfter);
        if (!opts.sync)
            fn();
    });
    if (opts.sync)
        fn();
};

$.fn.cycle.transitions = {
    fade: function($cont, $slides, opts) {
        $slides.not(':eq(0)').hide();
        opts.cssBefore = { opacity: 0, display: 'block' };
        opts.cssAfter  = { display: 'none' };
        opts.animOut = { opacity: 0 };
        opts.animIn = { opacity: 1 };
    },
    fadeout: function($cont, $slides, opts) {
        opts.before.push(function(curr,next,opts,fwd) {
            $(curr).css('zIndex',opts.slideCount + (fwd === true ? 1 : 0));
            $(next).css('zIndex',opts.slideCount + (fwd === true ? 0 : 1));
        });
        $slides.not(':eq(0)').hide();
        opts.cssBefore = { opacity: 1, display: 'block', zIndex: 1 };
        opts.cssAfter  = { display: 'none', zIndex: 0 };
        opts.animOut = { opacity: 0 };
        opts.animIn = { opacity: 1 };
    }
};

$.fn.cycle.ver = function() { return ver; };

// @see: http://malsup.com/jquery/cycle/lite/
$.fn.cycle.defaults = {
    animIn:        {},
    animOut:       {},
    fx:           'fade',
    after:         null,
    before:        null,
    cssBefore:     {},
    cssAfter:      {},
    delay:         0,
    fit:           0,
    height:       'auto',
    metaAttr:     'cycle',
    next:          null,
    pause:         false,
    prev:          null,
    speed:         1000,
    slideExpr:     null,
    sync:          true,
    timeout:       6000
};

})(jQuery);

$(document).ready(function() {
    //Preload
    $('body').jpreLoader({
      showPercentage: false,
      loaderVPos: '60px',
      autoClose: true,
      splashVPos: '60px',
      closeBtnText: ''
    });

    //link ativo
    function activateLink(el,ct) {
        $(el,ct).on('click',function(e) {
            e.preventDefault();
            $(this).parents('li').addClass('active').siblings('li').removeClass('active');
        });
    };
    //activateLink('a','.nav-groups');
    activateLink('a','.nav-apresentations');
    activateLink('a','.nav-projects');

    //Slide de imagens em todas as paginas
    $('.bd-images').cycle();

    //Gerar legendas em imagens
    function showCaption() {
        $.each($('img','.page-thumb'), function(i) {
            var caption = $(this).attr('data-caption');
            $('.page-thumb').eq(i).find('figcaption')
            .text(caption);
        });
    };
    showCaption();   

    //Gerar timeline
    FlowSlider(".flowslider", {
        startPosition: 0.0,
        position: 0.5,
        marginStart: 50,
        marginEnd: 100,
        controllerOptions: [{
            mouseStart: 0,
            mouseEnd: 100
        }]
    });

    //Configurar ajax
    $.ajaxSetup({
        url : getData.ajaxDir,
        type : 'GET',
        dataType : 'html',
    });

    //Piollin
    //Menu sub paginas
    //$('li:first','.nav-groups').addClass('active');
    /*
    $('a','.nav-groups').on('click',function(e) {
        //e.preventDefault();
        //$(this).parents('li').addClass('active').siblings('li').removeClass('active');

        var page_name = $(this).text();
        $('.group-title').text(page_name);

        $.ajax({ 
            data : {
                action : 'request_child_piollin',
                page_name : page_name
            },
            beforeSend : function() {
                $('.group-content').fadeOut('slow'); 
                $('.waiting-post').fadeIn('fast');     
            },
            complete : function() {
                $('.waiting-post').fadeOut('fast');
                $('.group-content').fadeIn('slow');
            },
            success : function(data) {
                $('.group-content').html(data);
            },
            error : function(xhr) {
                alert('Ocorreu algum erro. Tente novamente.');
            }
        });
    });
    */
   
    $.each($('li','.group-slide'), function(i) {
       if(i <= 2) {
        $(this).addClass('clearing-featured-img');
       }
    });


    //Espetáculos
    //requisitar peça
    $('li:first','.nav-apresentations').addClass('active');
    $('a','.nav-apresentations').on('click',function(e) {
        //e.preventDefault();
        var postid = $(this).data('postid');

        $.ajax({
            data : {
                action : 'request_espetaculo',
                postid : postid
            },
            beforeSend : function() {
                $('.esp-text').fadeOut('slow', function() {
                    $('.waiting-post').fadeIn('fast');
                });      
            },
            complete : function() {
                $('.waiting-post').fadeOut('fast', function() {
                    $('.esp-text').fadeIn('slow');
                });
            },
            success : function(data) { 
                $('.esp-text').html(data);
            },
            error : function(xhr) {
                alert('Ocorreu algum erro. Tente novamente.');
            }
        });

        $.ajax({
            data : {
                action : 'request_espetaculo_images',
                postid : postid
            },
            beforeSend : function() {
                $('.group-slide.vertical').fadeOut('slow');      
            },
            complete : function() {
                $('.group-slide.vertical').fadeIn('fast');
            },
            success : function(data) {
                if(data) {
                    $('.group-slide.vertical').html(data);
                    $(document).foundation();
                    showCaption();
                } else {
                    console.log('sem imagens');
                }
            },
            error : function(xhr) {
                alert('Ocorreu algum erro. Tente novamente.');
            }
        });
    });
    
    $.each($('li','.nav-apresentations'), function(i) {
        if(i <= 2) {
            $(this).addClass('clearing-featured-img');
        }
    });

    //Projetos
    $('li:first','.nav-projects').addClass('active');
    
    $('a','.nav-projects').on('click',function(e) {
        var postid = $(this).data('postid');
        $.ajax({
            data : {
                action : 'request_projeto',
                postid : postid
            },
            beforeSend : function() {
                $('.pj-text').fadeOut('slow', function() {
                    $('.waiting-post').fadeIn('fast');
                });      
            },
            complete : function() {
                $('.waiting-post').fadeOut('fast', function() {
                    $('.pj-text').fadeIn('slow');
                });
            },
            success : function(data) { 
                $('.pj-text').html(data);
            },
            error : function(xhr) {
                alert('Ocorreu algum erro. Tente novamente.');
            }
        });

        $.ajax({
            data : {
                action : 'request_projeto_images',
                postid : postid
            },
            beforeSend : function() {
                $('.pj-images').fadeOut('slow');     
            },
            complete : function() {
                $('.pj-images').fadeIn('slow');
            },
            success : function(data) { 
                $('.pj-images').html(data);
            },
            error : function(xhr) {
                alert('Ocorreu algum erro. Tente novamente.');
            }
        });
    });


    /*
        Pagina imprensa
     */
    $('a','.midia').click(function() {
        var title = $(this).text();

        $('.midia-section').text(title);
    });
    
    //Requisitar releases
    $('a[title="Imprensa"]').on('click',function(e) {
        e.preventDefault();

         $.ajax({
            data : {
                action : 'request_imprensa',
            },
            beforeSend : function() {
                $('.nav-releases').fadeOut('slow', function() {
                    $('.waiting-post').fadeIn('fast');
                });     
            },
            complete : function() {
                $('.waiting-post').fadeOut('fast', function() {
                    $('.nav-releases').fadeIn('slow');
                });
            },
            success : function(data) { 
                $('.nav-releases').html(data);
            },
            error : function(xhr) {
                alert('Ocorreu algum erro. Tente novamente.');
            }
        });
    });

    //Requisitar Clipping
    $('a[title="Clipping"]').on('click',function(e) {
        e.preventDefault();

         $.ajax({
            data : {
                action : 'request_clipping',
            },
            beforeSend : function() {
                $('.nav-releases').fadeOut('slow', function() {
                    $('.waiting-post').fadeIn('fast');
                });     
            },
            complete : function() {
                $('.waiting-post').fadeOut('fast', function() {
                    $('.nav-releases').fadeIn('slow');
                });
            },
            success : function(data) { 
                $('.nav-releases').html(data);
            },
            error : function(xhr) {
                alert('Ocorreu algum erro. Tente novamente.');
            }
        });
    });
    
    

}, new WOW().init());

// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();