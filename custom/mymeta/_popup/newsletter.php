<style type="text/css">
    .popup-hiddenButton {
        position: absolute;
        left: -5000px;
    }
</style>
<div class="row">
    <div class="newsletterPopup">
        <div class="newsletterSitePopup">
            Jetzt <?php echo $GLOBALS['siteUrlString']?>
        </div>
        <div class="newsletterText1">
            Newsletter abonnieren!
        </div>
        <form action="<?php echo $GLOBALS['newsletterAction']?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
                <div class="mc-field-group container relativeContainer" style="">
                    <div class="col-xs-12 text-center"><input type="email" value="" name="EMAIL" class="required email ctaEmail" id="mce-EMAIL" placeholder="Email Adresse"></div>
                    <div class="col-xs-12 text-center"><input type="submit" class="emailCTAButt hvr-wobble-horizontal" value="Jetzt Abonnieren" name="subscribe" id="mc-embedded-subscribe"></div>
                </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>
                <div class="popup-hiddenButton"><input type="text" name="b_3d3d0710a75221f05e6b9cd3e_46664999b3" tabindex="-1" value=""></div>
            </div>
        </form>

        <?php if(!empty($GLOBALS['newsletterClicks'])){ ?>
            <div class="newslnumbers"><?php echo $GLOBALS['newsletterClicks'];?> Besucher haben den Bonus Newsletter abonniert</div>
        <?php } ?>

    </div>
</div>

