<?php

//SORTING ARRAY
$sort_order_array = array("No-Deposit" ,"No-Deposit Fake", "Free-Spins", "Free-Spins Fake", "Standard" , 'Poker Bonus', "Exclusive" , "Beginner" , "Mobile" , "PayPal Deposit" , "Highroller", "2. Reload" , "3. Reload" , "4. Reload", "Cashback", "Poker Freerolls");

//COLORS ARRAY
$bonusColor = array();
foreach ($sort_order_array as $key) {
    switch ($key) {
        case 'No-Deposit':
            if(!empty($noDeposit_color)){
                $bonusColor['No-Deposit'] = $noDeposit_color;
                $bonusColor['No-Deposit Fake'] = $noDeposit_color;
            }else{
                $bonusColor['No-Deposit'] = '#faf7f2';
                $bonusColor['No-Deposit Fake'] = '#faf7f2';
            }
            break;
        case 'No-Deposit Fake':
            if(!empty($noDeposit_color)){
                $bonusColor['No-Deposit'] = $noDeposit_color;
                $bonusColor['No-Deposit Fake'] = $noDeposit_color;
            }else{
                $bonusColor['No-Deposit'] = '#faf7f2';
                $bonusColor['No-Deposit Fake'] = '#faf7f2';
            }
            break;
        case 'Free-Spins':
            if(!empty($free_spins_color)){
                $bonusColor['Free-Spins']   = $free_spins_color;
                $bonusColor['Free-Spins Fake']   = $free_spins_color;
            }else{
                $bonusColor['Free-Spins']   = '#faf7f2';
                $bonusColor['Free-Spins Fake']   = '#faf7f2';
            }
            break;
        case 'Free-Spins Fake':
            if(!empty($free_spins_color)){
                $bonusColor['Free-Spins']   = $free_spins_color;
                $bonusColor['Free-Spins Fake']   = $free_spins_color;
            }else{
                $bonusColor['Free-Spins']   = '#faf7f2';
                $bonusColor['Free-Spins Fake']   = '#faf7f2';
            }
            break;
        case 'Standard':
            if(!empty($standard_color)){
                $bonusColor['Standard'] = $standard_color;
            }else{
                $bonusColor['Standard']     = '#faf7f2';
            }
            break;
        case 'Exclusive':
            if(!empty($exclusive_color)){
                $bonusColor['Exclusive']    = $exclusive_color;
            }else{
                $bonusColor['Exclusive']    = '#faf7f2';
            }
            break;
        case 'Poker Bonus':

            if(!empty($standard_color)){
                $bonusColor['Poker Bonus'] = $standard_color;
            }else{
                $bonusColor['Poker Bonus']     = '#faf7f2';
            }
            break;
        case 'Poker Freerolls':
            if(!empty($standard_color)){
                $bonusColor['Poker Freerolls'] = $standard_color;
            }else{
                $bonusColor['Poker Freerolls']     = '#faf7f2';
            }
            break;
        case 'Beginner':
            if(!empty($beginner_color)){
                $bonusColor['Beginner']     = $beginner_color;
            }else{
                $bonusColor['Beginner']     = '#faf7f2';
            }
            break;
        case 'Mobile':
            if(!empty($mobile_color)){
                $bonusColor['Mobile']     = $mobile_color;
            }else{
                $bonusColor['Mobile']     = '#faf7f2';
            }
            break;
        case 'PayPal Deposit':
            if(!empty($paypal_color)){
                $bonusColor['PayPal Deposit']    = $paypal_color;
            }else{
                $bonusColor['PayPal Deposit']    = '#faf7f2';
            }
            break;
        case 'Highroller':
            if(!empty($highroller_color)){
                $bonusColor['Highroller']   = $highroller_color;
            }else{
                $bonusColor['Highroller']   = '#faf7f2';
            }
            break;
        case '2. Reload':
            if(!empty($second_reload_color)){
                $bonusColor['2. Reload']     = $second_reload_color;
            }else{
                $bonusColor['2. Reload']     = '#faf7f2';
            }
            break;
        case '3. Reload':
            if(!empty($third_reload_color)){
                $bonusColor['3. Reload']     = $third_reload_color;
                $bonusColor['3.Reload']     = $third_reload_color;
            }else{
                $bonusColor['3. Reload']     = '#faf7f2';
                $bonusColor['3.Reload']     = '#faf7f2';
            }
            break;
        case '4. Reload':
            if(!empty($forth_reload_color)){
                $bonusColor['4. Reload']     = $forth_reload_color;
                $bonusColor['4.Reload']     = $forth_reload_color;
            }else{
                $bonusColor['4. Reload']     = '#faf7f2';
                $bonusColor['4.Reload']     = '#faf7f2';
            }
            break;
        case 'Cashback':
            if(!empty($cashback_color)){
                $bonusColor['Cashback']     = $cashback_color;
                $bonusColor['Cashback']     = $cashback_color;
            }else{
                $bonusColor['Cashback']     = '#faf7f2';
                $bonusColor['Cashback']     = '#faf7f2';
            }
            break;
    }
}

//LABELS ARRAY
$labels = array();
foreach ($sort_order_array as $key) {
    switch ($key) {
        case 'No-Deposit':
            if(empty($noDeposit_label)){
                $noDeposit_label = 'Gutschein Ohne Einzahlung';
            }
            $labels[$key] = $noDeposit_label;
            break;
        case 'No-Deposit Fake':
            if(empty($noDeposit_label)){
                $noDeposit_label = 'Gutschein Ohne Einzahlung';
            }
            $labels[$key] = $noDeposit_label;
            break;
        case 'Free-Spins':
            if(empty($free_spins_label)){
                $free_spins_label = 'Freispiele';
            }
            $labels[$key] = $free_spins_label;
            break;
        case 'Free-Spins Fake':
            if(empty($free_spins_label)){
                $free_spins_label = 'Freispiele';
            }
            $labels[$key] = $free_spins_label;
            break;
        case 'Standard':
            if(empty($standard_label)){
                $standard_label = 'Gutschein';
            }
            $labels[$key] = $standard_label;
            break;
        case 'Exclusive':
            if(empty($exclusive_label)){
                $exclusive_label ='Exklusiver Bonus';
            }
            $labels[$key] = $exclusive_label;
            break;
        case 'Poker Bonus':
            if(empty($poker_label)){
                $poker_label ='Poker Bonus';
            }
            $labels[$key] = $poker_label;
            break;
        case 'Poker Freerolls':
            if(empty($poker_freerolls_label)){
                $poker_freerolls_label ='Poker Freerolls';
            }
            $labels[$key] = $poker_freerolls_label;
            break;
        case 'Beginner':
            if(empty($beginner_label)){
                $beginner_label = 'Beginner Gutschein';
            }
            $labels[$key] = $beginner_label;
            break;
        case 'Mobile':
            if(empty($mobile_label)){
                $mobile_label = 'Mobile Gutschein';
            }
            $labels[$key] = $mobile_label;
            break;
        case 'PayPal Deposit':
            if(empty($paypal_deposit_label)){
                $paypal_deposit_label = 'PayPal Gutschein';
            }
            $labels[$key] = $paypal_deposit_label;
            break;
        case 'Highroller':
            if(empty($highroller_label)){
                $highroller_label = 'Highroller Gutschein Code';
            }
            $labels[$key] = $highroller_label;
            break;
        case '2. Reload':
            if(empty($second_reload_label)){
                $second_reload_label = '2. Einzahlung';
            }
            $labels[$key] = $second_reload_label;
            break;
        case '3. Reload':
            if(empty($third_reload_label)){
                $third_reload_label = '3. Einzahlung';
            }
            $labels[$key] = $third_reload_label;
            break;
        case '4. Reload':
            if(empty($forth_reload_label)){
                $forth_reload_label = '4. Einzahlung';
            }
            $labels[$key] = $forth_reload_label;
            break;
        case 'Cashback':
            if(empty($cashback_label)){
                $cashback_label = 'Cashback';
            }
            $labels[$key] = $cashback_label;
            break;
    }
}


//HIDDEN BONUSES
$hiddenBonuses_default = array("Live Casino", "Casino Ratings", "Ratings", "Casino Table Limits", "Monthly Reload", "Software Providers", "Casino Apps", "Deposit Method", "Bonus Turnovers", "Midroller", "Refer-a-friend", "Country Available");
$hiddenBonuses = array_merge($hiddenBonuses_default, $current_operator_bonuses_disable);
$hiddenBonuses = array_flip($hiddenBonuses);        //flipping array for sorting

//BONUSES FUNCTION
$operShortnameOrID = '';
$bonusType = '';
$bonusReplace = '';
$unsetBonusCheck = '';
$unsetStandartCheck = '';
$bonusLimit = '';
$bonuses = getBonuses($current_operator, $bonusType, $bonusReplace, $unsetBonusCheck, $unsetStandartCheck, $bonusLimit);

//HIDING BONUSES
foreach ($bonuses as $operator => $bonus) {
    $bonuses_array = array_diff_key($bonus,$hiddenBonuses);
}
//REPLACING BONUSES
if (isset($bonuses_array['Exclusive'])) {
    unset($bonuses_array['Standard']);
}
if (isset($bonuses_array['No-Deposit'])) {
    unset($bonuses_array['No-Deposit Fake']);
}
if (isset($bonuses_array['Free-Spins'])) {
    unset($bonuses_array['Free-Spins Fake']);
}
if (isset($bonuses_array['Poker Bonus'])) {
    unset($bonuses_array['Standard']);
}