<?php
/* GENERATE IMG SRCs AND LINK PATHS LIKE THIS
IMG         SRC:    <img src="<?php echo $GLOBALS['imgUrl2']; ?>header.png">
NORMAL      LINK:   <a href="<?php echo getUrl($string); ?>">Poker Bonus</a>
OPERATOR    LINK:   <a href="<?php echo getUrl($shortname, $type); ?>">Poker Bonus</a>
GO          LINK:   <a href="<?php echo getGoUrl($shortname, $type); ?>">Poker Bonus</a>
EXTRA       STRING: <span>">Poker Bonus <?php echo getExtraString($type); ?></span>

 * GET BONUS ARRAYS LIKE THIS
$operShortnameOrID = '';
$bonusType = 'Standard';
$bonusReplace = 'Exclusive';
$unsetBonusCheck = '($options["asianhandicap"] == "yes") && ($options["maxdeposit"] == "100")';
$unsetStandartCheck = '$standartOptions["wettsteuer"] == "Alle Wetten freitags ohne Wettsteuer"';
$bonusLimit = '';
$unsetSetTypeCheck = 'Exclusive';   // Changes $unsetStandartCheck to other bonus type - its optional and default is "Standard"

$bonuses = getBonuses($operShortnameOrID, $bonusType, $bonusReplace, $unsetBonusCheck, $unsetStandartCheck, $bonusLimit, '', '', $unsetSetTypeCheck);

 * GET FACT ARRAYS LIKE THIS
$operShortnameOrIDFacts = '511';
$factType = 'positive';     //positive or negative
$factLimit = '5';

$pros = getFacts($operShortnameOrIDFacts, $factType, $factLimit);

 * GET CURRENT PAGE ID, OPERATOR or GLOBAL BONUS ARRAY
$GLOBALS['curentPage']
$GLOBALS['curentOperator']
$GLOBALS['bonusArray']

 * EXTRA FUNCTIONS
SORT ONE DIMENTIONAL INDEXED ARRAY BY 2 CRITERIAS EXAMPLES:
sortBy2Criteria($array, 1, 0);
sortBy2Criteria($array, 0, 1);
sortBy2Criteria($array, 'rating', 'amount');

*/
/*
$site_id = get_current_blog_id();
if (is_multisite()) {
    if ($site_id == 1) {
        $GLOBALS['json_path'] = ABSPATH . 'en/custom_content/json'; // /kunden/460273_59555/webseiten/casino-apps.com/en/custom_content/json
        $GLOBALS['bonusGroup'] = $bonusGroup = 116; //vzima se ot json na syotvetnata language
        $GLOBALS['goLink'] = $goLink = network_site_url() . 'go/';
        $GLOBALS['site'] = $site_id; //izpolzwa se plugin-a LuckyLabz admin-menu.php
    } elseif ($site_id == 2) {
        $GLOBALS['json_path'] = ABSPATH . 'custom_content/json'; // /kunden/460273_59555/webseiten/casino-apps.com/custom_content/json
        $GLOBALS['bonusGroup'] = $bonusGroup = 119; //vzima se ot json na syotvetnata language
        $GLOBALS['goLink'] = $goLink = network_site_url() . 'go/de/';
        $GLOBALS['site'] = $site_id;
    }
} else {
    $GLOBALS['json_path'] = ABSPATH . '/custom_content/json';
    $GLOBALS['bonusGroup'] = $bonusGroup = 119; //vzima se ot json na syotvetnata language
    $GLOBALS['goLink'] = $goLink = network_site_url() . 'go/de/';
    $GLOBALS['site'] = $site_id;
}

*/
/*GET CURRENT PAGE ID*/
$GLOBALS['curentPage'] =  get_the_ID();
$GLOBALS['curentOperator'] = get_post_meta($GLOBALS['curentPage'], 'llbz_operator', true);

/*OPTIONS*/
//$GLOBALS['siteH1'] = get_the_title();

/* aftercklick,custom/newsletter.php */
$GLOBALS['siteNameString'] = 'Casino Apps';     //Project name

/*
tab1, tab2, tab3
options.php
popup/newsletter
popup
operatorTable
*/
$GLOBALS['siteUrlString'] = 'casino-apps.com';                      //Project domain

//$blog_details = get_blog_details();

//$GLOBALS['bonusGroup'] = '116';     //Bonusgroup
// 1 -  MAINSITE, 2 - subsite
/*
 premesteno vav function.php

if( get_current_blog_id() == 1){
    //mainsite
    include($themeUrl."language/english.php");
    $menu_path = 'mainsite-menu.php';
    $GLOBALS['bonusGroup'] = $bonusGroup = '116';
    $GLOBALS['goLink'] = $goLink = network_site_url().'go/';

}elseif( get_current_blog_id() == 2){
    //subsite
    include($themeUrl."language/german.php");
    $menu_path = 'subsite-menu.php';
    $GLOBALS['bonusGroup'] = $bonusGroup = '119';
    $GLOBALS['goLink'] = $goLink = network_site_url().'go/de/';
}
*/


/*
comments, options
*/
$GLOBALS['connection'] = 'https';   //HTTP connection type

$GLOBALS['themeUrl'] = '/wp-content/themes/mini-strap/';    //Theme default folder
/* options, news */
$GLOBALS['newsCategory'] = 3;                             //Site type

/* comments, cta_boxes,options,bookiereview,operator-apps,function */
$GLOBALS['jsonType'] = 'casino';

/* newsletter_sidebar,options,newsletter */
$GLOBALS['newsletterAction'] = '';     							//Subscribe Form LINK - should be either direct link like:
//'http://luckymailz.com/mailer/form.php?form=11' with different number in the end
//OR '/subscribe/' - link to be inside domain so that won't break https

/* subscribeTemplate, options */
$GLOBALS['subscribeFormID'] = ''; 								//Subscribe ID form - taken from newsletter system

// $themeUrl = $GLOBALS['themeUrl'];

/* comments, cta_boxes, options, bookiereview, operator-apps, functions */
if ($GLOBALS['jsonType'] == 'casino') {                     // Determine Ratings
    /* class.extractor, operator-apps, options  */
    $GLOBALS['raitingType'] = 'Casino Ratings';
}
else {
    /* class.extractor, operator-apps, options, paypal-morebutton  */
    $GLOBALS['raitingType'] = 'Ratings';
}



/* afterclick, options, footer */
$GLOBALS['facebookPageUrl'] = 'https://www.facebook.com/Wettgutscheininfo-283530125104270/';
/* options, footer */
$GLOBALS['twitterPageUrl'] = 'https://twitter.com/@wettgutschein';
/* options, footer */
$GLOBALS['googlePlusPageUrl'] = 'https://plus.google.com/u/0/114279485183377636503/posts';
/* options */
$GLOBALS['emailPageUrl'] = 'mailto:mini-strap@luckylabz.com';

/*SPECIAL VOUCHERS*/
$GLOBALS['vouchers'] = array('bet-at-home', 'interwetten');

/*AUTO GENERATED*/
$addsAfterTitle = date("F Y");                  //Adds this after the title of the pages

$GLOBALS['linkUrl'] = home_url('/', $GLOBALS['connection']);                                       //No need to change the url for links all over the code
$GLOBALS['imgUrl2'] = home_url($GLOBALS['themeUrl'].'custom/images/', $GLOBALS['connection']);     //No need to change the url for images all over the code
$GLOBALS['imglogos'] = home_url($GLOBALS['themeUrl'].'custom/images/logos_105x53/', $GLOBALS['connection']);
$GLOBALS['imglogom'] = home_url($GLOBALS['themeUrl'].'custom/images/logo-menu/', $GLOBALS['connection']);

/*Shorter variables*/
$GLOBALS['bonusGroupArray'] = $GLOBALS['DB']['bonusgroups'][$GLOBALS['bonusGroup']]['operators'];
$GLOBALS['operatorsArray'] = $GLOBALS['DB']['operators'];
$GLOBALS['operatorCount'] = count($GLOBALS['bonusGroupArray']);

$operShortnameOrID = '';
$bonusType = '';
$bonusReplace = '';
$unsetBonusCheck = '';
$unsetStandartCheck = '';
$bonusLimit = '';

$GLOBALS['bonusArray'] = getBonuses($operShortnameOrID, $bonusType, $bonusReplace, $unsetBonusCheck, $unsetStandartCheck, $bonusLimit, 1);