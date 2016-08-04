<?php
if(isset($_GET['b'])) {
    $popupBonID = $_GET['b'];
    $popupOperID = $_GET['opid'];

    require_once('wp-content/themes/mini-strap/custom/mymeta/bonus-boxes-settings.php');

    $operShortnameOrID = $popupOperID;
    $bonusType = '';
    $bonusReplace = '';
    $unsetBonusCheck = '';
    $unsetStandartCheck = '';
    $bonusLimit = '';

    $popupBonuses = getBonuses($operShortnameOrID, $bonusType, $bonusReplace, $unsetBonusCheck, $unsetStandartCheck, $bonusLimit);

    foreach ($popupBonuses as $operator => $bonus) {
        foreach ($bonus as $bonusName => $options) {
            if ($options['bonusID'] == $popupBonID) {
                $popupOperator = $operator;
                $popupBonuscode = $options['bonuscode'];

                if (($popupBonuscode == '') || ($popupBonuscode == 'Kein Bonuscode')) {
                    $popupBonuscode = 'Aktuell kein Bonuscode notwendig!';
                }

                if (($bonusName == 'No-Deposit Fake') || ($bonusName == 'Free-Spins Fake')) {

                    /*NO DEPOSIT FAKE POPUP*/
                    $popupDescription = 'Aktuell ist der '.ucfirst($operator).' Wettgutschein ohne Einzahlung leider vergriffen. Bitte abonnieren Sie kostenlos den '.$GLOBALS['siteUrlString'].' Newsletter um immer aktuelle News über den '.ucfirst($operator).' Gutschein und alle weiteren kostenlosen Wettgutscheine zu erhalten, damit Sie keine Aktion mehr verpassen. Sehen Sie in der Übersicht unten alle aktuellen Gutscheine ohne Einzahlung.';

                    foreach ($labels as $label_key => $label_text) {
                        if($label_key == $bonusName){
                            $popupFirstTitle = $popupOperator.' '.$label_text;
                        }
                    }

                    echo '
                    <div id="'.$popupBonID.'" class="modal fade in" role="dialog">
                        <div class="modal-dialog modal-bonuses">
                            <div class="modal-content" id="popupContent">
                                <div class="modal-header">
                                    <div class="col-sm-12">
                                        <div>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4><span>'.$popupFirstTitle.'</span></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-12 nodeposit">
                                            <img src="/assets/images/logos_105x53/'.strip4url($popupOperator).'_105x53.png" style="opacity: 0.4; margin-bottom: 20px;">
                                            <div style="position: absolute; left: 70px; top: 0; width:105px; height:53px;">
                                                <img src="/wp-content/plugins/My-Meta-Box-master/customs/images/abgelaufen.png" style="position: relative; left: -50%;" />
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-xs-12">
                                            <div class="modal-description">'.SecondLevelCharConverting(EncodeSpecialCharacters($popupDescription)).'</div>
                                        </div>

                                        <div class="col-xs-12 text-center modal-bonuscode" style="padding-top: 10px;"></div>

                                        <div class="col-xs-12 text-center">
                                            <a href="' . getGoUrl($popupOperator, 1) . '" rel="nofollow" target="_blank" id="modalButton">
                                                <div class="boxes-boxButton2 buttons-orangeGrad hvr-wobble-horizontal popup">
                                                    WEITER ZU '.$popupOperator.'
                                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>';

                                include('wp-content/themes/mini-strap/custom/newsletter.php');
                                include('freebetlist.php');
                                echo '
                            </div>';
                            include('afterclick.php'); echo '
                        </div>
                    </div>';
                }
                else {

                    /*NORMAL POPUP*/
                    $popupDescription = $options['description'];

                    foreach ($labels as $label_key => $label_text) {
                        if($label_key == $bonusName){
                            $popupTitle = $popupOperator.' '.$label_text;
                        }
                    }

                    if ($popupBonuscode != 'Aktuell kein Bonuscode notwendig!') {
                        $popupFinalBonuscode = '
                            <span>BONUSCODE: </span>
                            <input type="text" value="'.$popupBonuscode.'">
                        ';
                    }
                    else {
                        $popupFinalBonuscode = '
                            <span>'.$popupBonuscode.'</span>
                        ';
                    }

                    if (($bonusName == 'No-Deposit') && (in_array(strip4url($popupOperator), $GLOBALS['vouchers']))) {
                        echo '
                            <div id="'.$popupBonID.'" class="modal fade in" role="dialog">';
                                        include("vouchers/".strip4url($popupOperator)."/load.php"); echo '
                            </div>';
                    }
                    else {
                        echo '
                        <div id="'.$popupBonID.'" class="modal fade in" role="dialog">
                            <div class="modal-dialog modal-bonuses">
                                <div class="modal-content" id="popupContent">
                                    <div class="modal-header">
                                        <div class="col-sm-12">
                                            <div>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4><span>'.$popupOperator.' Gutschein</span></h4>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-12 nodeposit">
                                                <a class="popup-img" target="_blank" rel="nofollow" href="' . getGoUrl($popupOperator, 1) . '">
                                                    <img src="/assets/images/logos_105x53/'.strip4url($popupOperator).'_105x53.png">
                                                </a>
                                            </div>
                                            <div class="col-md-9 col-xs-12">
                                                <div class="modal-title">'.$popupTitle.'</div>
                                                <div class="modal-description">'.SecondLevelCharConverting(EncodeSpecialCharacters($popupDescription)).'</div>
                                            </div>
    
    
                                            <div class="col-xs-12 text-center modal-bonuscode">
                                                '.$popupFinalBonuscode.'
                                            </div>
    
                                            <div class="col-xs-12 text-center">
                                                <a href="' . getGoUrl($popupOperator, 1) . '" rel="nofollow" target="_blank" id="modalButton">
                                                    <div class="boxes-boxButton2 buttons-orangeGrad hvr-wobble-horizontal popup">
                                                        WEITER ZU '.$popupOperator.'
                                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>';

                            include('wp-content/themes/mini-strap/custom/newsletter.php');
                            echo '
                                </div>';
                            include('afterclick.php'); echo '
                            </div>
                        </div>';
                    }
                }
            }
        }
    }
}