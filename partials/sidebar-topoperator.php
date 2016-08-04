<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 29.7.2016 г.
 * Time: 11:37
 */
?>
<div <?= !empty($instance['unique_element_id']) ? 'id="' . $instance['unique_element_id'] . '-sidebar"' : ''; ?>
    class="col-xs-12" lang="<?php echo substr(get_locale(), 0, 2); ?>">
    <!--HEADER-->
    <div class="row">
        <div class="col-xs-12"
            <?= !empty($instance['unique_element_id']) ? 'id="' . $instance['unique_element_id'] . '-sidebar-header"' : ''; ?>>
            <div class="row">
                <div class="col-xs-12 operatorHeaderImg">
                    <div class="left-img"></div>
                    <div class="right-img"></div>
                </div>
                <div class="col-xs-12 operatorHeaderTitle">
                    <?php
                    if (!empty($instance['title'])) {
                        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--OPERATOR BOXES-->
    <div class="row">
        <div class="col-xs-12 operatorRow">
            <?php
            $_operShortnameOrID = $instance['operShortnameOrID'];
            $_bonusType = '';
            $_bonusReplace = $instance['bonusReplace'];
            $_unsetBonusCheck = $instance['unsetBonusCheck'];
            $_unsetStandartCheck = $instance['unsetStandartCheck'];
            $_bonusLimit = '';
            $_useBonusGroup = $instance['useBonusGroup'];
            $_useShortname = $instance['useShortname'];
            $_unsetSetTypeCheck = $instance['unsetSetTypeCheck'];
            /* Wikame wsichki elementi ot $bonuses i sled towa tyrsiqm v tqh elementite, koito  sydyrjat dadeniqt parametyr.
            Problemyt e tam,che elementite ne sa sortirani i ako izvikame pyrvite 3 ste se okaje taka,che ot tiq 3 elementa ste e
            samo edin, koito ste izpylni uslovieto, a obsto da sa primerno 5, koito izpylnqwat uslovieto.
            */
            $bonuses = getBonuses($_operShortnameOrID, $_bonusType, $_bonusReplace, $_unsetBonusCheck, $_unsetStandartCheck, $_bonusLimit, $_useBonusGroup, $_useShortname, $_unsetSetTypeCheck);
            $appArray = array();
            $bonusType = $instance['bonusType'];
            $mobileOS = $instance['mobileOS']; //iosapp, androidapp, mobilewebsite, windowsphone

            //remove casino at the end ot the string and then remove white spaces and dashes
            //ex: mr green -> mrgreen
            // intercasino -> inter
            // bet-at-home casino -> betathome
            //so we can match the filename structure of the images
            $search_for = array("/casino$/i", "/[\\s-]+/");
            $replacement_with = array("", "");


            foreach ($bonuses as $operator => $bonus) {
                if ($bonus[$bonusType][$mobileOS] == "yes") {
                    $appArray[$operator] = $bonus;
                }
            }

            $bonusLimit = $instance['bonusLimit'];
            $appArray = array_slice($appArray, 0, $bonusLimit);
            foreach ($appArray as $operator => $bonus) {
                $rating = $bonus['Standard']['10rating'];
                $operatorLogoName = strtolower(preg_replace($search_for, $replacement_with, $operator));
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <hr>
                    </div>
                </div>
                <div class="row hvr-wobble-vertical">
                    <div class="col-xs-6">
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="<?php echo operatorPageURL($operator, '', 'sitebar-logo-' . $instance['unique_element_id']); ?>">
                                    <img
                                        src="/assets/images/logos-105x53/casino/<?php echo $operatorLogoName; ?>.png"
                                        alt="<?php echo $operator; ?>" class="img-responsive" style="width: 75%">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3 col-sm-2 col-md-3">
                                <img
                                    src="<?php echo !empty($instance['unique_element_id']) ? '/assets/images/sidebar/' . $instance['unique_element_id'] . '-sidebar-logo.png' : ''; ?>"
                                    alt="<?php echo !empty($instance['unique_element_id']) ? $instance['unique_element_id'] . '-logo' : ''; ?>">
                            </div>
                            <div class="col-xs-9 col-sm-10 col-md-9 points">
                                <strong><span><?php echo __('Rating', 'mini-strap') ?>:</span>
                                    <span><?php echo $rating; ?></span></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="download_button sidebar-dlBtn-mobile text-center text-uppercase">
                            <a href="<?php echo operatorPageURL($operator, 'normal', 'sitebar-download-' . $instance['unique_element_id']); ?>"
                               rel="nofollow" target="_blank">
                                <img
                                    src="<?php echo !empty($instance['unique_element_id']) ? '/assets/images/sidebar/' . $instance['unique_element_id'] . '-download-button.png' : ''; ?>"
                                    alt="App Download" class="img-responsive">
                                <strong><?php echo _x('app-download', 'sidebar', 'mini-strap'); ?></strong>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
