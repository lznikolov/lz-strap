<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 29.7.2016 г.
 * Time: 11:50
 */

global $wpdb;
if (is_multisite()) {
    $site_id = get_current_blog_id();
    $sql = "SELECT * FROM newslettermeta$site_id WHERE bookie='allcount'";
} else {
    $sql = "SELECT * FROM newslettermeta WHERE bookie='allcount'";
}
$results = $wpdb->get_results($sql, OBJECT);
$newsletterSubscribers = $results[0]->clicks;

$req = true;
$aria_req = ($req ? " aria-required='true'" : '');

//all $instance and $args variables are this ones witch come from the plugin options
//for more details see in plugins/lz-sidebar/PLUGIN_NAME
$widget_id = $args['widget_id'];
//Replace the css with less code and compile it to css with wp-less, http://leafo.net/lessphp/
?>
<style>
    #<?php echo  $widget_id; ?> {
        background-color: white;
    }

    #<?php echo  $widget_id; ?> .page-header {
        font-size: 2em;
        color: orange;
    }

    #<?php echo  $widget_id; ?> .page-header strong {
                                    margin: 0 16px;
                                }

    #<?php echo  $widget_id; ?> button {
                                    border-radius: 0;
                                    background: white;
                                    color: orange;
                                    border: 2px solid orange;
                                    -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=0, Color=#000000)"; /*IE 8*/
                                    -moz-box-shadow: 0 1px 5px 3px rgba(0, 0, 0, 0.4); /*FF 3.5+*/
                                    -webkit-box-shadow: 0 1px 5px 3px rgba(0, 0, 0, 0.4); /*Saf3-4, Chrome, iOS 4.0.2-4.2, Android 2.3+*/
                                    box-shadow: 0 1px 5px 3px rgba(0, 0, 0, 0.4); /* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
                                    filter: progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=135, Color=#000000); /*IE 5.5-7*/
                                }

    #<?php echo  $widget_id; ?> button:hover {
                                    color: orange;
                                }

    #<?php echo  $widget_id; ?> .input-group {
                                    border: 1px solid orange;
                                    border-radius: 0;
                                }

    #<?php echo  $widget_id; ?> input:focus {
                                    background-color: rgba(235, 235, 235, 0.50);
                                }

    #<?php echo  $widget_id; ?> input[type="email"] {
                                    background-color: #ebebeb;
                                    height: 50px;
                                    text-align: center;
                                }

    #<?php echo  $widget_id; ?> > div > div:nth-child(2) > div:first-child {
                                      font-size: 4rem;
                                      color: orange;
                                      line-height: 1;
                                  }

    #<?php echo  $widget_id; ?> > div > div:nth-child(3) {
                                      color: #9f9f9f;
                                      text-align: left;
                                      margin: 10px 50px;
                                  }

    #<?php echo  $widget_id; ?> > div > div:nth-child(5) {
                                      color: #bababa;
                                      padding: inherit;
                                      margin: 10px 0 28px;
                                  }
</style>
<div class="col-xs-12" lang="<?php echo substr(get_locale(),0,2); ?>">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <div class="text-center text-uppercase">
                    <?php
                    /*
                     *<img src="<?php echo get_template_directory_uri ()?>/custom/images/subscribe_letter.png" alt="subscribe_letter_left">
                     *<strong><?php echo _x('headline', 'newsletter', 'mini-strap'); ?></strong>
                     *<img src="<?php echo get_template_directory_uri ()?>/custom/images/subscribe_letter.png" alt="subscribe_letter_left">
                     * */
                    ?>
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    <strong><?php echo _x('headline', 'newsletter', 'mini-strap'); ?></strong>
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <strong>
                <?php echo $newsletterSubscribers; ?>
            </strong>
        </div>
        <div class="col-xs-7 text-uppercase">
            <strong><?php echo _x('users', 'newsletter', 'mini-strap'); ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <?php printf(_x('subscribe', 'newsletter', 'mini-strap'), get_bloginfo('name')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form action="https://luckymailz.com/mailer/form.php?form=<?php echo $instance['formId']; ?>" method="post">
                <div class="form-group">
                    <label for="newsletter_email_sidebar" class="sr-only">Email</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                        </div>
                        <input type="email" class="form-control" name="email"
                               placeholder="<?php echo esc_attr_x('email-placeholder', 'newsletter', 'mini-strap') ?>" <?php echo $aria_req; ?>>
                        <input type="hidden" name="format" value="h"/>
                        <input type="hidden" name="CustomFields[15]" value="<?php echo $instance['fieldValue'];?>">
                        <input type="hidden" name="CustomFields[12]"
                               value="newsletter<?php if (!empty($instance['formLang'])) echo '_' . $instance['formLang']; ?>">
                    </div>
                </div>
                <button type="submit" name="subscribe"
                        class="btn btn-lg btn-block hvr-wobble-horizontal text-uppercase">
                    <strong><?php echo _x('subscribe-button', 'newsletter', 'mini-strap'); ?></strong>
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <?php echo __('NoSPAM', 'mini-strap'); ?>
        </div>
    </div>
</div>
