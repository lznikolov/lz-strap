<?php
$t_name = 'wettbonus';

$operShortnameOrID = '';
$bonusType = 'Casino Apps';
$bonusReplace = '';
$unsetBonusCheck = '';
$unsetStandartCheck = '';
$bonusLimit = '';

$bonuses = getBonuses($operShortnameOrID, $bonusType, $bonusReplace, $unsetBonusCheck, $unsetStandartCheck, $bonusLimit);
?>
<!--TABLE CONTAINER-->
<div class="tableHome-bonusRows" id="<?= $t_name; ?>">
    <div class="container relativeContainer tableHome-sorting">
        <!--TABLE HEADER-->
        <div class="row" id="table_header">
            <div class="col-sm-2 tableHome-topLabel hidden-xs text-center">
                <div class="vertical-align">Wettanbieter</div>
            </div>
            <div class="col-sm-1 tableHome-topLabel hidden-xs text-center cursored tableHome-sorter"
                 data-checker="Sorter1">
                <div class="vertical-align">Maximaler<br> Wert <span class="glyphicon glyphicon-sort"></span></div>
            </div>
            <div class="col-sm-1 tableHome-topLabel hidden-xs text-center cursored tableHome-sorter"
                 data-checker="Sorter2">
                <div class="vertical-align">Prozent <br><span class="glyphicon glyphicon-sort"></span></div>
            </div>
            <div class="col-sm-1 tableHome-topLabel hidden-xs text-center cursored tableHome-sorter"
                 data-checker="Sorter4">
                <div class="vertical-align">Gutschein<br> ohne <span class="glyphicon glyphicon-sort"></span><br>
                    Einzahlung
                </div>
            </div>
            <div class="col-sm-2 tableHome-topLabel hidden-xs text-center cursored tableHome-sorter"
                 data-checker="Sorter5">
                <div class="vertical-align">Umsatz <br><span class="glyphicon glyphicon-sort"></span></div>
            </div>
            <div class="col-sm-1 tableHome-topLabel hidden-xs text-center cursored tableHome-sorter"
                 data-checker="Sorter3" data-sorting="string">
                <div class="vertical-align">Bonuscode <br> <span class="glyphicon glyphicon-sort"></span></div>
            </div>
            <div class="col-sm-1 tableHome-topLabel hidden-xs text-center cursored tableHome-sorter"
                 data-checker="Sorter0">
                <div class="vertical-align">Rating<br> <span class="glyphicon glyphicon-sort"></span></div>
            </div>
            <div class="col-sm-3 tableHome-topLabel hidden-xs text-center">
                <div class="vertical-align">Zum Anbieter</div>
            </div>
        </div><!--END TABLE HEADER-->
        <?php
        $count = 0;

        foreach ($bonuses as $operator => $bonus){
        foreach ($bonus as $bonusName => $options){
        $count++;
        $noDeposit = $GLOBALS['bonusArray'][$operator]['No-Deposit']['amount'];
        if ($noDeposit['usd'] != '') {
            $noDepositAmounts = EncodeSpecialCharacters($noDeposit['usd']);
            $noDepositAmountsSign = '$';
            $tmpthisnoDepositClass = 'ctaTableHighlight';
        }
        if ($noDeposit['eur'] != '') {
            $noDepositAmounts = EncodeSpecialCharacters($noDeposit['eur']);
            $noDepositAmountsSign = '€';
            $tmpthisnoDepositClass = 'ctaTableHighlight';
        }
        if ($noDeposit['gbp'] != '') {
            $noDepositAmounts = EncodeSpecialCharacters($noDeposit['gbp']);
            $noDepositAmountsSign = '£';
            $tmpthisnoDepositClass = 'ctaTableHighlight';
        }
        if (!is_numeric($noDepositAmounts)) {
            $noDepositAmounts = '';
        }

        $bewertung = number_format((float)EncodeSpecialCharacters($options['10rating']), 1, '.', '');

        $first = $options['amount'];
        if ($first['usd'] != '') {
            $firstAmounts = EncodeSpecialCharacters($first['usd']);
            $firstAmountsSign = '$';
        }
        if ($first['eur'] != '') {
            $firstAmounts = EncodeSpecialCharacters($first['eur']);
            $firstAmountsSign = '€';
        }
        if ($first['gbp'] != '') {
            $firstAmounts = EncodeSpecialCharacters($first['gbp']);
            $firstAmountsSign = '£';
        }
        if (!is_numeric($firstAmounts)) {
            $firstAmounts = 0;
        }

        $prozent = $options['percentage'];
        if (!is_numeric($prozent)) {
            $paramPerzent = 'Kein Bonus';
            $perzVar = '';
        } else {
            $paramPerzent = EncodeSpecialCharacters($prozent);
            if ($prozent != '') {
                $perzVar = '%';
            } else {
                $perzVar = '';
            }
        }

        $umzats = $GLOBALS['bonusArray'][$operator]['Standard']['turnover'] . ' x ' . $GLOBALS['bonusArray'][$operator]['Standard']['turnovertype'];

        if ($options['bonuscode'] == 'Aktuell kein Bonuscode notwendig!') {
            $bonuscode = 'Kein Code nötig';
        } else {
            $bonuscode = $options['bonuscode'];
        }
        if ($count == 1) {
            $showLabelsBigTable = 'xs-show';
            $borderTopBigTable = 'tableHome-bottomRow';
            $borderTopBigTable2 = 'xs-hide-borderTop';
        } else {
            $showLabelsBigTable = 'xs-show';
            $borderTopBigTable = 'tableHome-bottomRow';
            $borderTopBigTable2 = 'xs-hide-borderTop';
        }
        if ($count > 10) {
            $hideTableElements = 'hidden';
        } else {
            $hideTableElements = '';
        }
        if ($firstAmounts != '') {
        if ($bonusName != 'Exclusive') { ?>

        <!--TABLE ROW-->
        <div class="row divBox <?= $hideTableElements ?>">
            <?php } else { ?>
            <!--TABLE ROW EXCLUSIVE-->
            <div class="row divBox exclusive <?= $hideTableElements ?>">
                <div class="col-xs-12 exclusiveRow" <?= $hideTableElements ?>>Exklusiver Bonus
                    von <?= $GLOBALS['siteUrlString'] ?></div>
                <?php } ?>
                <!--LOGO-->
                <div class="col-xs-12 col-sm-2 <?= $borderTopBigTable . ' ' . $borderTopBigTable2 ?>">
                    <div class="tableHome-bottomLabel hidden-xs hidden-lg <?= $showLabelsBigTable ?>">
                        <div class="tbl_sortable vertical-align">Wettanbieter</div>
                    </div>
                    <div class="tableHome-logo">
                        <a href="<?= getGoUrl($operator, 1) ?>" target="_blank" rel="nofollow">
                            <img
                                src="/assets/images/logos_105x53/<?= strip4url($operator) ?>_105x53.png"
                                alt="<?= $operator ?>" class="img-responsive">
                        </a>
                    </div>
                </div>
                <!--FIRSTBONUS-->
                <div class="col-xs-4 col-sm-1 <?= $borderTopBigTable ?>">
                    <div class="tableHome-bottomLabel <?= $showLabelsBigTable ?> tableHome-sorter hidden-lg"
                         data-checker="Sorter1">
                        <div class="vertical-align">
                            Maximaler<br> Wert <span class="glyphicon glyphicon-sort"></span>
                        </div>
                    </div>
                    <div class="tableHome-infoWrapper">
                        <div class="vertical-align">
                            <span class="Sorter1" data-secondary="<?= $bewertung ?>"><?= $firstAmounts ?></span>
                            <span><?= $firstAmountsSign ?></span>
                        </div>
                    </div>
                </div>
                <!--PERCENTAGE-->
                <div class="col-xs-4 col-sm-1 <?= $borderTopBigTable ?>">
                    <div class="tableHome-bottomLabel <?= $showLabelsBigTable ?> tableHome-sorter hidden-lg"
                         data-checker="Sorter2">
                        <div class="vertical-align">
                            Prozent <br><span class="glyphicon glyphicon-sort"></span>
                        </div>
                    </div>
                    <div class="tableHome-infoWrapper">
                        <div class="vertical-align">
                            <span class="Sorter2" data-secondary="<?= $bewertung ?>"><?= $paramPerzent ?></span>
                            <span><?= $perzVar ?></span>
                        </div>
                    </div>
                </div>
                <!--NO DEPOSIT-->
                <div class="col-xs-3 col-sm-1 <?= $borderTopBigTable ?>">
                    <div class="tableHome-bottomLabel <?= $showLabelsBigTable ?> tableHome-sorter hidden-lg"
                         data-checker="Sorter4">
                        <div class="vertical-align">
                            Gutschein<br> ohne <span class="glyphicon glyphicon-sort"></span><br> Einzahlung
                        </div>
                    </div>
                    <div class="tableHome-infoWrapper <?= $tmpthisnoDepositClass ?>">
                        <div class="vertical-align">
                            <span class="Sorter4" data-secondary="<?= $bewertung ?>"><?= $noDepositAmounts ?></span>
                            <span><?= $noDepositAmountsSign ?></span>
                        </div>
                    </div>
                </div>
                <!--UMSATZ-->
                <div class="col-xs-3 col-sm-2 hidden-xs <?= $borderTopBigTable ?>">
                    <div class="tableHome-bottomLabel <?= $showLabelsBigTable ?> tableHome-sorter hidden-lg"
                         data-checker="Sorter5">
                        <div class="vertical-align">Umsatz</div>
                    </div>
                    <div class="tableHome-infoWrapper">
                        <div class="vertical-align">
                            <span class="Sorter5" data-secondary="<?= $bewertung ?>"><?= $umzats ?></span>
                        </div>
                    </div>
                </div>
                <!--BONUS CODE-->
                <div class="col-xs-3 col-sm-1 <?= $borderTopBigTable ?>">
                    <div class="tableHome-bottomLabel <?= $showLabelsBigTable ?> tableHome-sorter hidden-lg"
                         data-checker="Sorter3" data-sorting="string">
                        <div class="vertical-align">
                            Bonuscode <br><span class="glyphicon glyphicon-sort"></span>
                        </div>
                    </div>
                    <div class="tableHome-infoWrapper">
                        <div class="vertical-align">
                                        <span class="Sorter3"
                                              data-secondary="<?= $bewertung ?>"><?= EncodeSpecialCharacters($bonuscode) ?></span>
                        </div>
                    </div>
                </div>
                <!--BEWERTUNG-->
                <div class="col-xs-3 col-sm-1 <?= $borderTopBigTable ?>">
                    <div class="tableHome-bottomLabel <?= $showLabelsBigTable ?> tableHome-sorter hidden-lg"
                         data-checker="Sorter0">
                        <div class="vertical-align">
                            Rating <br><span class="glyphicon glyphicon-sort"></span>
                        </div>
                    </div>
                    <div class="tableHome-infoWrapper tableHome-ratingBack">
                        <div class="vertical-align">
                            <span class="Sorter0" data-secondary="<?= $bewertung ?>"><?= $bewertung ?></span>
                        </div>
                    </div>
                </div>
                <!--ZUM ANBIETER-->
                <div class="col-xs-6 col-sm-3 <?= $borderTopBigTable ?>">
                    <div class="tableHome-bottomLabel hidden-lg <?= $showLabelsBigTable ?>">
                        <div class="vertical-align">Zum Anbieter</div>
                    </div>
                    <div class="tableHome-infoWrapperButton">
                        <div class="tableHome-infoButtonCenter">
                            <a href="<?= getGoUrl($operator, 1) ?>"
                               class="buttons-smYellow buttons-orangeGrad hvr-wobble-horizontal" rel="nofollow"
                               target="_blank">SICHERN</a>
                        </div>
                        <a href="<?= getUrl($operator, 1) ?>" class="tableHome-infoButtonText">
                            <?= $operator ?>Gutschein Info
                        </a>
                    </div>
                </div>
            </div><!--END TABLE ROW-->
            <?php
            $firstAmounts = '';
            $firstAmountsSign = '';
            $noDepositAmounts = '';
            $noDepositAmountsSign = '';
            }
            }
            } ?>
        </div><!--END TABLE-->
    </div><!--END TABLE CONTAINER-->
