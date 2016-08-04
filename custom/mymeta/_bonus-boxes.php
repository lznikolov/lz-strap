<?php
require($_SERVER["DOCUMENT_ROOT"]."/wp-content/themes/mini-strap/custom/dbconnect.php");
require_once('bonus-boxes-settings.php');

if ($sort_order_array) {

    echo '<br><div id="related" class="boxes-pluginWrapper">
        <div class="tabdiv-wrapper">';

    foreach($sort_order_array as $bon=> $val){
        foreach ($bonuses_array as $bon_name => $values) {

            if($val == $bon_name){
                //VALUES

                $description = $values['description'];

                //values for button links, cookies, likes and clicks
                $bon_id = $values['bonusID'];
                $oper_id = $values['operatorID'];
                $href = $bon_id;

                if( $bon_name == 'Standard' ||  $bon_name == 'Poker Bonus' || $bon_name == 'Poker Freerolls' ){
                    $amount_label = '1. Einzahlung max. Bonus';
                    //AMOUNT
                    if( !empty($values['amount']['eur']) ){
                        if(!is_numeric($values['amount']['eur'])){
                            $amount =$values['amount']['eur'];
                        }
                        else {
                            $amount = $values['amount']['eur'].'€';
                        }
                    }
                    elseif( !empty($values['amount']['usd']) ){
                        $amount = $values['amount']['usd'].'$';
                    }
                    elseif( !empty($values['amount']['gbp']) ){
                        $amount = $values['amount']['gbp'].'£';
                    }
                }
                elseif ($bon_name == 'Free-Spins' || $bon_name == 'Free-Spins Fake'){
                    $amount ='';
                    $freespins = $values['freespinsamount'];
                    $freespins_game = EncodeSpecialCharacters($values['freespinsgame']);
                    $freespins_requirement = $values['freespinrequirement'];
                }
                else {
                    $amount_label = 'Maximaler Bonus';
                    //MAXAMOUNT
                    if( !empty($values['maxamount']['eur']) ){
                        if(!is_numeric($values['maxamount']['eur'])){
                            $amount =$values['maxamount']['eur'];
                        }
                        else {
                            $amount = $values['maxamount']['eur'].'€';
                        }
                    }
                    elseif( !empty($values['maxamount']['usd']) ){
                        $amount = $values['maxamount']['usd'].'$';
                    }
                    elseif( !empty($values['maxamount']['gbp']) ){
                        $amount = $values['maxamount']['gbp'].'£';
                    }

                    //AMOUNT
                    elseif( !empty($values['amount']['eur']) ){
                        if(!is_numeric($values['amount']['eur'])){
                            $amount =$values['amount']['eur'];
                        }
                        else {
                            $amount = $values['amount']['eur'].'€';
                        }
                    }
                    elseif( !empty($values['amount']['usd']) ){
                        $amount = $values['amount']['usd'].'$';
                    }
                    elseif( !empty($values['amount']['gbp']) ){
                        $amount = $values['amount']['gbp'].'£';
                    }
                }

                //PERCENTAGE
                if( !empty($values['percentage']) ){
                    $percentage = $values['percentage'].'%';
                }
                else{
                    $percentage = $values['percentage'];
                }

                //TURNOVER
                if( (!empty($values['turnover'])) && (!empty($values['turnovertype']))){
                    $turnover =  $values['turnover'].'x '. $values['turnovertype'];
                }
                else{
                    $turnover = '';
                }

                //MINIMUM ODD
                if( !empty($values['minodd']) ){
                    $minodd =  $values['minodd'];
                }
                else{
                    $minodd = '';
                }

                //FREEROLLS PRIZE POOL
                if( !empty($values['freerollsprizepool']['eur']) ){
                    $freerolls_prizepool = $values['freerollsprizepool']['eur'].'€';
                }else if( !empty($values['freerollsprizepool']['usd']) ){
                    $freerolls_prizepool = $values['freerollsprizepool']['usd'].'$';
                }else if( !empty($values['freerollsprizepool']['gbp']) ){
                    $freerolls_prizepool = $values['freerollsprizepool']['gbp'].'£';
                }

                //FREEROLLS AMOUNT
                $freerolls_amount = $values['freerollsammount'];
                //BONUSCODE
                if(($values['bonuscode'] == 'Aktuell kein Bonuscode notwendig!') || ($values['bonuscode'] == '')){
                    $bonuscode = 'Kein Code nötig';
                }
                else{
                    $bonuscode = $values['bonuscode'];
                }

                //CHANGING BOOTSTRAP CLASS DEPENDING ON NUMBER OF BONUS VALUES
                $array_bon_vals = array($minodd, $amount, $percentage,$turnover, $freespins, $freespins_game, $freespins_requirement);
                $labels_number = count(array_filter($array_bon_vals));

                switch ($labels_number) {
                    case 1:
                        $label_class = 12;
                        break;
                    case 2:
                        $label_class = 6;
                        break;
                    case 3:
                        $label_class = 4;
                        break;
                    case 4:
                        $label_class = 3;
                        break;
                }

                //GETTING THE LABEL TEXT
                foreach ($labels as $label_key => $label_text) {
                    if($label_key == $bon_name){
                        $title = $current_operator.' '.$label_text;
                    }
                }

                //LIKES AND CLICKS
                if ( is_multisite() ) {
                    $site_id = get_current_blog_id();
                    $query = "SELECT * FROM bonusmetas$site_id WHERE bookie='".strtolower($current_operator)."' AND bonus = '".$bon_name."'" or die("Error in the consult..".mysqli_error($link));
                }else{
                    $query = "SELECT * FROM bonusmetas WHERE bookie='".strtolower($current_operator)."' AND bonus = '".$bon_name."'" or die("Error in the consult..".mysqli_error($link));
                }
                
                $result = $link->query($query);

                if ($result->num_rows > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        $likes = $row['likes'];
                        $clicks = $row['clicks'];
                        $likes_id = $row['id'];
                    }
                }

                //COOKIE CHECK
                if (!isset($_COOKIE["m_" . strip4url($current_operator) . "_".$values['title']])) {
                    $link_target = 'target="_blank"';
                    $viewboncode = 0;
                } else {
                    $link_target = '';
                    $viewboncode = 1;
                }

                //BUTTON LINK VALUES
                $link_button ='
                    <a  href="'.get_the_permalink().'?b='.$href.'&opid='.$oper_id.'"
                        class="boxes-boxLink"
                        data-url="' . getGoUrl($current_operator, 1) . '" ' . $link_target . ' rel="nofollow"
                        data-bon="' . $values['title'] . '"
                        data-bonid="' . $likes_id . '"
                        data-operator="'.strip4url($current_operator).'">
                        <div class="boxes-boxButton hvr-wobble-horizontal buttons-orangeGrad"><span class="glyphicon glyphicon-chevron-left"></span> ANZEIGEN</div>
                    </a>';

                //BONUS CODE FIELD VALUES
                if($viewboncode == 1){
                    $bonus_code_field = '<input type="text" value="'.$bonuscode.'"/>';
                }
                else{
                    $bonus_code_field = '
                        <a  href="'.get_the_permalink().'?b='.$href.'&opid='.$oper_id.'"
                            class="boxes-boxLink"
                            data-url="' . getGoUrl($current_operator, 1) . '" ' . $link_target . ' rel="nofollow"
                            data-bon="' . $values['title'] . '"
                            data-bonid="' . $likes_id . '"
                            data-operator="'.strip4url($current_operator).'">
                            <input type="password" value="bonuscode"/>
                        </a>';
                }

                //PRINTING THE BONUS BOX
                echo'
                <div class="boxes-box"  data-bonusid="'.$bon_id.'">
                    <div class="container relativeContainer boxes-boxTop">
                        <div class="col-sm-12">
                            <div class="boxes-boxLogo">
                                <div class="boxes-imgWrapper">
                                    <a href="' . getGoUrl($current_operator, 1) . '" target="_blank" rel="nofollow">
                                    <img src="/assets/images/logos_105x53/'.strip4url($current_operator).'_105x53.png" alt="'.strip4url($current_operator).'">
                                    </a>
                                </div>
                            </div>
                            <span class="boxes-boxTitle">'.$title.'</span>
                        </div>
                    </div>
                    <div class="container relativeContainer boxes-boxMiddle">
                        <div class="col-xs-6 col-sm-3">
                            <div class="boxes-boxlikes" data-likebonus="'.$likes_id.'"><span class="glyphicon glyphicon-heart"></span>'.$likes.' likes</div>
                        </div>
                        <div class="col-xs-6 col-sm-3 boxes-boxUsers">'.$clicks.' mal wurde der Bonus bereits genutzt</div>
                        <div class="col-xs-6 col-sm-3 floatRight">
                            '.$link_button.'
                        </div>
                        <div class="col-xs-6 col-sm-3 boxes-boxLink2">
                          '.$bonus_code_field.'
                        </div>
                    </div>
                    <div class="container relativeContainer boxes-down">
                        <div class="boxes-boxInfo bonus_'.$bon_name.'">';
                            if ($bon_name == 'Cashback') {
                                echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Höhe des Cashback Bonus</label><span>'.$percentage.'</span></div>';
                                echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Anzahl der Cashback Boni</label> <span>Unbegrenzt</span></div>';
                                echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Umsatz</label><span>Kein Umsatz erforderlich</span></div>';
                            }
                            else {
                                if( $amount != '' ){
                                    echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>'.$amount_label.'</label><span>'.$amount.'</span></div>';
                                }
                                if( $percentage != '' ){
                                    echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Prozent</label><span>'.$percentage.'</span></div>';
                                }
                                if($turnover != ''){
                                    echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Umsatz</label><span>'.$turnover.'</span></div>';
                                }
                                if($freespins != ''){
                                    echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Freispiele</label><span>'.$freespins.'</span></div>';
                                }
                                if($freespins_game != ''){
                                    echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Slots</label><span>'.$freespins_game.'</span></div>';
                                }
                                if($freespins_requirement != ''){
                                    echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Anforderung</label><span>'.$freespins_requirement.'</span></div>';
                                }
                                if($freerolls_prizepool != ''){
                                    echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Freerolls Prizepool</label><span>'.$freerolls_prizepool.'</span></div>';
                                }
                                if($freerolls_amount != ''){
                                    echo '<div class="boxes-boxInfoFirst options col-xs-12 col-sm-'.$label_class.'"><label>Freerolls Ammount</label><span>'.$freerolls_amount.'</span></div>';
                                }
                            }
                            echo '
                        </div>
                    </div>
                    <div class="container relativeContainer boxes-shadow"></div>
                </div>';
            }

            $amount = '';
            $percentage = '';
            $turnover = '';
            $freespins = '';
            $freespins_game = '';
            $freespins_requirement = '';
            $freerolls_amount = '';
            $freerolls_prizepool = '';

        }
    }

    echo '
    </div>
    </div>';

    include('wp-content/themes/mini-strap/custom/newsletter.php');
    include('wp-content/themes/mini-strap/custom/mymeta/popup/popup.php');

    if ($_GET['b']) {
        echo '<script type="text/javascript">var popup_id = "'.$_GET['b'].'";</script>';
    }
}