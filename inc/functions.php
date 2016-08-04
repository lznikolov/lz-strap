<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 26.7.2016 г.
 * Time: 19:12
 */

// Operator Affiliate Link cloaking
require_once($_SERVER["DOCUMENT_ROOT"] . '/go/data_cloak.php');
/*--------------------------------------------------------------------------------------------------------------------*/
/**
 * Return the JSON Id for the current language
 * @param string $jsonFile The Filename of the JSON File which is find in [en,de,...]custom_content/json/SITE_MANE [LANGUAGE].json
 * @return int The id of the JSON
 */
function getJSONGroupId($jsonFile)
{
    $file = ABSPATH . $jsonFile . '_dbarray.json';
    $string = file_get_contents($file);
    $json = json_decode($string, true);
    $idElement = current($json['bonusgroups']);
    $id = $idElement['id'];
    return $id;
}

/*--------------------------------------------------------------------------------------------------------------------*/
/**
 * Escape the Current Operator name and convert it to a concatenated string
 * @param string $operatorName
 * @return string
 */
function operatorEscapeName($operatorName)
{
    return strtolower(preg_replace('/\\s+/', '', $operatorName));
}

function operatorEscapeName3($operatorName, $logoType = 'casino')
{
    $search_for = array("/[\\s-]+/", "/{$logoType}$/i");
    $replacement_with = array("", "");

    return strtolower(preg_replace($search_for, $replacement_with, $operatorName));
}

/**
 * Remove casino at the end ot the string and then remove white spaces and dashes so we can match the filename structure of the images
 * ex: mr green -> mrgreen
 * intercasino -> inter
 * bet-at-home casino -> betathome
 * @param string $operatorName The Current Operator name
 * @param string $logoSize The size of the logo
 * @param string $logoType casino, sport, poker
 * @param string $logoColor white, bnw, empty
 * @param string $fileExtension Default extension is PNG
 * @return string The Path to the Operator logo
 */
function operatorImagePath($operatorName, $logoSize = '105x53', $logoType = 'casino', $logoColor = '', $fileExtension = 'png')
{
    $search_for = array("/[\\s-]+/", "/{$logoType}$/i");
    $replacement_with = array("", "");
    if (!empty($logoColor)) {
        $logoColor = '_' . $logoColor;
    }
    return '/assets/images/logos-' . $logoSize . '' . $logoColor . '/' . $logoType . '/' . strtolower(preg_replace($search_for, $replacement_with, $operatorName)) . '.' . $fileExtension;
}

/**
 * Generate a URL to the Operator Affiliate Page
 * @param string $operatorName The Name of the operator from the DB
 * @param string $affiliateType The type of affiliate used at the current link: ex:[website,website3,...]
 * @param string $container the container of the URL
 * @param bool $traceable if we gonna generate a tracking url or not
 * @param string $scheme 'http', 'https', 'login', 'login_post', 'admin', or 'relative'
 * @return string
 */
function operatorPageURL($operatorName, $affiliateType = '', $container = '', $traceable = false, $scheme = 'https')
{
    $operator = strtolower(preg_replace('/\\s+/', '-', $operatorName));

    $args = array(
        "lang" => get_locale(),
        "url" => $_SERVER['REQUEST_URI'],
        "operator" => $operator,
        "type" => $affiliateType,
        "container" => $container,
        "user-agent" => $_SERVER['HTTP_USER_AGENT'],
        "ip" => $_SERVER['REMOTE_ADDR']
    );

    $data = operatorEncodeJSON($args);

    if (empty($affiliateType)) {
        return site_url($operator, $scheme);
    } elseif ($traceable) {
        return site_url('go/' . $data, $scheme);
    } else {
        $goLink = 'go/';
        $operator = operatorEscapeName3($operator);
        switch (get_current_blog_id()) {
            case 1:
                $goLink = $goLink.'en/';
                break;
            case 2:
                $goLink = $goLink.'de/';
                break;
        }
        switch ($affiliateType) {
            case 'normal' :
                $goLink = $goLink.$operator . '/';
                break;
            case 'popunder':
                $goLink = $goLink.$operator . '/3website';
                break;
            case 'newsletter':
                $goLink = $goLink.$operator . '/5website';
                break;
        }

        return network_site_url().$goLink;
    }
}

/*--------------------------------------------------------------------------------------------------------------------*/
//custom size excerpt
function get_excerpt()
{
    $excerpt = get_the_content();
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, 160);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '... <a href="' . $permalink . '">[...]</a>';
    return $excerpt;
}