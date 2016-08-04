<?php
$bonuses = getBonuses($operShortnameOrID = '', $bonusType = '', $bonusReplace = '', $unsetBonusCheck = '', $unsetStandartCheck = '', $bonusLimit = '', $useBonusGroup = '', $useShortname = '', $unsetSetTypeCheck = '');
$current_operator = get_post_meta($post->ID, 'llbz_operator', true);
$appOperator = array();

foreach ($bonuses as $operator => $bonus) {
    if ($operator == $current_operator) {

        $isExclusive = false;
        if (isset($bonus['Exclusive']) && is_array($bonus['Exclusive'])) {
            $amountType = 'Exclusive';
            $isExclusive = true;
        } else {
            $amountType = 'Standard';
        }

        $amount = $bonus[$amountType]['amount'];
        $maxAmount = 0;
        foreach ($amount as $currency => $money) {
            if (!empty($money)) {
                switch ($currency) {
                    case "gbp":
                        if (is_numeric($money)) {
                            $maxAmount = $money . "&pound;";
                        } else {
                            $maxAmount = $money;
                        }
                        break;
                    case "eur":
                        if (is_numeric($money)) {
                            $maxAmount = $money . "&euro;";
                        } else {
                            $maxAmount = $money;
                        }
                        break;
                    case "usd":
                        if (is_numeric($money)) {
                            $maxAmount = $money . "$";
                        } else {
                            $maxAmount = $money;
                        }
                        break;
                    default:
                        $maxAmount = "NO CURRENCY";
                }
            }
        }
        $appOperator['maxBonus'] = $maxAmount;
        $appOperator['os']['mobile'] = $bonus['Casino Apps']['mobilewebsite'];
        $appOperator['os']['windows'] = $bonus['Casino Apps']['windowsphone'];
        $appOperator['os']['ios'] = $bonus['Casino Apps']['iosapp'];
        $appOperator['os']['android'] = $bonus['Casino Apps']['androidapp'];
        break;
    }


} ?>
<style>
    #operator-apps-cta {
        background: #021c02 url('/assets/images/operator_apps_table/operator-backgrounds/<?php echo operatorEscapeName3($current_operator); ?>.png') no-repeat;
    }
    #operator-apps-cta-phone {
        background: transparent url("/assets/images/operator_apps_table/phone.png") no-repeat scroll -55px -10px / 81% auto;
        border-radius: 5px;
    }
    @media only screen and (max-width : 419px) {
        #operator-apps-cta-phone {
            background:transparent;
        }
    }

</style>
<div class="row" id="operator-apps-cta">
    <div class="col-xs-12" id="operator-apps-cta-phone">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-sm-offset-2 text-uppercase" id="operator-apps-os">
                <?php foreach ($appOperator['os'] as $key => $value) { ?>
                    <a href="<?php
                    switch ($key){
                       case "windows" : echo site_url('windows-phone');break;
                       case "mobile" : echo site_url();break;
                        default : echo site_url($key);
                    }
                    ?>" rel="help" target="_self">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-left"><img src="/assets/images/operator_apps_table/os_<?php echo $key; ?>.png"
                                                        alt="<?php echo $key; ?>">
                                <strong><?php echo $key; ?></strong></div>
                            <div class="pull-right">
                                <img
                                    src="/assets/images/operator_apps_table/os_<?php echo $value; ?>.png"
                                    alt="<?php echo $key; ?> support">
                            </div>
                        </div>
                    </div>
                    </a>
                <?php } ?>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img class="img-responsive" id="operator-apps-logo" style="width: 80%;"
                             src="<?php echo operatorImagePath($current_operator); ?>"
                             alt="<?php echo $current_operator; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center text-uppercase">
                        <div id="operator-apps-bonus">
                            <strong><?php echo $appOperator['maxBonus']; ?> bonus</strong>
                        </div>
                        <img src="/assets/images/operator_apps_table/operator-apps-cta-shield.png"
                             alt="op shield bonus" id="operator-apps-shield">
                        <div id="operator-apps-shield-arrow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-sm-offset-1">
                <div class="row">
                    <div class="col-xs-12 text-uppercase text-center"
                         id="operator-apps-download-button">
                        <a href="<?php echo operatorPageURL($current_operator, 'normal', 'phone-download-button'); ?>" title="Download Casino App" rel="nofollow" target="_blank">
                            <img src="/assets/images/operator_apps_table/operator-apps-cta-download.png" alt="download app"
                                 class="img-responsive" style="margin: 0 auto;">
                            <div><strong>Download <?php echo $current_operator; ?> App</strong></div>
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="<?php echo operatorPageURL($current_operator, 'normal', 'phone-ios'); ?>" title="Download Casino App" rel="nofollow" target="_blank">
                            <img src="/assets/images/operator_apps_table/operator-apps-cta-appstore.png"
                                 class="img-responsive" alt="download appstore">
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="<?php echo operatorPageURL($current_operator, 'normal', 'phone-android'); ?>" title="Download Casino App" rel="nofollow" target="_blank">
                            <img src="/assets/images/operator_apps_table/operator-apps-cta-googleplay.png"
                                 class="img-responsive" alt="download googleplay">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>