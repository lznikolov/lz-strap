<aside class="row" id="newsletter_sidebar">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="text-center text-uppercase">
                        <?php
                        /*
                         *<img src="<?= get_template_directory_uri ()?>/custom/images/subscribe_letter.png" alt="subscribe_letter_left">
                         *<strong><?= _x('headline', 'newsletter', 'mini-strap'); ?></strong>
                         *<img src="<?= get_template_directory_uri ()?>/custom/images/subscribe_letter.png" alt="subscribe_letter_left">
                         * */
                        ?>
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                        <strong><?= _x('headline', 'newsletter', 'mini-strap'); ?></strong>
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5">
                <strong>
                <?php
                global $wpdb;
                if (is_multisite()) {
                    $site_id = get_current_blog_id();
                    $sql = "SELECT * FROM newslettermeta$site_id WHERE bookie='allcount'";
                } else {
                    $sql = "SELECT * FROM newslettermeta WHERE bookie='allcount'";
                }
                $results = $wpdb->get_results($sql, OBJECT);
                echo $results[0]->clicks;
                ?>
                </strong>
            </div>
            <div class="col-xs-7 text-uppercase">
                <strong><?= _x('users', 'newsletter', 'mini-strap'); ?></strong>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <?php printf(_x('subscribe', 'newsletter', 'mini-strap'), get_bloginfo('name')); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="<?= $GLOBALS['newsletterAction'] ?>" method="post" id="mc-embedded-subscribe-form"
                      name="mc-embedded-subscribe-form" target="_blank">
                    <div class="form-group">
                        <label for="newsletter_email_sidebar" class="sr-only">Email</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            </div>
                            <input type="email" class="form-control" required name="EMAIL" id="newsletter_email_sidebar"
                                   placeholder="<?= esc_attr_x('email-placeholder', 'newsletter', 'mini-strap') ?>">
                        </div>
                    </div>
                    <button type="submit" name="subscribe" id="mc-embedded-subscribe"
                            class="btn btn-default btn-lg btn-block btn-warning hvr-wobble-horizontal"><?= _x('subscribe-button', 'newsletter', 'mini-strap') ?>
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <?= __('NoSPAM', 'mini-strap') ?>
            </div>
        </div>
        <!-- MAILCHIMP -->
        <div class="row">
            <div class="col-sm-12">
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response hidden"></div>
                    <div class="response" id="mce-success-response hidden"></div>
                </div>
            </div>
        </div>
    </div>
</aside>