
/*
 $( ".navbar-toggle" ).click(function() {
 $("html, body").toggleClass( "yHidden" );
 });
 */
/*--------------------------------------------------------------------------------------------------------------------*/
/* added by Rangel */
$(document).ready(function () {
    console.log("document ready");

    /* Nav Menu Active Tab*/
    console.log("nav menu active");
    $(".nav a").on("click", function () {
        $(".nav").find(".active").removeClass("active");
        $(this).parent().addClass("active");
    });

    /*Go to top button*/
    console.log("go to top");
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
        default:
            $(".scroll-top-wrapper").find("img").attr("src", "/assets/images/goToTop.png");
            console.log('default');
    }
    var scrollImg_fixed = "/assets/images/scroll_to_top/" + scrollOS + "_fixed.png";
    var scrollImg_move = "/assets/images/scroll_to_top/" + scrollOS + "_move.png";

    $(function () {
        $(document).on('scroll', function () {
            $(".scroll-top-wrapper").find("img").attr("src", scrollImg_fixed);
            if ($(window).scrollTop() > 184) {
                $(".scroll-top-wrapper").addClass('show');
            } else {
                $(".scroll-top-wrapper").removeClass("show");
            }
        });
        $(".scroll-top-wrapper").on('click', scrollToTop);
    });

    function scrollToTop() {

        var verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
        var element = $('body');
        var offset = element.offset();
        var offsetTop = offset.top;
        $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
    }

    /*Socials*/
    console.log("socials");
    var targetSocials = $('.social');
    targetSocials.hide();
    $(window).scroll(function () {
        if ($(document).scrollTop() > 184) {
            $('.social').fadeIn(2000);
        }
    });

    console.log('category toggle on hover');
    $("#categoriesContent > div").hover(function () {
        $("div:nth-child(2) > div", this).collapse('toggle');
    });

    console.log("affix");
    /*affix mus always be called last */
    /* affix is caller over js so we are not bound to the size of the elements*/
    $('#menu_bar').affix({
        offset: {
            top: function () {
                return (this.bottom = $('#logo_bar').outerHeight(true))
            },
            bottom: function () {
                return (this.bottom = $('footer').outerHeight(true))
            }
        }
    });

    /*table sorting*/

    function colSort(colName, order) {
        console.log('table sorting');
        order = order || "asc";
        tinysort('#iosapp_casinos > .tab-row-content',{selector:'div[data-'+colName+']',data:colName, returns:true, order:order})
            .forEach(function(elm){
                //elm.style.color = 'red';
            });
    }
    colSort('rating','desc');

    /*popover toggle*/
    $('[data-toggle="popover"]').popover();

    /* tab switcher*/
    $('#tabs').find('a').click(function (e) {
        debugger;
        e.preventDefault();
        $(this).tab('show');
        console.log('tab switched');
    });
});

/*Facebook plugin*/
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.4&appId=726079387511467";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

/* operator h2 counter */
function h2Circle() {
    var h2List = $('#operatorContent, #mainContent').find('h2');
    var offsetOld = 0;

    $.each(h2List, function (key, value) {
        var rowNum = key + 1;
        var offsettop = this.offsetTop;
        var lineHeight = offsettop - offsetOld;
        offsetOld = offsettop;
        $('#h2Counter').append('<div class="circle" style="top: ' + (offsettop + 6) + 'px; ">' + rowNum + '</div>');
    });

    var circles = $('#operatorContent, #mainContent').find('.circle');
    var lastCircleTop;
    $.each(circles, function (key, value) {
        if (key === 0) {
            lastCircleTop = this;
            return true;
        }
        var circleTop = lastCircleTop.offsetTop + 31;
        var lineHeight = this.offsetTop - lastCircleTop.offsetTop - 38;
        $(this).before('<div style="width: 1px; height: ' + lineHeight + 'px;background-color:#ffa200;left:40px;top:' + (circleTop) + 'px;position:absolute"></div>');
        lastCircleTop = this;
    });

}
$(window).load(h2Circle);
$(window).resize(function () {
    $('#h2Counter').empty();
    h2Circle();
});


$('#bonus_boxes .show_bonus_button').click(function () {
//    console.log("show bonus code");
    if (document.cookie.indexOf("m _" + $(this).data("operator") + "") >= 0) {
        var now = new Date();
        var time = now.getTime();
        time += 3600 * 1000;
        now.setTime(time);
        document.cookie = "m_" + $(this).data("operator") + "=1;expires=" + now.toUTCString();
        document.cookie = "m_" + $(this).data("operator") + "_" + $(this).data("bon") + "=2;expires=" + now.toUTCString();
    } else {
        var _this = $(this);
        var _id = $(this).data("bon");
        var _url = $(this).data("url");
        var now = new Date();
        var time = now.getTime();
        time += 3600 * 1000;
        now.setTime(time);
        document.cookie = "m_" + $(this).data("operator") + "=1;expires=" + now.toUTCString();
        document.cookie = "m_" + $(this).data("operator") + "_" + $(this).data("bon") + "=1;expires=" + now.toUTCString();
        $.ajax({
            type: "POST",
            data: "action=click&bonus=" + $(this).data("bonid") + "",
            url: "/wp-content/themes/mini-strap/custom/mymeta/ajx.php",
            success: function (exhtml) {
                _this.parent().parent().find('.bonus_users').text(exhtml); //tuk trqbwa da se nameri prawilnoto pole
                //console.log(exhtml);
                window.open("" + _url + "", "_self");
            }
        });
    }
});



/*--------------------------------------------------------------------------------------------------------------------*/


/* Top 5 operators */
$(document).ready(function () {
    $('.top5operators-operator').mouseenter(function () {
        $src = $(".top5operators-leftPartImg img", this).attr("src");
        $srcFinal = $src.replace("_bnw", "");
        $(".top5operators-leftPartImg img", this).animate({opacity: 1}, 150).attr("src", $srcFinal);

        $src2 = $(".top5operators-rightPartBottom img", this).attr("src");
        $srcFinal2 = $src2.replace(".png", ".png");
        $(".top5operators-rightPartBottom img", this).animate({opacity: 1}, 150).attr("src", $srcFinal2);

    }).mouseleave(function () {
        $src = $(".top5operators-leftPartImg img", this).attr("src");
        $srcFinal = $src.replace("105x53", "105x53_bnw");
        $(".top5operators-leftPartImg img", this).animate({opacity: 0.7}, 150).attr("src", $srcFinal);

        $src2 = $(".top5operators-rightPartBottom img", this).attr("src");
        $srcFinal2 = $src2.replace(".png", ".png");
        $(".top5operators-rightPartBottom img", this).animate({opacity: 0.7}, 150).attr("src", $srcFinal2);
    });

    $('.top10operators-operator').mouseenter(function () {
        $src = $(".top10operators-leftPartImg img", this).attr("src");
        $srcFinal = $src.replace("_bnw", "");
        $(".top10operators-leftPartImg img", this).animate({opacity: 1}, 150).attr("src", $srcFinal);
    }).mouseleave(function () {
        $src = $(".top10operators-leftPartImg img", this).attr("src");
        $srcFinal = $src.replace("105x53", "105x53_bnw");
        $(".top10operators-leftPartImg img", this).animate({opacity: 0.7}, 150).attr("src", $srcFinal);
    });
});

/* Progress */
(function ($) {
    $.fn.extend({
        //pass the options variable to the function
        percentcircle: function (options) {
            //Set the default values, use comma to separate the settings, example:
            var defaults = {
                    animate: true,
                    diameter: 50,
                    guage: 5,
                    coverBg: '#fff',
                    bgColor: '#efefef',
                    fillColor: '#7abd86',
                    percentSize: '14px',
                    percentWeight: 'bold'
                },
                styles = {
                    cirContainer: {
                        'width': defaults.diameter,
                        'height': defaults.diameter
                    },
                    cir: {
                        'position': 'relative',
                        'text-align': 'center',
                        'width': defaults.diameter,
                        'height': defaults.diameter,
                        'border-radius': '100%',
                        'background-color': defaults.bgColor,
                        'background-image': 'linear-gradient(91deg, transparent 50%, ' + defaults.bgColor + ' 50%), linear-gradient(90deg, ' + defaults.bgColor + ' 50%, transparent 50%)'
                    },
                    cirCover: {
                        'position': 'relative',
                        'top': defaults.guage,
                        'left': defaults.guage,
                        'text-align': 'center',
                        'width': defaults.diameter - (defaults.guage * 2),
                        'height': defaults.diameter - (defaults.guage * 2),
                        'border-radius': '100%',
                        'background-color': defaults.coverBg
                    },
                    percent: {
                        'display': 'block',
                        'width': defaults.diameter,
                        'height': defaults.diameter,
                        'line-height': defaults.diameter + 'px',
                        'vertical-align': 'middle',
                        'font-size': defaults.percentSize,
                        'font-weight': defaults.percentWeight,
                        'color': defaults.fillColor
                    }
                };

            var that = this,
                template = '<div class="percFirstChild"><div class="ab"><div class="cir"><span class="perc">{{percentage}}</span></div></div></div>',
                options = $.extend(defaults, options);

            function init() {
                that.each(function () {
                    var $this = $(this),
                    //we need to check for a percent otherwise set to 0;
                        perc = Math.round($this.data('percent')), //get the percentage from the element
                        deg = perc * 3.6,
                        stop = options.animate ? 0 : deg,
                        $chart = $(template.replace('{{percentage}}', (Math.round(perc / 10 * 100) / 100).toFixed(1) + ''));
                    //set all of the css properties forthe chart


                    $chart.css(styles.cirContainer).find('.ab').css(styles.cir).find('.cir').css(styles.cirCover).find('.perc').css(styles.percent);

                    $this.append($chart); //add the chart back to the target element
                    setTimeout(function () {
                        animateChart(deg, parseInt(stop), $chart.find('.ab')); //both values set to the same value to keep the function from looping and animating
                    }, 250)
                });
            }

            var animateChart = function (stop, curr, $elm) {
                var deg = curr;
                if (curr <= stop) {
                    if (deg >= 180) {
                        $elm.css('background-image', 'linear-gradient(' + (90 + deg) + 'deg, transparent 50%, ' + options.fillColor + ' 50%),linear-gradient(90deg, ' + options.fillColor + ' 50%, transparent 50%)');
                    } else {
                        $elm.css('background-image', 'linear-gradient(' + (deg - 90) + 'deg, transparent 50%, ' + options.bgColor + ' 50%),linear-gradient(90deg, ' + options.fillColor + ' 50%, transparent 50%)');
                    }
                    curr++;
                    setTimeout(function () {
                        animateChart(stop, curr, $elm);
                    }, 1);
                }
            };

            init(); //kick off the goodness
        }
    });

})(jQuery);

$('.demoCircle').percentcircle();

/*Creating the cookie for the ctas box field that shows the bonus code*/
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
/*
 $(document).on('click', '.direktot, .boxes-boxLink', function (e) {
 if (document.cookie.indexOf("m _" + $(this).data("operator") + "") >= 0) {
 var now = new Date();
 var time = now.getTime();
 time += 3600 * 1000;
 now.setTime(time);
 document.cookie = "m_" + $(this).data("operator") + "=1;expires=" + now.toUTCString();
 document.cookie = "m_" + $(this).data("operator") + "_" + $(this).data("bon") + "=2;expires=" + now.toUTCString();
 } else {
 var _this = $(this);
 var _id = $(this).data("bon");
 var _url = $(this).data("url");
 var now = new Date();
 var time = now.getTime();
 time += 3600 * 1000;
 now.setTime(time);
 document.cookie = "m_" + $(this).data("operator") + "=1;expires=" + now.toUTCString();
 document.cookie = "m_" + $(this).data("operator") + "_" + $(this).data("bon") + "=1;expires=" + now.toUTCString();
 $.ajax({
 type: "POST",
 data: "action=click&bonus=" + $(this).data("bonid") + "",
 url: "/wp-content/themes/mini-strap/custom/mymeta/ajx.php",
 success: function (exhtml) {
 _this.find(".users").text(exhtml);
 window.open("" + _url + "", "_self");
 }
 });
 }
 });
 */
/*Updating the ctas likes*/
$(".boxes-boxlikes").on("click", function () {
    var _this = $(this);
    var _id = $(this).data("likebonus");
    $.ajax({
        type: "POST",
        data: "action=like&bonus=" + $(this).data("likebonus") + "",
        url: "/wp-content/themes/mini-strap/custom/mymeta/ajx.php",
        success: function (exhtml) {
            _this.html(exhtml);
            createCookie('link_' + _id + '', '' + _id + '', 7);
        }
    });
});

$(document).ready(function () {
    $(".withlist").click(function (event) {
        event.stopPropagation();
    });
    $(".popup-close").click(function () {
        $(".popup-mainHolder").fadeOut();
        $('body').removeClass('noScroll');
    });
    $(".popup-content").fadeIn();
    $(".popup-mainHolder").click(function () {
        $(".popup-mainHolder").fadeOut();
        $('body').removeClass('noScroll');
    });
});

/*Popup popup-afterClick show hide*/
$(document).ready(function () {
    $(".button").on("click", function () {
        $(".bonusinfo").remove();
        $(".popup-content h3").remove();
        $(".popup-content .popup-afterClick").fadeIn();
        $(".emailsubscribego").fadeIn();
        $(".nodeposittext").hide();
        $(".firstpotipbookie").hide();
        $(".popupFreeBetlist").hide();
        $(".popup-mainHolder").addClass("blueoverlay");
        $("#popupFreeBetlist").hide();
    });
});
$(".popup-mainHolder .button").on("click", function () {
    $(".bonusinfo").remove();
    $(".popup-content h3").remove();
    $(".popup-content .popup-afterClick").fadeIn();
    $(".emailsubscribego").fadeIn();
    $(".popup-mainHolder").addClass("blueoverlay");
    $("#popupFreeBetlist").hide();
});

/*Newsletter*/
/*
 $(document).ready(function () {
 $.ajax({
 type: "POST",
 data: "action=getnewsletter",
 url: "/wp-content/themes/mini-strap/custom/mymeta/ajx.php",
 success: function (exhtml) {
 $("#newsletter_sidebar > div > div:nth-child(2) > div.col-xs-5 > strong").first().append("<div class=\'newslnumbers\'>" + exhtml + "</div>");
 }
 });
 });
 */

/*Table hide/show/sort*/
mehrHide = null;

$('.tableHome-seeExtraButton').click(function () {
    $('.row.displayNone').fadeIn("slow", function () {
        $(this).removeClass("displayNone");
    });
    $(this).hide();
    $('.tableHome-sorting').css({BorderBottomLeftRadius: '10px', BorderBottomRightRadius: '10px'});
    mehrHide = 1;
});

/*Sorting*/
$(document).ready(function () {

    $('.tableHome-sorter').on('click', function () {
        var checker = '.' + $(this).data("checker");
        var sorting = $(this).data("sorting");
        var container = $(this).closest('.tableHome-sorting');

        if (toggleFlagRe == 2) {
            $(container.find('.divBox')).sortElements(function (a, b) {

                var aVal = $(a).find(checker).text();
                var bVal = $(b).find(checker).text();

                var aBra = $(a).find(checker);
                var aBraSecond = aBra.data("secondary") / 10;
                if (aBraSecond != '') {
                    aBraSecond = aBra.data("secondary") / 10;
                }
                else {
                    aBraSecond = 0;
                }

                var bBra = $(b).find(checker);
                var bBraSecond = bBra.data("secondary") / 10;
                if (bBraSecond != '') {
                    bBraSecond = bBra.data("secondary") / 10;
                }
                else {
                    bBraSecond = 0;
                }

                aVal = aVal.replace(".", "");
                bVal = bVal.replace(".", "");

                aVal = aVal.replace(" - ", "");
                bVal = bVal.replace(" - ", "");

                if (sorting == 'string') {
                    if (aVal == 'Kein Code nötig') {
                        aVal = 'zzzzz0';
                    }
                    if (bVal == 'Kein Code nötig') {
                        bVal = 'zzzzz0';
                    }
                    if (aVal == '') {
                        aVal = '0';
                    }
                    if (bVal == '') {
                        bVal = '0';
                    }

                    return String(aVal + String(aBraSecond)) < String(bVal + String(bBraSecond)) ? 1 : -1;
                }
                else {
                    if (aVal == 'Kein Bonus' || aVal == '') {
                        aVal = 0;
                    }
                    if (bVal == 'Kein Bonus' || bVal == '') {
                        bVal = 0;
                    }

                    return (parseFloat(aVal) + parseFloat(aBraSecond)) < (parseFloat(bVal) + parseFloat(bBraSecond)) ? 1 : -1;
                }

            });
            toggleFlagRe = 1;

            $('.tableHome-seeExtraButton').click();
        }
        else {
            $(container.find('.divBox')).sortElements(function (a, b) {

                var aVal = $(a).find(checker).text();
                var bVal = $(b).find(checker).text();

                var aBra = $(a).find(checker);
                var aBraSecond = aBra.data("secondary") / 10;
                if (aBraSecond != '') {
                    aBraSecond = aBra.data("secondary") / 10;
                }
                else {
                    aBraSecond = 0;
                }

                var bBra = $(b).find(checker);
                var bBraSecond = bBra.data("secondary") / 10;
                if (bBraSecond != '') {
                    bBraSecond = bBra.data("secondary") / 10;
                }
                else {
                    bBraSecond = 0;
                }

                aVal = aVal.replace(".", "");
                bVal = bVal.replace(".", "");

                aVal = aVal.replace(" - ", "");
                bVal = bVal.replace(" - ", "");

                if (sorting == 'string') {
                    if (aVal == 'Kein Code nötig') {
                        aVal = 'zzzzz';
                    }
                    if (bVal == 'Kein Code nötig') {
                        bVal = 'zzzzz';
                    }
                    if (aVal == '') {
                        aVal = '0';
                    }
                    if (bVal == '') {
                        bVal = '0';
                    }

                    return String(aVal + String(aBraSecond)) > String(bVal + String(bBraSecond)) ? 1 : -1;
                }
                else {
                    if (aVal == 'Kein Bonus' || aVal == '') {
                        aVal = 0;
                    }
                    if (bVal == 'Kein Bonus' || bVal == '') {
                        bVal = 0;
                    }

                    return (parseFloat(aVal) + parseFloat(aBraSecond)) > (parseFloat(bVal) + parseFloat(bBraSecond)) ? 1 : -1;
                }
            });
            toggleFlagRe = 2;
            $('.tableHome-seeExtraButton').click();
        }
    });
});

$.fn.sortElements = (function () {
    var sort = [].sort;
    return function (comparator, getSortable) {
        getSortable = getSortable || function () {
                return this;
            };
        var placements = this.map(function () {
            var sortElement = getSortable.call(this),
                parentNode = sortElement.parentNode,
                nextSibling = parentNode.insertBefore(
                    document.createTextNode(''),
                    sortElement.nextSibling
                );
            return function () {
                if (parentNode === this) {
                    throw new Error(
                        "You can't sort elements if any one is a descendant of another."
                    );
                }
                parentNode.insertBefore(this, nextSibling);
                parentNode.removeChild(nextSibling);
            };
        });
        return sort.call(this, comparator).each(function (i) {
            placements[i].call(getSortable.call(this));
        });
    };
})();

/*Default sorting*/
$(document).ready(function () {
    toggleFlagRe = null;

    var tab = $('ul.nav-tabs li');
    var clickedTab = tab.attr('id');

    if (window.location.origin + '/' == window.location.href) {
        defSorting(clickedTab);
    }

    tab.click(function () {
        var clickedTab = $(this).attr('id');
        defSorting(clickedTab);
        if (mehrHide == 1) {
            $('.tableHome-seeExtraButton').hide();
        }
    });
});

clickedTabs = [];
function defSorting(clickedTab) {
    if ($.inArray(clickedTab, clickedTabs) > -1) {
    }
    else {
        clickedTabs.push(clickedTab);
        toggleFlagRe = 2;
    }
}

/*Get param function*/
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

/*Nav Anchors Scrollspy2*/

/*ako ne raboti da poglednata ot originalnata tema failovete news,operator i subscribeTemplate*/
$(document).ready(function () {
    if (typeof ctaAnchors != 'undefined') {
        ctaAnchors = JSON.parse(ctaAnchors);
        ctaAnchorsElement = JSON.parse(ctaAnchorsElement);

        $(".operTitle").find("h1").attr("id", "h1");

        if (ctaAnchors != null) {
            for (var i = 0; i < ctaAnchors.length; i++) {
                $("#editorContent").find(ctaAnchorsElement).eq(i).attr("id", "hAnchor" + i);
            }
        }

        var offsetHeight = 75;
        /*
         $('body').scrollspy({
         target: '.bs-docs-sidebar',
         offset: offsetHeight
         });
         */
        $('.bs-docs-sidebar ul li a').click(function (event) {
            var scrollPos = $('body > div').find($(this).attr('href')).offset().top - offsetHeight + 5;
            $('body,html').animate({
                scrollTop: scrollPos
            }, 500, function () {
                $(".btn-navbar").click();
            });
            return false;
        });
    }
});
$(document).ready(function () {
    var numberSpec = $('.boxes-box').length;
    $('.bookiereview-imgText').append(numberSpec);
});

$(document).ready(function () {
    $('.showBoxesButton').on('click', function () {
        $(".boxes-box").fadeIn("slow", function () {
            $(this).removeClass("displayNone");
        });

        $(this).hide();
    });
});

$(document).ready(function () {
    if (window.location.search.indexOf('b') > -1) {
        $('#' + popup_id).modal('show')
    }
});

$(document).ready(function () {
    $('#modalButton').on('click', function () {
        $('#popupContent').hide();
        $('#afterClcikModal').show();
    });
});

/*Vaoucher js*/
$(document).ready(function () {
    //email
    $(".torightbookie_green").on("click", function () {
        if ($(".namemm").val() != '') {
            if ($(".emaill").val().indexOf('@') === -1) {
                $(".emaill").addClass("popup-highlight");
            } else {
                var requiestUsername = $(".namemm").val();
                if (typeof requiestUsername != 'undefined') {
                    requiestUsername = '&name=' + requiestUsername;
                } else {
                    requiestUsername = '';
                }
                $.ajax({
                    type: "POST",
                    data: "sendemail=mail" + requiestUsername + "&email=" + $(".emaill").val() + "&sendGutschein=yes",
                    url: "" + window.location.origin + "/wp-content/themes/mini-strap/custom/mymeta/popup/vouchers/" + operartor_voucher + "/load.php",
                    success: function (msg) {
                        $("#main-body").hide();
                        $(".sendalert").append(msg).show();
                    }
                });
            }
        } else {
            $(".namemm").addClass("popup-highlight");
        }
    });
    $(".namemm").on("keyup", function () {
        if ($(".namemm").val() == '') {
            $(".namemm").addClass("popup-highlight");
        } else {
            $(".namemm").removeClass("popup-highlight");
        }
    });
    $(".emaill").on("change", function () {
        if ($(".emaill").val().indexOf('@') === -1) {
            $(".emaill").addClass("popup-highlight");
        } else {
            $(".emaill").removeClass("popup-highlight");
        }
    });
});

$(document).ready(function () {
    $('.mews-itemTitle').on('click', function () {
        $('.mews-item').fadeIn();
    });
});

/*Stupid Random Icons*/
/*
 $(document).ready(function () {
 var iconsArray = [
 'glyphicon-euro color-green',
 'glyphicon-envelope color-blue',
 'glyphicon-heart color-orange',
 'glyphicon-star color-yellow',
 'glyphicon-check color-green',
 'glyphicon-ok-circle color-green',
 'glyphicon-exclamation-sign color-orange',
 'glyphicon-eye-open color-violet',
 'glyphicon-stats color-dark-green',
 'glyphicon-piggy-bank color-orange',
 'glyphicon-record color-red',
 'glyphicon-phone color-blue',
 'glyphicon-heart-empty color-red',
 'glyphicon-globe color-dark-green',
 'glyphicon-bell color-yellow',
 'glyphicon-gift color-violet',
 'glyphicon-ok-sign color-green',
 'glyphicon-map-marker color-red',
 'glyphicon-qrcode',
 'glyphicon-hourglass',
 'glyphicon-registration-mark'
 ];

 $("h4").each(function (i) {
 $(this).prepend('<span class="glyphicon ' + iconsArray[i] + ' marginRightGlyph"></span>');
 });
 });
 */
/*Go to internal nav*/
$(document).ready(function () {
    if ($("#inhaltsverzeichnis").length) {
        var internalNav = $("#inhaltsverzeichnis");
        internalNav.nextAll("h2:gt(0)").before("<span class='zumInhalt'>Zurück zum Inhaltsverzeichnis</span>");
        internalNav.nextAll("p").last().after("<span class='zumInhalt zumInhalt2'>Zurück zum Inhaltsverzeichnis</span>");

        var offsetHeight = 75;

        $('.zumInhalt').on('click', function (event) {
            var scrollPos = $('#inhaltsverzeichnis').offset().top - offsetHeight + 5;
            $('body,html').animate({
                scrollTop: scrollPos
            }, 500, function () {
            });
            return false;
        });
    }
});

/**
 * Created by Rangel on 5.7.2016 г..
 */
