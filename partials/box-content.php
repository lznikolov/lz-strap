<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 29.7.2016 г.
 * Time: 12:17
 */

$operator_colors = array(
    'casinoapps-iosapp' => array('color' => '454545', 'background' => 'eaebe6'),
    'casinoapps-androidapp' => array('color' => '454545', 'background' => '88be46'),
    'casinoapps-windowsphone' => array('color' => '454545', 'background' => '00bdf6'),
    'casinoapps-mobilewebsite' => array('color' => '454545', 'background' => 'f4f4f4'),
    'bonusturnovers-livecasino' => array('color' => 'fff', 'background' => '7b1212'),
    'softwareproviders-book_of_ra' => array('color' => 'fff', 'background' => 'e0a71d'),
    'softwareproviders-starburst_gonzo' => array('color' => 'fff', 'background' => '400e5c'),
    'softwareproviders-merkur' => array('color' => '454545', 'background' => 'ffd200'),
    'softwareproviders-novoline' => array('color' => '454545', 'background' => 'fd681f'),
    'softwareproviders-netent' => array('color' => '454545', 'background' => '478f00'),
    'bonusturnovers-liverouletteavailable' => array('color' => 'fff', 'background' => '400e5c'),
    'bonusturnovers-liveblackjackavailable' => array('color' => 'fff', 'background' => '161616')
)
?>
<style>
    #<?php echo $element_css_id;?> { margin :0 }
    #<?php echo $element_css_id;?> .topCasinoHeaderLogo {  height: 110px;  background: white url('/assets/images/operators-table/headers/<?php echo $element_css_id; ?>.png') no-repeat bottom left;  }
    #<?php echo $element_css_id;?> .page-header {  color: #<?php echo $operator_colors[$element_css_id]['color']; ?>;  font-size: 2rem;  border-bottom: none;  margin: 20px 0 15px;  }
    #<?php echo $element_css_id;?> .topCasinoContent {  background-color: #<?php echo $operator_colors[$element_css_id]['background'];?>;  }
    #<?php echo $element_css_id;?> .topCasinoContent .topCasino-header,
    #<?php echo $element_css_id;?> .topCasinoContent .topCasino {  border-left: 30px solid #<?php echo $operator_colors[$element_css_id]['background'];?>;  border-right: 30px solid #<?php echo $operator_colors[$element_css_id]['background'];?>;  }
    #<?php echo $element_css_id;?> .topCasinoContent .topCasino:last-child {  border-bottom: 30px solid #<?php echo $operator_colors[$element_css_id]['background'];?>;  }
</style>
<div class="row" id="<?php echo $element_css_id; ?>">
    <div class="col-xs-12">
        <div class="row topCasinoHeaderLogo">
            <div class="col-xs-12"></div>
        </div>
        <div class="row topCasinoContent">
            <div class="col-xs-12">
                <div class="page-header text-uppercase text-center"><strong>• <?php echo $header; ?> •</strong>
                </div>
            </div>
            <div class="col-xs-12 hidden-xs">
                <div class="row topCasino-header">
                    <div class="col-xs-3 text-center"><strong><?php echo __('Provider', 'mini-strap'); ?></strong>
                    </div>
                    <div class="col-xs-2 text-center"><strong><?php echo __('Max.Bonus', 'mini-strap'); ?></strong>
                    </div>
                    <div class="col-xs-2 text-center">
                        <strong><?php echo __('No Deposit Bonus', 'mini-strap'); ?></strong></div>
                    <div class="col-xs-2 text-center">
                        <strong><?php echo __('Payout ratio', 'mini-strap'); ?></strong></div>
                    <div class="col-xs-3 text-center"><strong><?php echo __('Go to', 'mini-strap'); ?></strong>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <?php
                foreach ($options as $operator => $value) { ?>
                    <div class="row topCasino">
                        <div class="col-xs-12">
                            <div class="row topCasino-content">
                                <div class="col-md-3 col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-1 col-md-2">
                                            <div class="text-center"><?php echo $value['rating']; ?></div>
                                        </div>
                                        <div class="col-xs-12 col-md-10">
                                            <a href="<?php echo operatorPageURL($operator, 'normal', 'box-logo-' . $element_css_id); ?>"
                                               rel="nofollow" target="_blank">
                                                <img
                                                    src="<?php echo operatorImagePath($operator); ?>"
                                                    alt="<?php echo $operator ?>" class="img-responsive"
                                                    style="margin: 0 auto;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-4 text-center">
                                    <strong><?php echo $value['amountCurrency']; ?></strong></div>
                                <div
                                    class="col-md-2 col-xs-4 text-center"><?php echo !empty($value['noDepositBonus']) ? $value['noDepositBonus'] : '&mdash;'; ?></div>
                                <div class="col-md-2 col-xs-4 text-center"><?php echo $value['payout']; ?>%</div>
                                <div class="col-md-3 col-xs-12 text-center">
                                    <div class="hvr-wobble-vertical">
                                        <a href="<?php echo operatorPageURL($operator, 'normal', 'box-download-button' . $element_css_id); ?>"
                                           rel="nofollow" target="_blank"
                                           class="btn btn-block text-uppercase">
                                            <strong><?php echo _x('app-download', 'button', 'mini-strap'); ?></strong>
                                        </a>
                                    </div>
                                    <div class="text-capitalize"><a
                                            href="<?php echo operatorPageURL($operator, '', 'box-download-link' . $element_css_id); ?>"
                                            rel="nofollow" target="_blank"><?php echo $operator; ?>
                                            App</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

