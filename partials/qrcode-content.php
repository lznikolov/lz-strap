<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 29.7.2016 г.
 * Time: 13:56
 */
?>
<div class="row operator_download" style="clear: both">
    <div class="col-md-4 hidden-xs hidden-sm"><hr></div>
    <div class="col-md-3 hidden-xs hidden-sm">
        <img
            src="<?php echo site_url() . '/assets/phpqrcode/qrgen.php?operator=' .  operatorPageURL($a['operator'], 'normal', 'qr-code'); ?>"
            alt="qrcode" class="img-responsive" style="image-rendering: auto;image-rendering: crisp-edges;image-rendering: pixelated;">
    </div>
    <div class="col-md-5 col-xs-12">
        <div class="hvr-wobble-vertical hidden-xs">
            <a href="<?php echo operatorPageURL($a['operator'], 'normal', 'qr-download-button'); ?>" class="btn btn-block" target="_blank" rel="nofollow">
                <strong class="text-uppercase"><?php echo _x('app-download', 'button', 'mini-strap');?></strong> <img src="/assets/images/download-button-rectangle.png" alt="download_button">
            </a>
        </div>
        <div class="visible-xs-block">
            <a href="<?php echo operatorPageURL($a['operator'], 'normal', 'qr-download-button-xs'); ?>" class="btn btn-block" rel="nofollow" target="_blank">
                <strong class="text-uppercase"><?php echo _x('app-download-xs', 'button', 'mini-strap');?></strong> <img src="/assets/images/download-button-rectangle.png" alt="download_button">
            </a>
        </div>
    </div>
</div>
