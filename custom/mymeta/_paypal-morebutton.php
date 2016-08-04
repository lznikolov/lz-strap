<a href="#" id="morebutton-paypal"><span id="ripple" class="centered"><span class="circle"></span><span class="circle"></span><span class="circle"></span></span><span class="b"><span>ALLE PAYPAL CASINOS ANZEIGEN</span><span class="arrow"></span></span></a>
<div class="result_pt"></div>
<style>
    #morebutton-paypal {
        background: url(/wp-content/plugins/My-Meta-Box-master/customs/images/morebbg.png) center center no-repeat;
        max-height: 90px;
        width: 100%;
        display: block;
        text-align: center;
        position: relative;
        float: left;
        height: 90px;overflow: hidden; margin-bottom: 30px;
    }
    #morebutton-paypal .b {
        margin: 0 auto;
        max-width: 180px;
        display: block;
        margin-top: 18px;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 12px;
        color: #0B3C1F;
        padding-left: 10px;z-index: 5; position: relative;
    }
    #morebutton-paypal .b span {
        display: block;
        -webkit-animation: blipblop 4s infinite linear;
        -moz-animation: blipblop 4s infinite linear;
        -webkit-animation-fill-mode: both;
        font-size: 11px;
        line-height: 11px;
        font-weight: 600;
        max-width: 160px;
        margin: 0 auto;
    }
    #morebutton-paypal .b:hover {
    /*-webkit-animation: blipblop 1s linear;*/
        /*-webkit-animation-fill-mode: both;*/
    }
    #morebutton-paypal .b:hover .arrow {
        /*-webkit-animation: blipblopar 2s linear;*/
        /*-webkit-animation-fill-mode: both;*/
    }
    #morebutton-paypal .b .arrow {
        background: url(/wp-content/plugins/My-Meta-Box-master/customs/images/arrowdown1orange.png) center center no-repeat;
        height: 42px; width: 67px; margin: 0 auto;
        -webkit-animation: blipblopar 4s infinite linear;
        -moz-animation: blipblopar 4s infinite linear;
        -webkit-animation-fill-mode: both;
    }
    .centered {
        position: absolute;
        top: 0%;
        left: 0%;
    }
    #ripple {
        color: #aaa;
        width: 100%;
        height: 100px;
        margin-left: -66px;
        margin-top: -26px;
        float: left; z-index: 3;
    }
    .circle {
        position: absolute;
        height: 100px;
        width: 100px;
        border: 20px solid rgba(13, 65, 33, 0.3);
        border-radius: 100px;
        animation: wave 7s infinite linear;
        animation-fill-mode: both;
        -webkit-animation: wave 7s infinite linear;
        -webkit-animation-fill-mode: both;
    }
    .circle:nth-child(2) {
        animation-delay: 1.66s;
    }
    .circle:nth-child(3) {
        animation-delay: 3.33s;
    }
    /* stays on full alpha from 50 to 75 */
    @keyframes wave {
        0% {
            transform: scale(0);
            opacity: 0.0;
        }
        25% {
            opacity: 0.0;
        }
        50% {
            opacity: 0.1;
        }
        75% {
            opacity: 0.5;
        }
        100% {
            transform: scale(2.5);
            opacity: 0.0;
        }
    }
    @-webkit-keyframes wave {
        0% {
            -webkit-transform: scale(0);
            opacity: 0.0;
        }
        25% {
            opacity: 0.0;
        }
        50% {
            opacity: 0.1;
            -webkit-filter: blur(0px); -moz-filter: blur(0px); -o-filter: blur(0px); -ms-filter: blur(0px); filter: blur(0px);
        }
        75% {
            opacity: 0.5;
        }
        100% {
            -webkit-transform: scale(2.5);
            opacity: 0.0;
            -webkit-filter: blur(1px); -moz-filter: blur(1px); -o-filter: blur(1px); -ms-filter: blur(1px); filter: blur(1px);
        }
    }
    @keyframes blipblop {
        0% {
            transform: scale(1);
        }
        8% {
            transform: scale(1.2);
        }
        25% {
            transform: scale(1);
        }
        100% {
            transform: scale(1);
        }
    }
    @-webkit-keyframes blipblop {
        0% {
            -webkit-transform: scale(1);
        }
        8% {
            -webkit-transform: scale(1.2);
        }
        25% {
            -webkit-transform: scale(1);
        }
        100% {
            -webkit-transform: scale(1);
        }
    }
    @-moz-keyframes blipblop {
        0% {
            -moz-transform: scale(1);
        }
        8% {
            -moz-transform: scale(1.2);
        }
        25% {
            -moz-transform: scale(1);
        }
        100% {
            -moz-transform: scale(1);
        }
    }
    @keyframes blipblopar {
        0% {
            margin-top: 0px;
        }
        10% {
            margin-top: 8px;
        }
        45% {
            margin-top: 0px;
        }
    }
    @-webkit-keyframes blipblopar {
        0% {
            margin-top: 0px;
        }
        10% {
            margin-top: 8px;
        }
        45% {
            margin-top: 0px;
        }
    }
    @-moz-keyframes blipblopar {
        0% {
            margin-top: 0px;
        }
        10% {
            margin-top: 8px;
        }
        45% {
            margin-top: 0px;
        }
    }
</style>

<?php ob_start(); ?><script>
	jQuery(document).ready(function($){
		jQuery("#morebutton-paypal").off();
	    jQuery("#morebutton-paypal").on("click",function(e){
	        e.preventDefault();
	        jQuery("#morebutton-paypal").slideUp(1000);
            jQuery.get( <?php echo $_SERVER["DOCUMENT_ROOT"] . "/wp-content/themes/mini-strap/custom/mymeta/paypal-short.php?type=".$GLOBALS['raitingType']?>, function( data ) {
	            jQuery( ".result_pt" ).html( data );
	        });
	    });
    });
</script><?php $GLOBALS['custom'][] = ob_get_clean(); ?>