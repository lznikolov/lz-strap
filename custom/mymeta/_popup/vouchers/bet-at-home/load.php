<?php
if ($_POST['sendGutschein'] != 'yes') {

echo '
<div class="modal-dialog modal-bonuses" id="operator-form">
    <div class="modal-content voucher" id="popupContent">                                    
        <div class="modal-header">
            <div class="col-sm-12">
                <div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span>'.$popupTitle.'</span></h4>
                </div>
            </div>
        </div>
        
        <div class="modal-body" id="main-body">
            <div class="row">
                <div class="col-md-6 col-xs-12 nodeposit">
                    <div class="popupSpec-left">
                        <a class="popup-img" target="_blank" rel="nofollow" href="' . getGoUrl($popupOperator, 1) . '">
                            <img src="/assets/images/logos_105x53/'.strip4url($popupOperator).'_105x53.png">
                        </a>
                    </div>
    
                    <div class="popupSpec-left">
                        <a href="' . getGoUrl($popupOperator, 3) . '" rel="nofollow" target="_blank" data-url="'.$GLOBALS['linkUrl'].'go/'.strip4url($popupOperator).'/" data-bon="4548" data-bonid="40" data-operator="'.strip4url($popupOperator).'">
                            <div class="boxes-boxButton2 buttons-orangeGrad hvr-wobble-horizontal popup" style="font-size:0.7em;">
                                Jetzt bei '.$popupOperator.' registrieren!
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </div>
                        </a>
                    </div>
                        
                    <div class="popupSpec-left">
                        <input  type="text" class="namemm" placeholder="Wettkontonummer" name="user"  id="voucher_user"/>
                    </div>
                    
                    <div class="popupSpec-left">
                        <input type="email" class="emaill" placeholder="Ihre eMail-Adresse" name="email" id="voucher_email"/>
                    </div>
                
                    <div class="popupSpec-left">
                        <button class="emailCTAButtMini torightbookie_green hvr-wobble-horizontal " style="margin: 0px auto;display: block;">Gutschein anfordern</button>
                    </div>
                </div>
                
                
                <div class="col-md-6 col-xs-12">
                    <p>'.$_SERVER['HTTP_HOST'].' präsentiert in Kooperation mit bet-at-home diese exklusive Promotion für alle Neukunden von bet-at-home. Wir schenken ihnen 7 EUR Startguthaben ohne eine vorherige Einzahlung bei bet-at-home.</p>
                    <p>Registrieren Sie sich in 2 Minuten kostenlos bei bet-at-home. Sie erhalten den Gutschein ausschließlich wenn Sie sich über diesen Link registrieren</p>
                    <p>Tragen Sie nach der Registrierung hier Ihre neue bet-at-home Wettkontonummer ein.</p>
                    <p>An diese eMail-Adresse schicken wir Ihnen den bet-at-home 7 EUR Wettgutschein.</p>
                </div>
            
            
                <div class="col-xs-12 text-center _results" style="text-align: left; padding-left: 150px;"></div>
                <div class="'.$thiscurnameis.'_results " style="text-align: left; padding-left: 150px;"></div>
            </div>
        </div>
        
        
        <div class="modal-body sendalert" style="display:none;">
        </div>
    </div>
</div>'; ?>

<script type='text/javascript'> var operartor_voucher = 'bet-at-home';</script>

<?php
}
else {



    function contact_form_mail($to, $subject, $message, $headers, $charset = 'utf-8', $from)
    {

        $ext_headers  = $headers;
        $ext_headers  = 'MIME-Version: 1.0' . PHP_EOL;
        $ext_headers .= 'Content-type: text/html; charset=\"utf-8\"\r\n' . PHP_EOL;
        $ext_headers .= "From: ".$_SERVER['SERVER_NAME']." <".$from.">".PHP_EOL;

		$mysubject = "Bet-at-home voucher request from ".$_SERVER['HTTP_HOST']." client with IP: ".get_client_ip()."";

        $ext_message  = $message;

        $res = mail($to, $mysubject, $ext_message, $ext_headers);

        return $res;
    }
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
$params = array(
		"account_number" => $_POST["name"],
		"email" => $_POST["email"],
		"ip" => get_client_ip(),
		"date" => null,
		"host" => $_SERVER['HTTP_HOST'],
		"status" => 0,
		"campain" => 1,
		"operator" => 1
	);

	// Make the request
	$url = "http://luckylabz.com/vouchers/api/put";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($params));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);

	if ($output === FALSE) {
	  echo "Leider ist unsere Gutschein-Datenbank momentan nicht erreichbar. Bitte versuchen Sie es später noch einmal.";
	} else {

		$output_messages = json_decode($output, true);
		// print_r($output_messages);
		if(is_array($output_messages)){
			foreach($output_messages as $id_message => $message){
				echo $message.'<br />';
			}
		}

	}

    //contact_form_mail("bet-at-home-gutschein@luckylabz.com", $_POST['email'], $message, '', 'utf-8', $_POST['email']);
}