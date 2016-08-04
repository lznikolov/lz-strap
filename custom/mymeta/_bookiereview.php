<div id="bookiereview" class="container relativeContainer ">    
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
            $reviewDescr = $options['description'];
        }
    }
    if ($GLOBALS['jsonType'] == 'casino') {
        $raitingType = 'Casino Ratings';
    } else {
        $raitingType = 'Ratings';
    }
    $bewertung = $GLOBALS['bonusArray'][$GLOBALS['curentOperator']][$raitingType]['10rating'];
    $oddsrating = $GLOBALS['bonusArray'][$GLOBALS['curentOperator']][$raitingType]['oddsrating'];
    $betofferrating = $GLOBALS['bonusArray'][$GLOBALS['curentOperator']][$raitingType]['betofferrating'];
    $bonusrating = $GLOBALS['bonusArray'][$GLOBALS['curentOperator']][$raitingType]['bonusrating'];
    $paymentmethodsrating = $GLOBALS['bonusArray'][$GLOBALS['curentOperator']][$raitingType]['paymentmethodsrating'];
    $servicerating = $GLOBALS['bonusArray'][$GLOBALS['curentOperator']][$raitingType]['servicerating'];
    $mobilerating = $GLOBALS['bonusArray'][$GLOBALS['curentOperator']][$raitingType]['mobilerating'];
    if ($bewertung <= 10) {
        $xhtmlraging = "Fabelhaft: ";
    }
    if ($bewertung <= 9) {
        $xhtmlraging = "Sehr Gut: ";
    }
    if ($bewertung <= 8) {
        $xhtmlraging = "Empfehlenswert: ";
    }
    if ($bewertung <= 7) {
        $xhtmlraging = "Gut: ";
    }
    if ($bewertung <= 6) {
        $xhtmlraging = "Durchschnittlich: ";
    }
    if ($bewertung <= 5) {
        $xhtmlraging = "Ausreichend: ";
    }
    if ($bewertung <= 4) {
        $xhtmlraging = "Schlecht: ";
    }
    if ($bewertung <= 3) {
        $xhtmlraging = "Sehr Schlecht: ";
    }
    if ($bewertung <= 2) {
        $xhtmlraging = "Warnung: ";
    }
    require($_SERVER["DOCUMENT_ROOT"] . "/wp-content/themes/mini-strap/custom/dbconnect.php");


    if ( is_multisite() ) {
        $site_id = get_current_blog_id();
        $query = "SELECT * FROM bonusmetas$site_id WHERE bookie = '" . $clean_operator . "'";
    }else{
        $query = "SELECT * FROM bonusmetas WHERE bookie = '" . $clean_operator . "'";
    }

    $result = $link->query($query);
    $totalrows = 0;
    while ($row = mysqli_fetch_array($result)) {
        $totalrows = $totalrows + $row['clicks'];
    }
    $operShortnameOrIDFacts = $GLOBALS['curentOperator'];
    $factType = 'positive';
    $factLimit = '5';
    $pros = getFacts($operShortnameOrIDFacts, $factType, $factLimit);
    $oddsratingNum = $oddsrating * 10;
    $betofferratingNum = $betofferrating * 10;
    $bonusratingNum = 10 * $bonusrating;
    $paymentmethodsratingNum = $paymentmethodsrating * 10;
    $serviceratingNum = $servicerating * 10;
    $mobileratingNum = $mobilerating * 10;
    echo '    <div class="row">        <div class="col-xs-12 text-center">            <a href="' . getGoUrl($GLOBALS['curentOperator'], 1) . '" target="_blank" rel="nofollow">                <img src="/assets/images/logos_105x53/' . strip4url($GLOBALS['curentOperator']) . '_105x53.png" alt="' . $operator . '" class="bookiereview-logo">            </a>        </div>    </div>    <div class="row">        <div class="col-xs-12 col-sm-6">            <div class="bookiereview-progressText">WETTQUOTEN</div>            <div class="progress">                <div class="progress-bar" role="progressbar" aria-valuenow="' . $oddsratingNum . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $oddsratingNum . '%">                    ' . $oddsrating . '                </div>            </div>            <div class="bookiereview-progressText">WETTANGEBOT</div>            <div class="progress">                <div class="progress-bar" role="progressbar" aria-valuenow="' . $betofferratingNum . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $betofferratingNum . '%">                    ' . $betofferrating . '                </div>            </div>            <div class="bookiereview-progressText">WETTBONUS</div>            <div class="progress">                <div class="progress-bar" role="progressbar" aria-valuenow="' . $bonusratingNum . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $bonusratingNum . '%">                    ' . $bonusrating . '                </div>            </div>            <div class="bookiereview-progressText">KUNDENSERVICE</div>            <div class="progress">                <div class="progress-bar" role="progressbar" aria-valuenow="' . $paymentmethodsratingNum . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $paymentmethodsratingNum . '%">                    ' . $paymentmethodsrating . '                </div>            </div>            <div class="bookiereview-progressText">ZAHLUNGSMITTEL</div>            <div class="progress">                <div class="progress-bar" role="progressbar" aria-valuenow="' . $serviceratingNum . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $serviceratingNum . '%">                    ' . $servicerating . '                </div>            </div>            <div class="bookiereview-progressText">MOBILE</div>            <div class="progress">                <div class="progress-bar" role="progressbar" aria-valuenow="' . $mobileratingNum . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $mobileratingNum . '%">                    ' . $mobilerating . '                </div>            </div>            <a href="' . getGoUrl($GLOBALS['curentOperator'], 1) . '" rel="nofollow" target="_blank" class="buttons-xlButton2 buttons-orangeGrad hvr-wobble-horizontal">                <span class="buttons-xlButton2Bew">                    Bewertung<br>                    <span class="buttons-xlButton2BewRating">' . $bewertung . '</span>                </span>                <span class="buttons-xlButton2Text">Jetzt Ihre 100 Euro<br> Gutschein sichern! <span class="glyphicon glyphicon-chevron-right"></span></span>            </a>        </div>        <div class="col-xs-12 col-sm-6">            <ul class="bookiereview-facts">';
    foreach ($pros as $key => $value) {
        print '                    <li><span class="glyphicon glyphicon-ok marginRightGlyph"></span>' . SecondLevelCharConverting(EncodeSpecialCharacters($value)) . '</li>                ';
    }
    setlocale(LC_ALL, "de_DE.utf8");
    echo '            </ul>            <div class="bookiereview-descrTitle">                ' . $GLOBALS['curentOperator'] . ' Bonus ' . date("F") . ' ' . date("Y") . '            </div>            <div class="bookiereview-descrText">                ' . $reviewDescr . '            </div>        </div>    </div></div>'; ?><?php ob_start(); ?>
    <script>    jQuery(document).ready(function () {
            jQuery(".reviewtopimage").animate({"opacity": "1"}, 1000);
        });</script><?php $GLOBALS['custom'][] = ob_get_clean(); ?><br clear="all"/>