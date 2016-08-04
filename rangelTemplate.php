<?php
/**
 * Template Name: Rangel Template
 *
 * @package WordPress
 * @subpackage Mini-Strap
 */

?>

<?php

echo "<pre>";

$bonuses = getBonuses($operShortnameOrID = '', $bonusType = '', $bonusReplace = '', $unsetBonusCheck = '', $unsetStandartCheck = '', $bonusLimit = '', $useBonusGroup = '', $useShortname = '', $unsetSetTypeCheck = '');
print_r($bonuses);

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
    if ($bonus['Casino Apps']['iosapp'] === 'yes') {
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
        echo $rating;
    }
}

//sotirame syzdadeniqt array s dannite po jelaniq kluch
array_multisort($sortArray, SORT_DESC, $appOperator);
echo "</pre>";
?>
