<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 29.7.2016 г.
 * Time: 11:18
 */

global $wpdb;
if (is_multisite()) {
    $site_id = get_current_blog_id();
    $sql = "SELECT clicks FROM bonusmetas$site_id WHERE bookie='bookiecount'";
} else {
    $sql = "SELECT clicks FROM bonusmetas WHERE bookie='bookiecount'";
}
$results = $wpdb->get_results($sql, OBJECT);
$newclicks = $results[0]->clicks;

//all $instance and $args variables are this ones witch come from the plugin options
//for more details see in plugins/lz-sidebar/PLUGIN_NAME
$odometer_duration = $instance['odometer_duration'];
$odometer_animation = $instance['odometer_animation'];
$odometer_theme = $instance['odometer_theme'];
$odometer_format = $instance['odometer_format'];
$widget_id = $args['widget_id'];
//Replace the css with less code and compile it to css with wp-less, http://leafo.net/lessphp/
?>
<style>
    #<?php echo  $widget_id; ?> {  background: url('/assets/images/sidebar/allclicks_sidebar_bg.png') no-repeat right bottom; background-size: contain; }
    #<?php echo  $widget_id; ?> > div > div {  display: flex;  align-items: center;  flex-wrap: wrap;   height: 130px; }
    #<?php echo  $widget_id; ?> > div > div > div:nth-child(1){color: orange;  font-size: 4rem;  line-height: normal;}
    #<?php echo  $widget_id; ?> > div > div > div:nth-child(2){ color: #164e22;  line-height: 1;  font-size: 1.7rem;}
    #<?php echo  $widget_id; ?> > div[lang="de"] > div > div:nth-child(2){ color: #164e22;  line-height: 1;  font-size: 1.5rem;}
</style>
<script>
    window.odometerOptions = {
        // auto: false, // Don't automatically initialize everything with class 'odometer'
        // selector: '.my-numbers', // Change the selector used to automatically find things to be animated
        format: '<?= $odometer_format;?>', // Change how digit groups are formatted, and how many digits are shown after the decimal point
        duration: <?= $odometer_duration;?>, // Change how long the javascript expects the CSS animation to take
        theme: '<?= $odometer_theme;?>', // Specify the theme (if you have more than one theme css file on the page)
        animation: '<?= $odometer_animation;?>' // Count is a simpler animation method which just increments the value,
        // use it when you're looking for something more subtle.
    };
</script>
<div class="col-xs-12" lang="<?= substr(get_locale(),0,2); ?>">
    <div class="row">
        <div class="col-xs-12 col-md-6 text-center"><strong class="odometer"><?php echo $newclicks; ?></strong></div>
        <div class="col-xs-12 col-md-6 text-uppercase text-center"><strong><?php echo  __('Users have downloaded a casino app', 'mini-strap') ?></strong></div>
    </div>
</div>
