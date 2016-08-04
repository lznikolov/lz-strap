<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 14.7.2016 г.
 * Time: 9:40
 */

/* QR code with operator and os  shortcode */
function qrcode_func($atts)
{
    $a = shortcode_atts(array(
        'operator' => 'missing operator',
        'os' => 'missing os'
    ), $atts);

    ob_start();
    require(get_template_directory() . '/partials/qrcode-content.php');
    $out = ob_get_clean();
    return $out;
}

add_shortcode('qrcode', 'qrcode_func');

/**
 * @param string $os OS gotten from the JSON [iosapp, windowsphone,androidapp, mobilewebsite]
 * @param bool $active It the Tab active or not
 * @param int $numRows Number of rows to show the rest will be hidden
 * @return string
 */
function genOperatorTableTabContent($os, $current_tab = '', $numRows = 5)
{
    $bonuses = getBonuses($operShortnameOrID = '', $bonusType = '', $bonusReplace = '', $unsetBonusCheck = '', $unsetStandartCheck = '', $bonusLimit = '', $useBonusGroup = '', $useShortname = '', $unsetSetTypeCheck = '');

    $active = false;
    if ($os == $current_tab) {
        $active = true;
    }

    $paymentMethods = array("lastschrift", "instadebit", "westernunion", "kalixa", "fasterpay",
        "directebanking", "ecopayz", "switch", "ideal", "eps", "ewire", "enets", "przelewy24", "poli",
        "paybox", "monetaru", "entropay", "onlineuberweisung", "bankuberweisungen", "ukash",
        "paysafecard", "sofortuberweisung", "giropay", "clickandbuy", "click2pay", "webmoney",
        "dinersclub", "americanexpress", "skrill", "neteller", "mastercard", "visaelectron",
        "visa", "paypal");
    $neededPaymentMethods = array("lastschrift", "bankuberweisungen", "webmoney",
        "paysafecard", "sofortuberweisung", "giropay", "skrill", "neteller", "mastercard", "visaelectron",
        "visa", "paypal");
    $count = 0;
    $isCollapsed = false;
    $appOperator = array();


    //store the needed values in $appOperator[]
    foreach ($bonuses as $operator => $bonus) {
        if ($bonus['Casino Apps'][$os] === 'yes') {
            $description = isset($bonus['Standard']['description']) ? $bonus['Standard']['description'] : 'no description';
            $rating = isset($bonus['Casino Ratings']['10rating']) ? $bonus['Casino Ratings']['10rating'] : '0';
            $payout = isset($bonus['Standard']['averagepayout']) ? $bonus['Standard']['averagepayout'] : '0';
            $liveplay = isset($bonus['Bonus Turnovers']['livecasino']) ? $bonus['Bonus Turnovers']['livecasino'] : 'no';

            //check and replace Standard with Exclusive
            $amountType = 'Standard';
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

            $appOperator[$operator]['operator'] = $operator;
            $appOperator[$operator]['maxAmount'] = $maxAmount;
            $appOperator[$operator]['payout'] = $payout;
            $depositMethod = $bonus['Deposit Method'];
            foreach ($neededPaymentMethods as $payment) {
                if (array_key_exists($payment, $depositMethod) && $depositMethod[$payment] === "yes")
                    $appOperator[$operator]['depositMethods'][] = $payment;
            }
            $appOperator[$operator]['rating'] = $rating;
            $appOperator[$operator]['liveplay'] = $liveplay;
            $appOperator[$operator]['description'] = $description;
            $appOperator[$operator]['isExclusive'] = $isExclusive;
        }
    }

    $sortArray = array();
//TODO DA OPRAWQ TUK DA SE SORTIRAT ,za da ne polzwam JS
    foreach ($appOperator as $operator => $row) {
        foreach ($row['rating'] as $rating) {
            if (!empty($rating)) {
                if (!is_numeric($rating)) {
                    $sortArray[$operator] = 0;
                } else {
                    $sortArray[$operator] = $rating;
                }
            }
        }
    }

    //sotirame syzdadeniqt array s dannite po jelaniq kluch
    array_multisort($sortArray, SORT_DESC, $appOperator);

    //the html form is stored as partial view
    ob_start();
    require(get_template_directory() . '/partials/table-content.php');
    $out = ob_get_clean();
    return $out;
}

/**
 * Generate the content for the specific tab
 * @param $attr
 * @return string The content of the Tab
 */
function genOperatorTable($attr)
{
    $a = shortcode_atts(array(
        'tab' => 'missing operator',
        'numrows'=>'5'
    ), $attr);

    ob_start(); ?>
    <div class="row" id="tableContainer">
        <div class="col-xs-12">
            <ul id="os_tabs" class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" <?php $tabIdName = 'iosapp';
                echo $a['tab'] == $tabIdName ? 'class="active"' : ''; ?>>
                    <a href="#iosapp_casinos" role="tab" aria-controls="iosapp_casinos"
                       data-toggle="tab"><strong>iOS</strong></a>
                </li>
                <li role="presentation" <?php $tabIdName = 'androidapp';
                echo $a['tab'] == $tabIdName ? 'class="active"' : ''; ?>>
                    <a href="#androidapp_casinos" aria-controls="androidapp_casinos" role="tab"
                       data-toggle="tab"><strong>Android</strong></a>
                </li>
                <li role="presentation" <?php $tabIdName = 'windowsphone';
                echo $a['tab'] == $tabIdName ? 'class="active"' : ''; ?>>
                    <a href="#windowsphone_casinos" aria-controls="windowsphone_casinos" role="tab"
                       data-toggle="tab"><strong>Windows</strong></a>
                </li>
                <li role="presentation" <?php $tabIdName = 'mobilewebsite';
                echo $a['tab'] == $tabIdName ? 'class="active"' : ''; ?>>
                    <a href="#mobilewebsite_casinos" aria-controls="mobilewebsite_casinos" role="tab"
                       data-toggle="tab"><strong>Mobile</strong></a>
                </li>
            </ul>
            <div class="tab-content">
                <?php echo genOperatorTableTabContent('iosapp', $a['tab'], $a['numrows']); ?>
                <?php echo genOperatorTableTabContent('androidapp', $a['tab'], $a['numrows']); ?>
                <?php echo genOperatorTableTabContent('windowsphone', $a['tab'], $a['numrows']); ?>
                <?php echo genOperatorTableTabContent('mobilewebsite', $a['tab'], $a['numrows']); ?>
            </div>
        </div>
    </div>
    <?php
    $out = ob_get_clean();
    return $out;
}

//shortcode for the table with all operators
add_shortcode("table_operator", "genOperatorTable");

/*---------------------------------------------------------------------------------------------------------------------*/

/**
 * @param string $type Bonus Type
 * @param string $key key to check if is equal
 * @param string $keyValue key condition to check
 * @param int $numRows Number of Rows to show
 * @param string $header Header for the content
 * @return string
 */
function getTopCasino($type, $key, $keyValue = 'yes', $numRows = 3, $header)
{
    $bonuses = getBonuses($operShortnameOrID = '', $bonusType = '', $bonusReplace = '', $unsetBonusCheck = '', $unsetStandartCheck = '', $bonusLimit = '', $useBonusGroup = '', $useShortname = '', $unsetSetTypeCheck = '');
    $opList = array();

    $key_orig = "";

    switch ($key) {
        case "starburst_gonzo" :
            $key_orig = "starburst_gonzo";
            $key = "netent";
            break;
        case "book_of_ra" :
            $key_orig = "book_of_ra";
            $key = "novoline";
            break;
    }
    foreach ($bonuses as $operator => $bonus) {
        if ($bonus[$type][$key] === $keyValue) {
            $rating = $bonus['Casino Ratings']['10rating'];
            $payout = $bonus['Standard']['averagepayout'];
            $noDepositBonus = $bonus['No-Deposit']['amount'];

            //obrabotwame arrayq sys sumata i go prevrystame v string, chislo i simvol na valutata
            $noDepositBonusCurrency = 0;
            foreach ($noDepositBonus as $currency => $money) {
                if (!empty($money)) {
                    switch ($currency) {
                        case "gbp":
                            if (is_numeric($money)) {
                                $noDepositBonusCurrency = $money . "&pound;";
                            } else {
                                $noDepositBonusCurrency = $money;
                            }
                            break;
                        case "eur":
                            if (is_numeric($money)) {
                                $noDepositBonusCurrency = $money . "&euro;";
                            } else {
                                $noDepositBonusCurrency = $money;
                            }
                            break;
                        case "usd":
                            if (is_numeric($money)) {
                                $noDepositBonusCurrency = $money . "$";
                            } else {
                                $noDepositBonusCurrency = $money;
                            }
                            break;
                        default:
                            $noDepositBonusCurrency = "NO CURRENCY";
                    }
                }
            }

            //check and replace Standard with Exclusive
            $amountType = 'Standard';
            $isExclusive = false;
            if (isset($bonus['Exclusive']) && is_array($bonus['Exclusive'])) {
                $amountType = 'Exclusive';
                $isExclusive = true;
            } else {
                $amountType = 'Standard';
            }

            $amount = $bonus[$amountType]['amount'];

            //obrabotwame arrayq sys sumata i go prevrystame v string, chislo i simvol na valutata
            $amountCurrency = 0;
            foreach ($amount as $currency => $money) {
                if (!empty($money)) {
                    switch ($currency) {
                        case "gbp":
                            if (is_numeric($money)) {
                                $amountCurrency = $money . "&pound;";
                            } else {
                                $amountCurrency = $money;
                            }
                            break;
                        case "eur":
                            if (is_numeric($money)) {
                                $amountCurrency = $money . "&euro;";
                            } else {
                                $amountCurrency = $money;
                            }
                            break;
                        case "usd":
                            if (is_numeric($money)) {
                                $amountCurrency = $money . "$";
                            } else {
                                $amountCurrency = $money;
                            }
                            break;
                        default:
                            $amountCurrency = "NO CURRENCY";
                    }
                }
            }


            //syzdavame nashiq array s nujnite ni danni
            $opList[$operator]['amount'] = $amount;
            $opList[$operator]['amountCurrency'] = $amountCurrency;
            $opList[$operator]['payout'] = $payout;
            $opList[$operator]['rating'] = $rating;
            $opList[$operator]['noDepositBonus'] = $noDepositBonusCurrency;
            $opList[$operator]['isExclusive'] = $isExclusive;
        }
    }


    //tam kydeto imame prazno ili text v amount go zamestwame s 0, za da moje da raboti sortirovkata
    $sortArray = array();

    foreach ($opList as $operator => $row) {
        foreach ($row['rating'] as $rating) {
            if (!empty($rating)) {
                if (!is_numeric($rating)) {
                    $sortArray[$operator] = 0;
                } else {
                    $sortArray[$operator] = $rating;
                }
            }

        }
    }

    //sotirame syzdadeniqt array s dannite po jelaniq kluch
    array_multisort($sortArray, SORT_DESC, $opList);

    //ot rezultata wzimame samo pyrwite $numRows broj redove
    $options = array_slice($opList, 0, $numRows);
    //Vrystame si originalnata stoinost na $key
    if (!empty($key_orig)) $key = $key_orig;
    $element_css_id = strtolower(preg_replace('/\s+/', '', $type) . '-' . preg_replace('/\s+/', '', $key));

    ob_start();
    require(get_template_directory() . '/partials/box-content.php');
    $out = ob_get_clean();
    return $out;
}

// Small Casino Table
function casinoBox($atts)
{
    $a = shortcode_atts(array(
        'type' => 'missing type',
        'key' => 'missing key',
        'keyvalue' => 'missing key value',
        'rows' => 'missing row amount',
        'header' => 'missing header'
    ), $atts);

    return getTopCasino($a['type'], $a['key'], $a['keyvalue'], $a['rows'], $a['header']);
}

add_shortcode("table_casino", "casinoBox");

/*---------------------------------------------------------------------------------------------------------------------*/
//casino count
function casinoCount()
{
    $bonuses = getBonuses($operShortnameOrID = '', $bonusType = '', $bonusReplace = '', $unsetBonusCheck = '', $unsetStandartCheck = '', $bonusLimit = '', $useBonusGroup = '', $useShortname = '', $unsetSetTypeCheck = '');
    return count($bonuses);
}

add_shortcode("casino_count", "casinoCount");
?>