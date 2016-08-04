<?php
require_once("".$_SERVER['DOCUMENT_ROOT']."/wp-config.php");
require_once("".$_SERVER['DOCUMENT_ROOT']."/custom_content/classExtractor/class.extractor.php");
$DB = new getDBprinter;
$GLOBALS['DB'] = $DB->jsonarray;
$raiting_type = $_GET['type'];

//ini_set('display_errors', 1);
//error_reporting(E_ALL);
require_once("".$_SERVER['DOCUMENT_ROOT']."/wp-content/plugins/My-Meta-Box-master/custom_content/tables/fn.class.php");
$LTbl = new LuckyTables_plugin;
$bonus_group = get_option('llbz-bonus_group');
$verchArray = bonus_group_extra($bonus_group,"Standard","","","Exclusive");

$t_name = 'vergleich';
$t_maxoperators = 100;

//REMOVE FIELDS FOR RESPONSIVE
$respPhone = array('platz','software','ohnezahlung','prozent','bonuscode', 'firstbonus');
$PhoneHiddenLabels = array('zumanbieter','casino','bonuscode');
$respTablet = array('numbers','software','ohnezahlung','bonuscode');

//RESIZE FIELDS FOR RESPONSIVE
$respPhoneWidths = array('zumanbieter->98%','maxbonus->10%','bewertung->30%', 'paypal->20%', 'firstbonus->20%');
$respTabletWidths = array('zumanbieter->15%','bewertung->20%','maxbonus->15%','prozent->11%');
$respPhoneLabels = 'no';

echo $LTbl->TableResponsive_plugin($respPhone,$respPhoneWidths,$respTablet,$respTabletWidths,$respPhoneLabels,$respTabletLabels,$PhoneHiddenLabels);
echo $LTbl->TableCss_plugin("");

//LABELS
$labelsEx = array
(
    "casino"					=>array   ("Casino", "80px", "", ""),
    "maxbonus"				    =>array   ("Maximaler Bonus", "8%", "", ""),
    "firstbonus"					=>array   ("1. Einzahlung max. Bonus", "8%", "", ""),
    "prozent"				    =>array   ("1. Einzahlung Prozent", "8%", "", ""),
//    "bonuscode"				=>array   ("Bonuscode", "10%", "", ""),
    "paypal"					=>array   ("PayPal", "12%", "", ""),
    "bewertung"				    =>array   ("Bewertung", "6%", "", ""),
    "zumanbieter"				=>array   ("Zum Casino", "26%", "", "zumcasino")
);
$verchArray = BonusesByOption($verchArray,"Deposit Method","paypal","yes");
?>
	<style>#custom-height-labels-55 .labels{height:55px;}</style>
    <div class="linestatistichov"></div>
    <div class="tableHome-bonusRows"  id="<?php echo $t_name;?>">
        <div>
            <?php
            //REMOVING UNNESESERRY VALUES
            unset($vergleichArray['avaiblefields'][$bonus_group]['type']);
            //PRINTING LABELS
            echo '<div id="custom-height-labels-55">'.$LTbl->printTblLabels_plugin($labelsEx,$t_name).'</div>';
            $rowcounter = 1;
            //PRINTING TABLE CONTENT
            $t_maxoperscount = 0;
            foreach ($verchArray as $bookie => $options)
            {
                if ($t_maxoperators != $t_maxoperscount) {
                    $t_maxoperscount++;
                    if ($bookie != 'avaiblefields') {
                        if ($options != 'contains_no_bonuses') {
                            $tmpthisnoDeposit = '';
							$tmpthisatOps;
                            foreach ($GLOBALS['DB']['operators'] as $opid => $opertt) {
                                if ($bookie == $opertt['shortname']) {
                                    $tmpthisatOps = $opertt;

                                    foreach ($opertt['bonuses'] as $dddas => $optsss) {
                                        if ($optsss['options']['type'] == 'Deposit Method') {
                                            $paypal = $optsss['options']['paypal'];
                                        }
                                        if ($optsss['options']['type'] == 'No-Deposit') {
                                            $tmpthisnoDeposit = $optsss['options']['amount']['eur'];																	}
                                        if ($optsss['options']['type'] == 'Standard') {
                                            $tmpthisTurnover = $optsss['options']['turnover'];																	}
                                        if ($optsss['options']['type'] == $raiting_type) {
                                            if ($bewertung == '') {$bewertung = $optsss['options']['10rating']; }																	}
                                    }
                                }
                            }

                            foreach ($tmpthisatOps['facts'] as $odpid => $dtt) {
                                if ($dtt['shortname'] == 'Software') {
                                    $thisopertatorOps['facts']['Software'] =  $dtt[0];
                                }
                            }
                            if ($options['bonus_type'] != 'Exclusive') {
                                echo '<div class="row">';
                            } else {
                                echo '<div class="row exclusive">';
                            }
                            if ($options['bonus_type'] == 'Exclusive') {
                                echo $LTbl->PrintExclusive_plugin("");
                            }
//											//PLACE
//											echo '<div style="width:60px;" class="rsp_platz numberss"><div class="numbersV">'.$rowcounter.'</div></div>';
                            //LOGO
                            echo '<a href="/go/'.strtolower(str_replace(" ","-",$bookie)).'/" target="_blank" rel="nofollow" class="boxx rsp_casino" style="width:80px;">';
										if (preg_match('#[0-9]#',substr(strtolower(str_replace(" ","-",$bookie)), 0, 1))) {
										     echo '<img class="img-'.strtolower(str_replace(" ","-",$bookie)).'-105x53" alt=""    src="/wp-content/plugins/My-Meta-Box-master/logos/105x53/'.strip4url($bookie).'_105x53.png" style= "width: 100px; margin-top: 17px;"></a>';
										 }
										else {	
										         echo '<img class="'.strtolower(str_replace(" ","-",$bookie)).'-105x53" alt="" src="/wp-content/plugins/My-Meta-Box-master/logos/105x53/'.strip4url($bookie).'_105x53.png" style= "width: 100px; margin-top: 17px;"></a>';
										    }
                            //MAXBONUS

                            echo '<div style="width:8%;" class="boxx rsp_maxbonus valuee" rel="srt_1'.$t_name.'" sortvalue="';
                            if ($options['maxamount']['usd'] != '') { echo EncodeSpecialCharacters($options['maxamount']['usd']); } else { echo EncodeSpecialCharacters($options['maxamount']['eur']); }
                            echo '"><span style="line-height:80px;">';
                            if ($options['maxamount']['usd'] != '') { echo EncodeSpecialCharacters($options['maxamount']['usd']).'$'; } else { echo EncodeSpecialCharacters($options['maxamount']['eur']).'€'; }
                            echo'</span></div>';

                            //FIRSTBONUS
                            echo '<div style="width:8%;" class="boxx rsp_firstbonus valuee" rel="srt_2'.$t_name.'" sortvalue="'; if ($options['amount']['eur'] != '') { echo EncodeSpecialCharacters($options['amount']['eur']);} else { echo EncodeSpecialCharacters($options['amount']['gbp']);} echo '"><span style="font-weight: 600;line-height: 80px;">';if ($options['amount']['eur'] != '') { echo EncodeSpecialCharacters($options['amount']['eur']);} else { echo EncodeSpecialCharacters($options['amount']['gbp']);}			if ($options['amount']['eur'] != '') { echo '€';} else { } echo'</span></div>';

                            //Procent
                            echo '<div style="width:8%;" class="boxx rsp_prozent valuee" rel="srt_3'.$t_name.'" sortvalue="'.EncodeSpecialCharacters($options['percentage']).'"><span style="font-weight: 600;line-height: 80px;">'.EncodeSpecialCharacters($options['percentage']).'';				if ($options['percentage'] != '') { echo '%';} else { } echo '</span></div>';

                            //BONUSCODE
//                            echo '<div style="width:10%" class="rsp_bonuscode valuee" ><span style="font-size: 12px; line-height: 15px;">'.EncodeSpecialCharacters($options['bonuscode']).'</span></div>';

                            //PAYPAL
                            echo '<div style="width:12%;" class="boxx rsp_paypal valuee" rel="srt_4'.$t_name.'" sortvalue="'.$paypal.'"><span>';
                            if ($paypal == 'yes') { ?><img src="/wp-content/plugins/My-Meta-Box-master/customs/images/paypal.png " style="margin-left: 10px;"><?php } else { }
                            echo '</span></div>';

                            //BEWERTUNG
                            echo '<div style="width:8%" class="boxx rsp_bewertung valuee rating10" rel="srt_5'.$t_name.'" sortvalue="'.EncodeSpecialCharacters($bewertung).'"><span><div>'.EncodeSpecialCharacters($bewertung).'</div></span></div>';

                            //ZUM CASINO
                            echo '<div style="width:26%" class="boxx rsp_zumanbieter zumcasino"><div class="zumCasinoV"><a href="/go/'.strtolower(str_replace(" ","-", str_replace(".", "-", $bookie))).'/" class="btn btn-large btn-warning btn-block" rel="nofollow" target="_blank"><span class="icon-forward"></span> Zum Online Casino</a><a href="/paypal-online-casinos/'.strtolower(str_replace(" ","-", str_replace(".", "-", $bookie))).'-paypal/" class="testlink">'.$bookie.' Paypal Einzahlung</a></div></div>';

                            echo '</div>';
                            $thisopertatorOps = '';
                            $android = '';
                            $bewertung = '';
                            $rowcounter++;
                        }
                    }

                }
            }
            ?>

        </div>
    </div>
<?php if ($_POST['action'] != 'tabs_loader') { $GLOBALS['custom'][] = $LTbl->InsertSorter_plugin(""); } ?>