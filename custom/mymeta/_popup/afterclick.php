<div class="modal-content" style="display:none !important;" id="afterClcikModal">
    <div class="modal-header">
        <div class="col-sm-12">
            <div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span>Haben Ihnen die <?php echo $popupOperator;?> Freispiele gefallen?</span></h4>
            </div>
        </div>
    </div>

    <div class="modal-body">
        <div class="popup-afterClick">
            <div class="popup-facebookLikeArea">
                <div class="popup-facebookLikeArea-popup-facebookLikeArea-subehading">
                    Folgen Sie uns auf Facebook und verpassen Sie keine spannenden
                    <?php echo $GLOBALS['siteNameString'];?>
                    mehr
                </div>
                <div class="popup-facebooklikebutton">
                    <div class="fb-page" data-href="<?php echo $GLOBALS['facebookPageUrl']?>" data-width="280" data-height="130" data-hide-cover="false" data-show-facepile="false" data-show-posts="false">
                        <div class="fb-xfbml-parse-ignore">
                            <blockquote cite="<?php echo $GLOBALS['facebookPageUrl']?>">
                                <a href="<?php echo $GLOBALS['facebookPageUrl']?>">
                                    <?php echo $_SERVER['HTTP_HOST']?>
                                </a>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <div class="coins"></div>
        </div>
    </div>

    <?php include('wp-content/themes/mini-strap/custom/newsletter.php'); ?>
</div>