// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// by SatriaThemes
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

	// hide preloader
	jQuery('#preloader').delay(500).fadeOut(500);
	
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // change menu on mobile version
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    domready(function() {
        "use strict";
        selectnav('mainmenu', {
            label: '',
            nested: true,
            indent: '-'
        });
    });
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // touch and swipe owl carousel
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    jQuery("#testi-carousel").owlCarousel({
        singleItem: true,
        lazyLoad: true,
        navigation: false
    });
    jQuery(".custom-carousel-1").owlCarousel({
        items: 3,
        navigation: false,
        pagination: false,
    });
    jQuery(".custom-carousel-2").owlCarousel({
        items: 3,
        navigation: false,
        pagination: false,
    });
	// wow jquery
	new WOW().init();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // fit video
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    jQuery(".container").fitVids();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // filtering gallery
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    var $container = jQuery('#gallery-isotope');
    $container.isotope({
        itemSelector: '.item',
        filter: '*',
    });
    jQuery('#filters a').click(function() {
        var $this = jQuery(this);
        if ($this.hasClass('selected')) {
            return false;
        }
        var $optionSet = $this.parents();
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
        var selector = jQuery(this).attr('data-filter');
        $container.isotope({
            filter: selector,
        });
        return false;
    });
    jQuery('.animated').fadeTo(0, 0);
    anim = function() {
        jQuery('.animated').each(function() {
            var imagePos = jQuery(this).offset().top;
            var topOfWindow = jQuery(window).scrollTop();
            if (imagePos < topOfWindow + 500) {
                jQuery(this).fadeTo(1, 500);
                $anim = jQuery(this).attr('data-animation')
                jQuery(this).addClass($anim);
            }
        });
    }
    anim();
    // - - - - - - - - - -
    function equalHeight(group) {
        tallest = 0;
        group.each(function() {
            thisHeight = $(this).parent().height();
            if (thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }
    $(document).ready(function() {
        equalHeight($(".item-blog"));
    });
    jQuery('.small-pic').each(function() {
        w = jQuery(this).parent().css("width");
        wd = (parseInt(w) - 40) / 4;
        jQuery(this).css("width", wd);
        jQuery(this).css("height", wd);
    });
    jQuery('.wide-pic').each(function() {
        w = jQuery(this).parent().css("width");
        wd = (parseInt(w) - 40) / 2;
        jQuery(this).css("width", wd + 10);
        jQuery(this).css("height", wd / 2);
    });
    jQuery('.long-pic').each(function() {
        w = jQuery(this).parent().css("width");
        wd = (parseInt(w) - 40) / 4;
        jQuery(this).css("width", wd);
        jQuery(this).css("height", wd * 2 + 10);
    });
    init = function() {
            // - - - - - - - - - -
            jQuery('.fx .item').each(function() {
                jQuery(this).find("img").css("width", "100%");
                jQuery(this).find("img").css("height", "auto");
                jQuery(this).find("img").on('load', function() {
                    w = jQuery(this).css("width");
                    h = jQuery(this).css("height");
                    //nh = (h.substring(0, h.length - 2)/2)-48;
                }).each(function() {
                    if (this.complete) $(this).load();
                });
            });
            // - - - - - - - - - -
            jQuery('#gallery-isotope .item').each(function() {
                jQuery(this).find(".overlay").fadeTo(1, 0);
                jQuery(this).find("img").css("width", "100%");
                jQuery(this).find("img").css("height", "auto");
                jQuery(this).find("img").on('load', function() {
                    w = jQuery(this).css("width");
                    h = jQuery(this).css("height");
                    jQuery(this).parent().find(
                        ".overlay").css("width", w);
                    jQuery(this).parent().find(
                        ".overlay").css("height", h);
                }).each(function() {
                    if (this.complete) $(this).load();
                });
            });
            // - - - - - - - - - -
            jQuery("#gallery-isotope .item").hover(function() {
                    jQuery(this).find(".overlay").stop().fadeTo(300,
                        .5);
                }, function() {
                    jQuery(this).find(".overlay").stop().fadeTo(300,
                        0);
                })
                // - - - - - - - - - -
            jQuery('#gallery-isotope').isotope('reLayout');
            // - - - - - - - - - -
            jQuery('.f_box').each(function() {
                jQuery(this).find("img").on('load', function() {
                    w = parseInt(jQuery(this).css(
                        "width"));
                    h = parseInt(jQuery(this).css(
                        "height"));
                    w_box = parseInt(jQuery(this).parent()
                        .parent().css("width"));
                    wx = w_box - w;
                    f = jQuery(this).parent().parent();
                    t = jQuery(this).parent().parent().find(
                        ".text");
                    t.css("margin-top", h / 2 - (t.height() /
                        2));
                    t.css("width", wx);
                    if (f.hasClass("f_left")) {
                        t.css("left", wx / 2 - (t.width() /
                            2));
                    } else {
                        t.css("right", wx / 2 - (t.width() /
                            2));
                    }
                }).each(function() {
                    if (this.complete) $(this).load();
                });
            });
            jQuery('.custom-col-2').each(function() {
                jQuery(this).find("img").css("width", "100%");
                jQuery(this).find("img").css("height", "auto");
                jQuery(this).find("img").fadeTo(0, .5);
                jQuery(this).find("img").on('load', function() {
                    w = jQuery(this).css("width");
                    h = jQuery(this).css("height");
                    jQuery(this).parent().find(
                        ".overlay").css("width", w);
                    n = jQuery(this).parent().find(
                        ".centered");
                    hn = (parseInt(h) - parseInt(n.css(
                        'height'))) / 2;
                    wn = (parseInt(w) - parseInt(n.css(
                        'width')) / 2) / 2;
                    n.css("top", hn);
                    n.css("left", wn);
                    //nh = (h.substring(0, h.length - 2)/2)-48;
                }).each(function() {
                    if (this.complete) $(this).load();
                });
            });
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
            jQuery('.event-list li').each(function() {
                jQuery(this).find("img").on('load', function() {
                    //jQuery(this).fadeTo(100,.4);
                    w = parseInt(jQuery(this).css(
                        "width"));
                    h = parseInt(jQuery(this).css(
                        "height"));
                    t = jQuery(this).parent().parent().find(
                        ".text");
                    s = jQuery(this).parent().parent().find(
                        ".date");
                    t.css("margin-top", h / 2 - (t.height() /
                        2));
                    s.css("margin-top", h / 2 - (s.height() /
                        2));
                    s.css("margin-left", w / 2 - (s.width() /
                        2));
                }).each(function() {
                    if (this.complete) $(this).load();
                });
            });
            jQuery(".event-list li").hover(function() {
                jQuery(this).find("img").stop(true).fadeTo(200,
                    1);
                jQuery(this).find(".date").stop(true).fadeTo(
                    200, 0);
            }, function() {
                //jQuery(this).find("img").stop(true).fadeTo(200,.4);
                jQuery(this).find(".date").stop(true).fadeTo(
                    200, 1);
            })
        } // close function init
    init();
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // paralax background
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	
    $window = jQuery(window);
    jQuery('section[data-type="background"]').each(function() {
        var $bgobj = jQuery(this); // assigning the object
        jQuery(window).scroll(function() {
            anim();
            var yPos = -($window.scrollTop() / $bgobj.data(
                'speed'));
            var coords = '50% ' + yPos + 'px';
            $bgobj.css({
                backgroundPosition: coords
            });
        });
    });
    document.createElement("article");
    document.createElement("section");
    // --------------------------------------------------
    // portfolio hover
    // --------------------------------------------------
    jQuery(".fx .desc").fadeTo(0, 0);
    jQuery(".fx .item").hover(function() {
            speed = 700;
            jQuery(this).find(".desc").stop(true).animate({
                'height': "120px",
                'margin-top': "20px",
                "opacity": "100"
            }, speed, 'easeOutCubic');
            jQuery(this).find(".overlay").stop(true).animate({
                'height': "100%",
                'margin-top': "20px"
            }, speed, 'easeOutCubic');
            jQuery(this).parent().parent().find(".item").not(this).stop(
                true).fadeTo(speed, .5);
        }, function() {
            jQuery(this).find(".desc").stop(true).animate({
                'height': "0px",
                'margin-top': "0px",
                "opacity": "0"
            }, speed, 'easeOutCubic');
            jQuery(this).find(".overlay").stop(true).animate({
                'height': "84px",
                'margin-top': "20px"
            }, speed, 'easeOutCubic');
            jQuery(this).parent().parent().find(".item").not(this).stop(
                true).fadeTo(speed, 1);
        })
        // --------------------------------------------------
        // revolution slider
        // --------------------------------------------------
    var revapi;
    revapi = jQuery('#revolution-slider').revolution({
        delay: 15000,
        startwidth: 1170,
        startheight: 500,
        hideThumbs: 10,
        fullWidth: "off",
        fullScreen: "on",
        fullScreenOffsetContainer: "",
        touchenabled: "on",
        navigationType: "none",
    });
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // prettyPhoto function
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	
    jQuery("area[data-gal^='prettyPhoto']").prettyPhoto();
    jQuery("body:first a[data-gal^='prettyPhoto']").prettyPhoto({
        animation_speed: 'fast',
        theme: 'light_square',
        slideshow: 3000,
        autoplay_slideshow: false
    });
    jQuery("body:gt(0) a[data-gal^='prettyPhoto']").prettyPhoto({
        animation_speed: 'fast',
        slideshow: 10000,
        hideflash: true
    });
    jQuery("#custom_content a[data-gal^='prettyPhoto']:first").prettyPhoto({
        custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
        changepicturecallback: function() {
            initialize();
        }
    });
    jQuery("#custom_content a[data-gal^='prettyPhoto']:last").prettyPhoto({
        custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
        changepicturecallback: function() {
            _bsap.exec();
        }
    });
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // scroll to top
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	
    jQuery().UItoTop({
        easingType: 'easeInOutExpo'
    });
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // gallery hover
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	
    jQuery('.gallery .item').hover(function() {
        jQuery(this).stop().animate({
            opacity: .5
        }, 100);
    }, function() {
        jQuery(this).stop().animate({
            opacity: 1
        });
    }, 100);
    jQuery('.img-hover').hover(function() {
        jQuery(this).stop().animate({
            opacity: .5
        }, 100);
    }, function() {
        jQuery(this).stop().animate({
            opacity: 1
        });
    }, 100);
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // resize
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	
    window.onresize = function(event) {
        init();
        equalHeight(jQuery(".item-blog"));
    };
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // show / hide slider navigation
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	
    jQuery('.callbacks_nav').hide();
    jQuery('#slider').hover(function() {
        jQuery('.callbacks_nav').stop().animate({
            opacity: 1
        }, 100);
    }, function() {
        jQuery('.callbacks_nav').stop().animate({
            opacity: 0
        });
    }, 100);
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // image hover effect
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	
    jQuery(".pic-hover .hover").hide();
    jQuery(".pic-hover").hover(function() {
        jQuery(this).find(".hover").width(jQuery(this).find(
            "img").css("width"));
        jQuery(this).find(".hover").height(jQuery(this).find(
            "img").css("height"));
        jQuery(this).find(".hover").fadeTo(150, .9);
        picheight = jQuery(this).find("img").css("height");
        newheight = (picheight.substring(0, picheight.length -
            2) / 2);
        //alert(newheight);
        jQuery(this).find(".btn-view-details").css({
            'margin-top': newheight
        }, 'fast');
    }, function() {
        jQuery(this).find(".hover").fadeTo(150, 0);
    })
    jQuery(function() {
        // Slideshow 4
        jQuery(".pic_slider").responsiveSlides({
            auto: true,
            pager: false,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            before: function() {
                jQuery('.events').append(
                    "<li>before event fired.</li>"
                );
            },
            after: function() {
                jQuery('.events').append(
                    "<li>after event fired.</li>"
                );
            }
        });
    });
    // --------------------------------------------------
    // tabs
    // --------------------------------------------------
    jQuery('.lt_tab').find('.lt_tab_content div').hide();
    jQuery('.lt_tab').find('.lt_tab_content div:first').show();
    jQuery('.lt_nav li').click(function() {
        jQuery(this).parent().find('li span').removeClass(
            "active");
        jQuery(this).find('span').addClass("active");
        jQuery(this).parent().parent().find(
            '.lt_tab_content div').hide();
        var indexer = jQuery(this).index(); //gets the current index of (this) which is #nav li
        jQuery(this).parent().parent().find(
            '.lt_tab_content div:eq(' + indexer + ')').fadeIn(); //uses whatever index the link has to open the corresponding box 
    });

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// lazyload
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 	
jQuery(document).ready(function() {
    var $header = jQuery("header"),
        $clone = $header.before($header.clone().addClass("clone"));
    jQuery(window).on("scroll", function() {
        var fromTop = jQuery(window).scrollTop();
        console.log(fromTop);
        jQuery("body").toggleClass("down", (fromTop > 240));
        anim();
    });
});