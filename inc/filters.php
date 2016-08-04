<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 18.7.2016 г.
 * Time: 11:21
 */
/*--------------------------------------------------------------------------------------------------------------------*/
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
add_filter('get_the_excerpt', 'do_shortcode');
add_filter('the_title', 'do_shortcode');
/*--------------------------------------------------------------------------------------------------------------------*/
//load css async
//wp_register_script('load-css-async', network_site_url() . 'assets/js/loadCSS.js', array(), '', false);
//wp_enqueue_script('load-css-async');
//To load the CSS async uncomment the above 2 lines and comment the wp_register_style, wp_enqueue_style
//For standard load use wp_register_style & wp_enqueue_style and comment the load css async line
/*--------------------------------------------------------------------------------------------------------------------*/
// add property="stylesheet" to the link tag html5 compatibility
add_filter('style_loader_tag', function ($link, $handle) {
    return str_replace('rel', 'property=\'stylesheet\' rel', $link);
}, 10, 2);
/*--------------------------------------------------------------------------------------------------------------------*/
//Multi Language Switcher Plugin Hook to change whe way we export the html
//http://msls.co/hooks-filters-and-actions/
function my_msls_output_get($url, $link, $current)
{
    return sprintf(
        '<a href="%s" title="%s"%s rel="alternate" target="_self">%s</a>',
        $url,
        $link->txt,
        ($current ? ' class="current"' : ''),
        $link
    );
}

add_filter('msls_output_get', 'my_msls_output_get', 10, 3);

class MyMslsLink extends MslsLink
{
    protected $format_string = '<img src="{src}" alt="{alt}" class="img-responsive"> <span>{txt}</span>';
}

function my_msls_link_create($display)
{

    return new MyMslsLink;
}

add_filter('msls_link_create', 'my_msls_link_create', 1);

/*--------------------------------------------------------------------------------------------------------------------*/

// YOAST title shortcode support
function add_shortcode_to_title( $title ){
    return do_shortcode($title);
}
add_filter( 'wpseo_title', 'add_shortcode_to_title' );

/*---------------------------------------------------------------------------------------------------------------------*/
/* shortcode for the og:titles */
function customize_og_title($title)
{
    $do_shortcode_title = do_shortcode(htmlspecialchars_decode($title));
    return $do_shortcode_title;
}

add_filter('wp_title', 'customize_og_title', 20, 1);
// changes <title> to read shortcodes add_filter( 'wpseo_opengraph_title', 'customize_og_title', 10, 1 );
// changes og:title to read shortcodes add_filter( 'wpseo_twitter_title', 'customize_og_title', 10, 1 );
// changes tw:title to read shortcodes add_filter( 'wpseo_metadesc', 'customize_og_title', 10, 1 );
// changes description to read shortcodes add_filter( 'wpseo_opengraph_desc', 'customize_og_title', 10, 1);
// changes og:description to read shortcodes add_filter( 'wpseo_twitter_description', 'customize_og_title', 10, 1 );
// changes tw:description to read shortcodes