<?php
if (!function_exists(sorttounnums)) {
    function sorttounnums($curvas) {
        $curvas = str_replace(".","",$curvas);
        $curvas = str_replace("€","",$curvas);
        $curvas = str_replace("$","",$curvas);
        $curvas = str_replace(" ","",$curvas);
        return $curvas;
    }
}
require_once("".$_SERVER['DOCUMENT_ROOT']."/custom_content/classExtractor/class.extractor.php");
$DB = new getDBprinter;
$GLOBALS['DB'] = $DB->jsonarray;
include_once("".$_SERVER['DOCUMENT_ROOT']."/custom_content/tables/fn.class.php");
$LTbl = new LuckyTables;
$verchArray = bonus_group_extra("69","Standard","","","Exclusive");

$t_name = 'vergleich';
$t_maxoperators = 100;

//REMOVE FIELDS FOR RESPONSIVE
$respPhone = array('platz','software','ohnezahlung','prozent','bonuscode', 'firstbonus');
$PhoneHiddenLabels = array('zumanbieter','','');
$respTablet = array('numbers','software','ohnezahlung','bonuscode');

//RESIZE FIELDS FOR RESPONSIVE
$respPhoneWidths = array('zumanbieter->98%','maxbonus->19%','bewertung->19%', 'paypal->19%');
$respTabletWidths = array('zumanbieter->12%','bewertung->19%','maxbonus->12%','prozent->11%');
$respPhoneLabels = 'no';

echo $LTbl->TableResponsive($respPhone,$respPhoneWidths,$respTablet,$respTabletWidths,$respPhoneLabels,$respTabletLabels,$PhoneHiddenLabels);
echo $LTbl->TableCss("");

//LABELS
$labelsEx = array
(
	"casino"                    =>array   ("Wettanbieter", "70px", "", ""),
	"firstbonus"                    =>array   ("Maximaler Bonus", "9%", "sortable", ""),
	"prozent"                   =>array   ("Prozent", "9%", "sortable", ""),
	"bonuscode"             =>array   ("Bonuscode", "12%", "", ""),
	"paypal"                    =>array   ("PayPal", "12%", "", ""),
	"bewertung"                 =>array   ("Bewertung", "9%", "sortable", ""),
	"zumanbieter"               =>array   ("Zum Anbieter", "19%", "", "zumcasino")
);
$verchArray = BonusesByOption($verchArray,"Deposit Method","paypal","yes");
$the_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish')); 
$all_urls = array(); 
while ($the_query->have_posts()) { 
$the_query->the_post(); 
$all_urls[] = get_permalink(); 
}
?>
	<div class="linestatistichov"></div>
	<div class="bonuses"  id="<?php echo $t_name;?>">
		<div class="bonus sortabletable">
			<?php
			//REMOVING UNNESESERRY VALUES
			unset($vergleichArray['avaiblefields']["69"]['type']);
			//PRINTING LABELS
			echo $LTbl->printTblLabels($labelsEx,$t_name);
			$rowcounter = 1;
			//PRINTING TABLE CONTENT
			$t_maxoperscount = 0;
			foreach ($verchArray as $bookie => $options)
			{
				if ($t_maxoperators != $t_maxoperscount) {
					$t_maxoperscount++;
					if ($bookie != 'avaiblefields') {
						if ($options != 'contains_no_bonuses') {
							$paymentOperator = '';
							$tmpthisnoDeposit = '';
							foreach ($GLOBALS['DB']['operators'] as $opid => $opertt) {
								if ($bookie == $opertt['shortname']) {
									$tmpthisatOps = $opertt;

									foreach ($opertt['bonuses'] as $dddas => $optsss) {
										if ($optsss['options']['type'] == 'Deposit Method') {
											$paymentOperator = $optsss['options']['paypal'];
										}
										if ($optsss['options']['type'] == 'No-Deposit') {
											$tmpthisnoDeposit = $optsss['options']['amount']['eur'];                                                                    
										}
										if ($optsss['options']['type'] == 'Standard') {
											$tmpthisTurnover = $optsss['options']['turnover'];                                                                 
										}
										if ($optsss['options']['type'] == 'Ratings') {
											if ($bewertung == '') {
												$bewertung = $optsss['options']['10rating']; 
											}
										}
									}
								}
							}


							foreach ($tmpthisatOps['facts'] as $odpid => $dtt) {
								if ($dtt['name'] == 'Software') {
									$thisopertatorOps['facts']['Software'] =  $dtt[0];
								}
							}
							
							if($paymentOperator == 'yes'){
								
								if ($options['bonus_type'] != 'Exclusive') {
									echo '<div class="row">';
								} else {
									echo '<div class="row exclusive">';
								}
								if ($options['bonus_type'] == 'Exclusive') {
									echo $LTbl->PrintExclusive("");
								}
								//LOGO
								echo '<a class="paymentTable-logoLink" href="/go/'.strip4url(str_replace(".","-",($clean_link))).'/" target="_blank" rel="nofollow">
									<img class="paymentTable-logoLogo" src="/wp-content/plugins/My-Meta-Box-master/logos/105x53/'.strip4url($bookie).'_105x53.png"/>
								  </a>';

								//MAXBONUS

								echo '<div class="paymentTable-maxbonus boxx rsp_maxbonus valuee tbl_sortable" rel="srt_1'.$t_name.'" sortvalue="';
								if ($options['maxamount']['usd'] != '') {
									echo EncodeSpecialCharacters($options['maxamount']['usd']); 
								} else {
									echo EncodeSpecialCharacters($options['maxamount']['eur']); 
								}
								echo '"><span>';
								if ($options['maxamount']['usd'] != '') { 
									echo EncodeSpecialCharacters($options['maxamount']['usd']).'$'; 
								} else { 
									echo EncodeSpecialCharacters($options['maxamount']['eur']).'€'; 
								}
								echo'</span></div>';

								//FIRSTBONUS
								if($options['amount']['eur'] != '' && !is_numeric($options['amount']['eur'] )) {
									$options['amount']['eur'] = 0;
								}
								echo '<div paymentTable-firstbonus boxx rsp_firstbonus valuee tbl_sortable" rel="srt_1'.$t_name.'" sortvalue="'; 
								if ($options['amount']['eur'] != '')
								{ 
									echo sorttounnums(EncodeSpecialCharacters($options['amount']['eur']));
								} else {
									echo sorttounnums(EncodeSpecialCharacters($options['amount']['gbp'])); 
								} 
								echo '"><span class="paymentTable-boxAmount">';
								if ($options['amount']['eur'] != '') { 
									echo sorttounnums(EncodeSpecialCharacters($options['amount']['eur']));
								} else { 
									echo sorttounnums(EncodeSpecialCharacters($options['amount']['gbp']));
								} 
								if ($options['amount']['eur'] != '') {
									echo '€';
								} 
								echo'</span></div>';

								//Procent
								if($options['percentage'] != '' && !is_numeric($options['percentage'] )) {
									$options['percentage'] = '';
								}
								echo '<div class="paymentTable-prozent boxx rsp_prozent valuee tbl_sortable" rel="srt_2'.$t_name.'" sortvalue="'.EncodeSpecialCharacters($options['percentage']).'">
										<span class="paymentTable-boxAmount">'.EncodeSpecialCharacters($options['percentage']).'';
										if ($options['percentage'] != '') {
								 	 		echo '%';
								 	 	} 
								 	echo '</span></div>';

								//BONUSCODE
								echo '<div class="paymentTable-bonuscode boxx rsp_bonuscode valuee" >
									<span class="paymentTable-bonuscodeAmount">'
										.EncodeSpecialCharacters($options['bonuscode']).
									'</span></div>';

								//PAYPAL
								echo '<div class="paymentTable-paymentLogo boxx rsp_paypal valuee" ><span>';
								if ($paymentOperator == 'yes') { ?>
									<img class="paymentTable-paymentImg" src="https://wettbonus-ohne-einzahlung.net/custom_content/images/paypal.png/">
								<?php } echo '</span></div>';

								//BEWERTUNG
								echo '<div class="paymentTable-bewerung" class="boxx rsp_bewertung valuee rating10 tbl_sortable" rel="srt_3'.$t_name.'" sortvalue="'
								.EncodeSpecialCharacters($bewertung).'">
								<span><div>'.EncodeSpecialCharacters($bewertung).
								'</div></span></div>';

								//ZUM CASINO
								echo '<div class="paymentTable-Button boxx rsp_zumanbieter zumcasino">
								 		<div class="paymentTable-ButtonInner zumCasinoV">
								 			<a href="/go/'.strtolower(str_replace(" ","-", str_replace(".", "-", $bookie))).'/" class="btn btn-large btn-warning btn-block " rel="nofollow" target="_blank">
									 			<span class="icon-forward"></span> 
									 			Jetzt Bonus sichern!
								 			</a>';
											$link ='https://wettbonus-ohne-einzahlung.net/'.strtolower(str_replace(" ", "-", $bookie)).'-bonus/';
								
								 
								echo '<a href="https://wettbonus-ohne-einzahlung.net/'.strtolower(str_replace(" ","-", str_replace(".", "-", $bookie))).'-bonus/" class="testlink">'.$bookie.' Bonus</a>
								</div></div>';
								
								echo '</div>';
								$thisopertatorOps = '';
								$android = '';
								$bewertung = '';
								$rowcounter++;
								$paymentOperator = '';
							}
						}
					}
				}
			}
			?>
		</div>
	</div>
<?php if ($_POST['action'] != 'tabs_loader') { $GLOBALS['custom'][] = $LTbl->InsertSorter(""); } ?>

<style type="text/css">
	.paymentTable-bonuscode {
		width: 12%;
	}
	.paymentTable-paymentLogo {
		width:12%;
	}
	.paymentTable-paymentImg{
		margin-left: 10px;
	}
	.paymentTable-bewerung{
		width:9%;
	}
	.paymentTable-Button{
		width:12%;
	}
	.paymentTable-ButtonInner{
		padding-top:20px;
	}
	.paymentTable-bonuscodeAmount{
		font-size: 12px;
		line-height: 15px;
	}
</style>