<div class="linestatistichov"></div>
<div class="tableHome-bonusRows smallTable" id="mobile">
    <div class="container relativeContainer">
        <?php
        $operShortnameOrID = $GLOBALS['curentOperator'];
        $bonusType = 'Standard';
        $bonusReplace = 'Exclusive';
        $unsetBonusCheck = '';
        $unsetStandartCheck = '';
        $bonusLimit = '';
        $bonuses = getBonuses($operShortnameOrID, $bonusType, $bonusReplace, $unsetBonusCheck, $unsetStandartCheck, $bonusLimit);
        foreach ($bonuses as $operator => $bonus) {
            foreach ($bonus as $bonusName => $options) {
                $bewertung = number_format((float)EncodeSpecialCharacters($options['10rating']), 1, '.', '');
                $bonuscode = $options['bonuscode'];
                if ($bonuscode == 'Aktuell kein Bonuscode notwendig!') {
                    $bonuscode = 'Kein Code nötig';
                }
                $first = $options['amount'];
                if ($first['usd'] != '') {
                    $firstAmounts = EncodeSpecialCharacters($first['usd']);
                    $firstAmountsSign = '$';
                    if (!is_numeric($firstAmounts)) {
                        $firstAmounts = 0;
                    }
                }
                if ($first['eur'] != '') {
                    $firstAmounts = EncodeSpecialCharacters($first['eur']);
                    $firstAmountsSign = '€';
                    if (!is_numeric($firstAmounts)) {
                        $firstAmounts = 0;
                    }
                }
                if ($first['gbp'] != '') {
                    $firstAmounts = EncodeSpecialCharacters($first['gbp']);
                    $firstAmountsSign = '£';
                    if (!is_numeric($firstAmounts)) {
                        $firstAmounts = 0;
                    }
                }
                $noDeposit = $GLOBALS['bonusArray'][$operator]['No-Deposit']['amount'];
                if ($noDeposit['usd'] != '') {
                    $noDepositAmounts = EncodeSpecialCharacters($noDeposit['usd']);
                    $noDepositAmountsSign = '$';
                    if (!is_numeric($noDepositAmounts)) {
                        $noDepositAmounts = 0;
                    }
                }
                if ($noDeposit['eur'] != '') {
                    $noDepositAmounts = EncodeSpecialCharacters($noDeposit['eur']);
                    $noDepositAmountsSign = '€';
                    if (!is_numeric($noDepositAmounts)) {
                        $noDepositAmounts = 0;
                    }
                }
                if ($noDeposit['gbp'] != '') {
                    $noDepositAmounts = EncodeSpecialCharacters($noDeposit['gbp']);
                    $noDepositAmountsSign = '£';
                    if (!is_numeric($noDepositAmounts)) {
                        $noDepositAmounts = 0;
                    }
                }
                if ($noDepositAmounts == '') {
                    $noDepositAmounts = '-';
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
                if ($bonusName != 'Exclusive') {
                    echo '<div class="row">';
                } else {
                    echo '<div class="row exclusive">
                    <div class="container relativeContainer">
                        <div class="row exclusiveRow">
                            <div class="col-xs-12">Exklusiver Bonus von ' . $GLOBALS['siteUrlString'] . '</div>
                        </div>                
                    </div>                
                </div>';
                }
                //LOGO
                /*
                echo '<div class="col-xs-12 col-sm-2 smallTable-cell">
                        <div class="xs-hide smallTable-label">
                            <div class="vertical-align">Wettanbieter</div>
                        </div>
                        <div class="tableHome-logo">
                            <a href="' . getGoUrl($operator, 1) . '" target="_blank" rel="nofollow" class="rsp_logo" style="width:120px;">
                                <div class="tableHome-logoLink ">
                                    <img src="' . $GLOBALS['imgUrl2'] . 'logos_105x53/' . strip4url($operator) . '_105x53.png" alt="' . $operator . '">
                                </div>
                            </a>
                        </div>
                    </div>';
                */
                //FIRSTBONUS
                /*
                            echo '<div class="col-xs-4 col-sm-2 smallTable-cell smallTable-cellResponsive">
                                    <div class="smallTable-label">
                                        <div class="vertical-align">Maximaler Bonus</div>
                                    </div>
                                    <div class="tableHome-infoWrapper">
                                        <div class="vertical-align"><span>' . $firstAmounts . $firstAmountsSign . '</span></div>
                                    </div>
                                </div>';
                */
                //PERCENTAGE
                /*
                         echo '<div class="col-xs-4 col-sm-1 smallTable-cell smallTable-cellResponsive">
                                    <div class="smallTable-label" >
                                        <div class="vertical-align" > Prozent</div >
                                    </div >
                                    <div class="tableHome-infoWrapper" >
                                        <div class="vertical-align" ><span > '.$prozent.$perzVar.'</span ></div >
                                    </div >
                                </div > ';
                */
                //BONUS CODE
                /*
                echo '<div class="col-xs-4 col-sm-2 smallTable-cell smallTable-cellResponsive" >
                        <div class="smallTable-label" >
                            <div class="vertical-align" > Bonuscode</div >
                        </div >
                        <div class="tableHome-infoWrapper" >
                            <div class="vertical-align" ><span > '.EncodeSpecialCharacters($bonuscode).'</span ></div >
                        </div >
                    </div >';
                */
                //NO DEPOSIT
                /*
               echo '<div class="col-xs-4 col-sm-2 smallTable-cell smallTable-cellResponsive" >
                        <div class="smallTable-label" >
                            <div class="vertical-align" > Bonus ohne < br> Einzahlung </div >
                        </div >
                        <div class="tableHome-infoWrapper" >
                            <div class="vertical-align" ><span > '.$noDepositAmounts.'</span ><span > '.$noDepositAmountsSign.'</span ></div >
                        </div >
                    </div >';
                */
                //BEWERTUNG
                /*
              echo '<div class="col-xs-4 col-sm-1 smallTable-cell smallTable-cellResponsive" >
                        <div class="smallTable-label" >
                            <div class="vertical-align" > Rating</div >
                        </div >
                       <div class="tableHome-infoWrapper tableHome-ratingBack" >
                        <div class="vertical-align" ><span > '.EncodeSpecialCharacters($bewertung).'</div ></span ></div >
                    </div >';
                */
                //ZUM ANBIETER
                /*
                echo '<div class="col-xs-4 col-sm-2 smallTable-cell smallTable-cellResponsive" >
                        <div class="smallTable-label" >
                            <div class="vertical-align" > Zum Anbieter </div >
                        </div >
                        <div class="tableHome-infoWrapperButton" >
                            <div class="tableSmall-infoButtonCenter" >
                                <a href = "' . getGoUrl($operator, 1) . '" class="buttons-smYellow2 buttons-orangeGrad hvr-wobble-horizontal" rel = "nofollow" target = "_blank" > SICHERN</a >
                            </div >
                        </div >
                    </div >';
                */
                /*'</div ></div ></div > ';*/
            }
        }
        ?>
        <div class="container relativeContainer richSnipets" itemscope itemtype="http://schema.org/Review">
            <div class="row">
                <div class="col-xs-12">
                    <span itemprop="name"><?php echo the_title(); ?></span> bewertet mit 
                    <span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating"
                          style="margin-left:5px;">                
                        <meta itemprop="worstRating" content="1">                
                        <span itemprop="ratingValue"><?php echo EncodeSpecialCharacters($bewertung); ?></span> /                
                        <span itemprop="bestRating">10</span>
                    </span> 
                    <span itemprop="author" itemscope itemtype="http://schema.org/Person"> von                
                        <span itemprop="name"><?php echo $_SERVER['HTTP_HOST']; ?></span>            
                    </span> 
                    <span itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">                
                        <span itemprop="name" content="<?php echo $bopp['shortname']; ?>"></span>            
                    </span>
                </div>
            </div>
        </div>