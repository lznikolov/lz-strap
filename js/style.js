/* Menu */
/*
 $( ".navbar-toggle" ).click(function() {
 $("html, body").toggleClass( "yHidden" );
 });
 */
/*--------------------------------------------------------------------------------------------------------------------*/
$(document).ready(function () {
    console.log("document ready");

    /*----------------------------------------------------------------------------------------------------------------*/
    // affix is called over js so we are not bound to the size of the elements
    console.log("affix");
    $('.navbar.navbar-default').affix({
        offset: {
            top: function () {
                return $('#logo_bar').outerHeight(true)
            },
            bottom: function () {
                return $('.footer').outerHeight(true)
            }
        }
    });
    $('.navbar.navbar-default').affix('checkPosition');

    /*----------------------------------------------------------------------------------------------------------------*/
    //Nav Menu Active Tab
    console.log("nav menu active");
    var menuId = $(".nav.navbar-nav");
    $.each(menuId.find('li'), function () {
        $(this).toggleClass('active', $(this).find('a').attr('href') + '/' == window.location.href);
    });

    /*----------------------------------------------------------------------------------------------------------------*/
    //Go to top button
    console.log("go to top");
    function scrollToTop() {
        var verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
        var element = $('body');
        var offset = element.offset();
        var offsetTop = offset.top;
        $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
    }

    var scroll_wrapped = $(".scroll-top-wrapper");
    var scrollOS;
    switch (navigator.platform) {
        case "Win32":
            scrollOS = 'windows';
            break;
        case "iPhone":
            scrollOS = 'apple';
            break;
        case "Android":
            scrollOS = 'android';
            break;
        case "Linux armv7l":
            scrollOS = 'android';
            break;
        default:
            scroll_wrapped.find("img").attr("src", "/assets/images/goToTop.png");
            console.log('default');
    }
    var scrollImg_fixed = "/assets/images/scroll_to_top/" + scrollOS + "_fixed.png";
    var scrollImg_move = "/assets/images/scroll_to_top/" + scrollOS + "_move.png";

    scroll_wrapped.on('click', scrollToTop);
    $(document).on('scroll', function () {
        scroll_wrapped.find("img").attr("src", scrollImg_fixed);
        if ($(window).scrollTop() > 184) {
            scroll_wrapped.addClass('show');
        } else {
            scroll_wrapped.removeClass("show");
        }
    });

    /*----------------------------------------------------------------------------------------------------------------*/
    //Socials
    console.log("socials");
    var targetSocials = $('.social');
    //targetSocials.hide();
    if (!('ontouchstart' in document)) {
//        console.log(screen.width);
//        console.log($(window).width());
        $(window).scroll(function () {
            if ($(document).scrollTop()) {
                $('.social').fadeIn(500);
            }
        });
    }

    /*----------------------------------------------------------------------------------------------------------------*/
    // category toggle on hover
    console.log('category toggle on hover');
    $("#categoriesContent").find('div').hover(function () {
        $("div:nth-child(2) > div", this).collapse('toggle');
    });
    /*----------------------------------------------------------------------------------------------------------------*/
    //popover toggle
    console.log('popover');
    $('[data-toggle="popover"]').popover({
        trigger: "click"
    }).on("show.bs.popover", function (e) {
        // hide all other popovers
        $("[rel=tooltip]").not(e.target).popover("destroy");
        $(".popover").remove();
    });

    /*----------------------------------------------------------------------------------------------------------------*/
    //make parents clickable
    console.log("make nav menu parent links clickable");
    //TODO Check if it works on a mobile device if not remove ontouchstart check
    //this in the else replace the hover plugin

    if ('ontouchstart' in document) {
        console.log('mobile navigation');
        /*
        $('.navbar').find('.dropdown').click(function (e) {
                if (!$(this).hasClass('active')) {
                    $('.nav li').removeClass('active');
                    $(this).addClass('active');
                    e.preventDefault();
                } else {
                    return true;
                }
        });
        */
        return this;
    } else {
        $('.navbar').find('.dropdown').hover(
            function () {
                $(this).find('.dropdown-menu.flex-menu').css("display","flex");
                $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown("fast");
                $(this).toggleClass('open');
                $(this).find('a').attr("aria-expanded","true");
            },
            function () {
                //$(this).find('ul.dropdown-menu.flex-menu').css("display:none");
                $(this).find('.dropdown-menu').first().stop(true, true).slideUp("fast");
                $(this).toggleClass('open');
                $(this).find('a').attr("aria-expanded","false");
            });

        $('.navbar').find('.dropdown > a').click(function () {
            location.href = this.href;
            return false;
        });
    }
});

/*--------------------------------------------------------------------------------------------------------------------*/
//table sorting
function colSort(tableName, colName, order) {
    console.log('sorting' + ' ' + tableName + ' ' + 'by ' + colName + ',' + order);
    order = order || "asc";
    tinysort('#' + tableName + ' .tab-content-operator',
        //interactive selector , triggered on click
        {
            selector: 'div[data-' + colName + ']',
            data: colName,
            order: order,
            place: 'org',
            returns: true
        },
        //second selector for the rating, if the fist selector returns a list of equal values,
        // they will be sorted by the second parameter. in this case - rating
        {
            selector: 'div[data-rating]',
            data: 'rating',
            order: 'desc'
        }
    ).forEach(function (elm) {
        //elm.style.background = '#666';
    });
}

//default sorting the active tab
if($('#os_tabs').length){
    colSort($('#os_tabs').find('.active > a').attr('href').slice(1), 'rating', 'desc');
    $('.tab-content-sorter,.tab-content-operator').find('button').each(function () {
        var $this = $(this);
        $this.on("click", function () {
            var colName = $(this).data('colname');
            var sortOder = $(this).data('sort');
            var tableName = $('.tab-pane.active').attr('id');
            colSort(tableName, colName, sortOder);
        });
    });
}



/*--------------------------------------------------------------------------------------------------------------------*/
// operator h2 counter
function h2Circle() {
    var h2List = $('#operatorContent, #mainContent').find('h2');
    var pageHeader = $('#operatorContainer, #mainContainer').find('.page-header').first();
    var offsetOld = 0;
    var h2CounterWidth = $('#h2Counter').outerWidth();

    // put a circle on the left of every h2
    $.each(h2List, function (key, value) {
        var rowNum = key + 1;
        var offset_top = this.offsetTop;
        $('#h2Counter').append('<div class="circle" style="top:' + (offset_top + 6) + 'px; left:' + (h2CounterWidth / 2) + 'px ">' + rowNum + '</div>');
    });

    var h2CounterCircleWidth = $('#h2Counter').find('.circle').outerWidth();
    var circleCenter = (h2CounterWidth / 2) + (h2CounterCircleWidth / 2);
    var circles = $('#operatorContent, #mainContent').find('.circle');
    var pageBegin = $('h1').first();
    var pageEnd = $("#operatorContent,#mainContent").find('.col-xs-12 p').last();
    // add the pagebegin elemtn to the massive so we start drawing from that element
    var allElements = circles.add(pageBegin).add(pageEnd);
    var lastCircleTop;

    $.each(circles, function (key, value) {
        if (key === 0) {
            lastCircleTop = this;
            //return true, za da ne go izchertawame, prosto preskachame
            return true;
        }
        var circleTop = lastCircleTop.offsetTop + 29;
        var lineHeight = this.offsetTop - lastCircleTop.offsetTop - 37;
        $(this).before('<div style="width: 1px; height: ' + lineHeight + 'px;background-color:#ffa200;left:' + circleCenter + 'px;top:' + circleTop + 'px;position:absolute"></div>');
        lastCircleTop = this;
    });

    $('.circle:first').before('<div style="width: 1px; height: ' + (circles[0].offsetTop-9) + 'px;background-color:#ffa200;left:' + circleCenter + 'px;top:0;position:absolute"></div>');
    $('.circle:last').after('<div style="width: 1px; height: ' + ((pageEnd[0].offsetTop - $('.circle').last()[0].offsetTop)-29+pageEnd.innerHeight())+ 'px;background-color:#ffa200;left:' + circleCenter + 'px;top:'+ (circles[circles.length-1].offsetTop+29)+'px;position:absolute"></div>');
}
$(window).load(h2Circle);
$(window).resize(function () {
    $('#h2Counter').empty();
    h2Circle();
});
/*--------------------------------------------------------------------------------------------------------------------*/
//sorting the table tab on click and recalculation the side line
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var id = $(this).attr('href').slice(1);
    colSort(id, 'rating', 'desc');
    $('#h2Counter').empty();
    h2Circle();
});
/*--------------------------------------------------------------------------------------------------------------------*/
// expand all the dropdowns in the menu on click
$(".navbar-collapse").on('shown.bs.collapse', function () {
    console.log("menu shown collapse");
    $('.nav .dropdown').css('display','block').addClass('open');
    $('.navbar').find('.dropdown > a').click(function () {
        location.href = this.href;
        return false;
    });
});
// collapse all the dropdowns in the menu on click
$(".navbar-collapse").on('hide.bs.collapse', function () {
    console.log("menu hidden collapse");
    $('.nav .dropdown').css('display','none').removeClass('open');
});

/*--------------------------------------------------------------------------------------------------------------------*/
//recalculation the side line on toggle show
$(".tab-pane .collapse").on('shown.bs.collapse', function () {
    console.log("shown table collapse");
    $('.toggle_bonus_boxes', this).toggle();
    var divShow = $(this).parent().attr('id');
    //hide the show me more button after click
    $('#'+divShow+' .toggle_bonus_boxes').toggle();
    $('#h2Counter').empty();
    h2Circle();
});
//recalculation the side line on toggle hide
$(".tab-pane .collapse").on('hidden.bs.collapse', function () {
    console.log("hidden table collapse");
    $('#h2Counter').empty();
    h2Circle();
});
/*--------------------------------------------------------------------------------------------------------------------*/
//hide the page until is completely loaded
/*
 $(window).load(function() {
 // Animate loader off screen
 $("#loadOverlay").fadeOut("slow");
 });
 */

/*--------------------------------------------------------------------------------------------------------------------*/
//Facebook plugin
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.4&appId=726079387511467";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$('#lz-menu').find('#show-all-operators').click(function(e){
   var selection = $(this).parent().parent().find('li');
    selection.each(function () {
        if($(this).hasClass('hidden-md')){
            $(this).removeClass('hidden-md hidden-lg');
        }
    });
    $('#lz-menu').find('#show-all-operators').parent().toggle();
    //$('#lz-menu').find('#show-all-operators').parent().remove();
    //$(this).parent().parent().
});