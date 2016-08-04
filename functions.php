<?php
/*--------------------------------------------------------------------------------------------------------------------*/
load_theme_textdomain('mini-strap', get_template_directory() . '/languages');
setlocale(LC_ALL, get_locale() . ".utf8");
/*--------------------------------------------------------------------------------------------------------------------*/
//WP AJAX Requests
require_once(get_template_directory() . "/inc/ajax.php");
//actions
require_once(get_template_directory() . "/inc/actions.php");
//shortcodes
require_once(get_template_directory() . "/inc/shortcodes.php");
//filters
require_once(get_template_directory() . "/inc/filters.php");
//custom functions
require_once(get_template_directory() . "/inc/functions.php");
/*--------------------------------------------------------------------------------------------------------------------*/
$site_id = get_current_blog_id();

if (is_multisite()) {
    if ($site_id == 1) {
        $GLOBALS['json_path'] = ABSPATH . 'en/custom_content/json'; //izpolzwa se oz class extractor
        $GLOBALS['bonusGroup'] = $bonusGroup = getJSONGroupId('en/custom_content/json/Casino-Apps.com');
        $GLOBALS['goLink'] = $goLink = network_site_url() . 'go/';
        $GLOBALS['site'] = $site_id; //izpolzwa se plugin-a LuckyLabz admin-menu.php
    } elseif ($site_id == 2) {
        $GLOBALS['json_path'] = ABSPATH . 'custom_content/json'; //
        $GLOBALS['bonusGroup'] = $bonusGroup = getJSONGroupId('custom_content/json/Casino-Apps.com German');
        $GLOBALS['goLink'] = $goLink = network_site_url() . 'go/de/';
        $GLOBALS['site'] = $site_id;
    }
} else {
    $GLOBALS['json_path'] = ABSPATH . '/custom_content/json';
    $GLOBALS['jsonPath1'] = $GLOBALS['json_path']; //za da raboti My-Meta-Box-master
    $GLOBALS['bonusGroup'] = $bonusGroup = getJSONGroupId('custom_content/json/Casino-Apps.com');
    $GLOBALS['goLink'] = $goLink = network_site_url() . 'go/de/';
    $GLOBALS['site'] = $site_id;
}

/*--------------------------------------------------------------------------------------------------------------------*/
//Enables featured images for post and pages
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
/*--------------------------------------------------------------------------------------------------------------------*/
//register the LZ sidebar in the theme option
if (function_exists('register_sidebar')) {
    //register_sidebar();
    register_sidebar(array(
        'id' => 'lz-sidebar',
        'name' => 'LZ Operators Sidebar',
        'description' => 'LuckyLabz Sidebar',
        'before_widget' => '<aside id="%1$s" class="row widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="page-header text-center text-uppercase"><strong><span class="dot">',
        'after_title' => '</span></strong></div>'));
}
/*--------------------------------------------------------------------------------------------------------------------*/

/*Get DB connect*/
//include('custom/dbconnect.php');

/*Get Newsletter info*/
/*
$result = $link->query("SELECT * FROM `newslettermeta` WHERE `bookie`='allcount'");
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $GLOBALS['newsletterClicks'] = $row['clicks'];
    }
}
*/
/*
function cta_boxes_func($atts)
{

    extract(shortcode_atts(array(
        'operator' => '',
        'boperator' => '',
        'multiple' => '',
        'other' => '',
    ), $atts));
    $boperator = $operator;

    ob_start();

    if ($multiple == 1) {
        include($_SERVER["DOCUMENT_ROOT"] . "/wp-content/themes/mini-strap/custom/cta_boxes.php");
    } else {
        include_once($_SERVER["DOCUMENT_ROOT"] . "/wp-content/themes/mini-strap/custom/cta_boxes.php");
    }

    $out = ob_get_clean();
    return $out;
}

add_shortcode("cta_boxes", "cta_boxes_func");
*/
//related pages
/*
function wpb_related_pages()
{
    $orig_post = $post;
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        $tag_ids = array();
        foreach ($tags as $individual_tag)
            $tag_ids[] = $individual_tag->term_id;
        $args = array(
            'post_type' => 'page',
            'tag__in' => $tag_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => 10
        );
        $GLOBALS['relatedPages'] = new WP_Query($args);
    }
    $post = $orig_post;
    wp_reset_query();
}
*/
/*
//Get Url
$GLOBALS['getUrlTypes'] = array('-gutschein', '-erfahrungen');            //Define getUrl types
function getUrl($value = "", $type = 0)
{

    if ($value == "") {
        $urlFinal = $GLOBALS['linkUrl'];
        return $urlFinal;
    } else {
        if ($type == 0) {
            $urlFinal = $GLOBALS['linkUrl'] . $value . '/';
            return $urlFinal;
        } elseif ($type > 0 and $type <= count($GLOBALS['getUrlTypes'])) {
            $shortname = strip4url($value);

            if (strpos($shortname, $GLOBALS['jsonType']) !== false) {
                $addExtra = '';
            } else {
                $addExtra = '';
            }

            $urlFinal = $GLOBALS['linkUrl'] . $shortname . $addExtra . $GLOBALS['getUrlTypes'][$type - 1] . '/';
            return $urlFinal;
        } else {
            return "<script type='text/javascript'>console.log('Wrong url type provided for getUrl function!');</script>";
        }
    }
}

//Get Go Url
$GLOBALS['getGoUrlTypes'] = array('', '2website', '/5website');            //Define getGoUrl types
function getGoUrl($value, $type)
{
    if ($type > 0 and $type <= count($GLOBALS['getGoUrlTypes'])) {
        $shortname = strip4url($value);

        $urlFinal = $GLOBALS['linkUrl'] . 'go/' . $shortname . $GLOBALS['getGoUrlTypes'][$type - 1] . '/';
        return $urlFinal;
    } else {
        return "<script type='text/javascript'>console.log('Wrong url type provided for getGoUrl function!');</script>";
    }
}

//Get Extra String
$GLOBALS['getExtraStringTypes'] = array('', 'App');                          //Define getExtraString types
function getExtraString($type)
{
    if ($type > 0 and $type <= count($GLOBALS['getExtraStringTypes'])) {

        $extraString = $GLOBALS['getExtraStringTypes'][$type - 1];
        return $extraString;
    } else {
        return "<script type='text/javascript'>console.log('Wrong string type provided for getExtraString function!');</script>";
    }
}

//Get Sort By 2 Criteria
function sortBy2Criteria($sortedArray, $crit1 = 0, $crit2 = 1)
{
    uasort($sortedArray, function ($a, $b) use ($crit1, $crit2) {
        if ($a[$crit1] == $b[$crit1]) {
            // Freespins are same, order by rating
            if ($a[$crit2] < $b[$crit2]) return 1;
        }
        // Sort by freespins
        return $a[$crit1] < $b[$crit1] ? 1 : -1;
    });
    return $sortedArray;
}
*/
/*
//Anchor cta
function cta_anchor_func($atts)
{

    extract(shortcode_atts(array(
        'element' => array(),
        'titles' => array(),
        'menu' => '',
        'multiple' => '',
    ), $atts));

    $element = $element;
    $titles = explode(" | ", $titles);

    ob_start();

    if ($multiple == 1) {
        if ($menu == 1) {
            $GLOBALS['ctaAnchorTitles'] = $titles;
            $GLOBALS['ctaAnchorElement'] = $element;
        } else {
            $GLOBALS['ctaAnchorTitles'] = $titles;
            $GLOBALS['ctaAnchorElement'] = $element;
            include($_SERVER["DOCUMENT_ROOT"] . "/wp-content/themes/mini-strap/custom/cta_anchor.php");
        }
    } else {
        if ($menu == 1) {
            $GLOBALS['ctaAnchorTitles'] = $titles;
            $GLOBALS['ctaAnchorElement'] = $element;
        } else {
            $GLOBALS['ctaAnchorTitles'] = $titles;
            $GLOBALS['ctaAnchorElement'] = $element;
            include_once($_SERVER["DOCUMENT_ROOT"] . "/wp-content/themes/mini-strap/custom/cta_anchor.php");
        }
    }

    $out = ob_get_clean();
    return $out;
}

add_shortcode("cta_anchor", "cta_anchor_func");
*/

//Category Description TinyMCE Editor
/*
function cat_description($tag)
{
    ?>
    <table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
            <td>
                <?php
                $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
                wp_editor(wp_kses_post($tag->description , ENT_QUOTES, 'UTF-8'), 'cat_description', $settings);
                ?>
                <br />
                <span class="description"><?php _e('The description is not prominent by default; however, some themes may show it.','mini-strap'); ?></span>
            </td>
        </tr>
    </table>
    <?php
}
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );
add_filter('edit_category_form_fields', 'cat_description');

function remove_default_category_description()
{
    global $current_screen;
    if ( $current_screen->id == 'edit-category' )
    {
        ?>
        <script type="text/javascript">
            jQuery(function($) {
                $('textarea#description').closest('tr.form-field').remove();
            });
        </script>
        <?php
    }
}
add_action('admin_head', 'remove_default_category_description');
?>
*/
/*
//browser language redirect
if (array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER)) {
    preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $header_matchings);

    //create an array with key = lang , and value = priority value
    //ex: Array([en-GB] => 1,[en] => 0.8,[de] => 0.6,[bg] => 0.4)
    if (count($header_matchings[1])) {
        // create a list like "en" => 0.8
        $language_to_priority_map = array_combine($header_matchings[1], $header_matchings[4]);
        // set default to 1 for any without q factor
        foreach ($language_to_priority_map as $lang => $val) {
            if ($val === '') $language_to_priority_map[$lang] = 1;
        }
        // sort list based on value
        arsort($language_to_priority_map, SORT_NUMERIC);
    }
    wp_safe_redirect(network_site_url($language_to_priority_map[1]));
}
*/
