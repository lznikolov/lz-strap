<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 15.7.2016 г.
 * Time: 18:26
 */


//Remove feed link from header
remove_action('wp_head', 'feed_links_extra', 3); //Extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // General feeds: Post and Comment Feed

/*--------------------------------------------------------------------------------------------------------------------*/
//async | defer  load of js
function add_async_attribute($tag, $handle)
{
    $scripts_to_async = array('bootstrap', 'dropdown', 'style', 'wp-embed');
    foreach ($scripts_to_async as $async_script) {
        if ($async_script == $handle) {
            return str_replace(' src', ' defer src', $tag);
        }
    }
    return $tag;
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
/*--------------------------------------------------------------------------------------------------------------------*/
// Add bootstrap support to the Wordpress theme
function theme_add_bootstrap()
{
    wp_register_style('roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,500,700,900', array(), '0.0.1', 'all');
    wp_register_style('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css', array(), '3.3.6', 'screen');
    //wp_register_style('bootstrap', network_site_url() . 'wp-content/themes/mini-strap/css/bootstrap.min.css', array(), '3.3.6', 'screen');
    wp_register_style('style', network_site_url() . 'wp-content/themes/mini-strap/style.css', array('bootstrap'), '0.1.0', 'all');

    wp_enqueue_style('roboto');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('style');


    //We use wp_deregister to remove the old jquery v1.12.3 and jquery-migrate 1.4.0 from WP
    wp_deregister_script('jquery');
    //wp_register_script('jquery', network_site_url() . 'assets/js/jquery-2.2.4.js', array(), '2.2.4', true);
    wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), '2.2.4', true);

    //Bootstrap don't support jquery 3
    //wp_register_script('jquery', network_site_url() . 'assets/js/jquery-3.0.0.min.js', array(), '3.0.0', true);

    wp_register_script('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js', array('jquery'), '3.3.6', true);
    //wp_register_script('bootstrap', network_site_url() . 'wp-content/themes/mini-strap/js/bootstrap.min.js', array('jquery'), '3.3.6', true);

    //wp_register_script('dropdown', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js', array('bootstrap'), '2.2.1', true);
    //wp_register_script('dropdown', network_site_url() . 'assets/js/bootstrap-hover-dropdown.js', array('bootstrap'), '2.2.2', true);

    wp_register_script('style', network_site_url() . 'wp-content/themes/mini-strap/js/style.js', array('jquery', 'bootstrap'), '1.0.0', true);

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
    //wp_enqueue_script('dropdown');
    wp_enqueue_script('style');
}

add_action('wp_enqueue_scripts', 'theme_add_bootstrap');

function optimize_wp_styles()
{
    /* Automatically move JavaScript code to page footer, speeding up page loading time.*/
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);

    /*Remove emoji script from the head*/
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');

    /*Remove emoji script from the head*/
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}

add_action('wp_enqueue_scripts', 'optimize_wp_styles');

function extra_scripts_styles()
{
    /* Styles */
    wp_register_style('hover', 'https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.0.2/css/hover-min.css', array(), '2.0.2', 'screen');
    //wp_register_style('hover', network_site_url() . 'assets/css/hover-min.css', array(), '2.0.1', 'screen');
    wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css', array(), '4.6.3', 'all');
    //wp_register_style('font-awesome', network_site_url() . 'assets/css/font-awesome.min.css', array(), '4.6.3', 'all');
    wp_register_style('payment', network_site_url() . 'assets/css/payment.min.css', array(), '0.0.1', 'all');
    wp_register_style('footer-icons', network_site_url() . 'assets/css/footer-icons.min.css', array(), '0.0.1', 'all');

    wp_enqueue_style('hover');
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('payment');
    wp_enqueue_style('footer-icons');

    /* Scripts */
    wp_register_script('tinysort', 'https://cdnjs.cloudflare.com/ajax/libs/tinysort/2.3.6/tinysort.min.js', array(), '2.3.6', true);
    //wp_register_script('tinysort', network_site_url() . 'assets/js/tinysort.js', array(), '2.3.6', true);
    //wp_register_script('jquery-tinysort', network_site_url() . 'assets/js/jquery.tinysort.js', array('jquery'), '2.3.6', true);

    //This is enqueued  in /asses/ajax.php  all the ajax request go over this file
    //wp_localize_script('style', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));

    /* Add js of copylink plugin to the footer*/
    /*wp_enqueue_script( 'copylink-js', home_url('/', 'https') . '/wp-content/plugins/copy-link/script/jscript3.js', array(), '1.2.0', true );*/

    wp_enqueue_script('tinysort');
    //wp_enqueue_script('jquery-tinysort');

}

add_action('wp_enqueue_scripts', 'extra_scripts_styles');

function lz_sidebar()
{
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (is_plugin_active('lz-sidebar/allClicks.php')) {
        /* Dirty Hack to get the value of the theme from the allClicks plugin*/
        $option_odometer_theme = get_option('widget_allclicks');
        $theme = array_column($option_odometer_theme, 'odometer_theme');
        $odometer_theme = $theme[0];
        /* end dirty hack*/
        $path = plugin_dir_url('lz-sidebar/allClicks.php');
        wp_register_style('odometer-theme-' . $odometer_theme . '', $path . 'assets/css/allclicks/themes/odometer-theme-' . $odometer_theme . '.css', array(), '0.4.7', 'screen');
        //  wp_register_style('odometer-style', $path . 'assets/css/allclicks/style.css', array('odometer-theme-' . $odometer_theme . ''), '0.0.1', 'screen');
        wp_enqueue_style('odometer-theme-' . $odometer_theme . '');
        //   wp_enqueue_style('odometer-style');

        wp_register_script('odometer', $path . 'assets/js/allclicks/odometer.min.js', array('jquery'), '0.4.7', true);
        wp_enqueue_script('odometer');
    }
/*
    if (is_plugin_active('lz-sidebar/newsletter.php')) {
        $path = plugin_dir_url('lz-sidebar/newsletter.php');
        wp_register_style('newsletter-style', $path . 'assets/css/newsletter/style.css', array(), '0.0.1', 'screen');
        wp_enqueue_style('newsletter-style');
    }
*/
    if (is_plugin_active('lz-sidebar/topOperators.php')) {
        $path = plugin_dir_url('lz-sidebar/topOperators.php');
        wp_register_style('topoperator-style', $path . 'assets/css/topoperator/style.css', array(), '0.0.1', 'screen');
        wp_enqueue_style('topoperator-style');
    }
}

add_action('wp_enqueue_scripts', 'lz_sidebar');
/*--------------------------------------------------------------------------------------------------------------------*/
//JS CSS HTML Minifier
/*
require_once (get_template_directory() . "/inc/minifier-js-css-html.php');
function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}
function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');
*/

/*--------------------------------------------------------------------------------------------------------------------*/
// Place WP Toolbar at the  bottom
/*
function fb_move_admin_bar() {
    echo '
    <style type="text/css">
    body {
    margin-top: -28px;
    padding-bottom: 28px;
    }
    body.admin-bar #wphead {
       padding-top: 0;
    }
    body.admin-bar #footer {
       padding-bottom: 28px;
    }
    #wpadminbar {
        top: auto !important;
        bottom: 0;
    }
    #wpadminbar .quicklinks .menupop ul {
        bottom: 28px;
    }
    </style>';
}
// on backend area
add_action( 'admin_head', 'fb_move_admin_bar' );
// on frontend area
add_action( 'wp_head', 'fb_move_admin_bar' );
*/
/*--------------------------------------------------------------------------------------------------------------------*/
// CSS JS HTML Compression
/*
require_once (ABSPATH.'assets/minifier-js-css-html.php');
function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}

function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}

add_action('get_header', 'wp_html_compression_start');
*/
/*--------------------------------------------------------------------------------------------------------------------*/