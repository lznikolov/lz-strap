<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 21.7.2016 г.
 * Time: 18:22
 */
?>
<!-- Logo Top -->
<header id="logo_bar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-lg-3 ">
                <a href="<?php echo home_url(); ?>">
                    <img src="/assets/images/logo_casino-apps.png" alt="logo" class="img-responsive"
                         style="height: 120px;">
                </a>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4" id="hotline">
                <?php
                //show only on the german cite
                $lang = substr(get_locale(), 0, 2);
                if ($lang == 'de') {
                    ?>
                    <a href="tel://01803000852" rel="help" title="Bei Fragen rufen Sie uns an. 0.09€/min. aus d. Festnetz">
                    <img src="/assets/images/support-phone-<?php echo $lang; ?>.png" alt="tel support" class="img-responsive">
                    </a>
                <?php } ?>

            </div>

            <div class="col-xs-12 col-md-6 col-lg-5" id="banner">
                <?php if (is_multisite()) {
                    switch (get_current_blog_id()) {
                        case 1 :
                            echo "<a href=\"https://mmwebhandler.aff-online.com/C/39622?sr=1309403&anid=\" rel=\"nofollow\"><img src=\"https://mmwebhandler.aff-online.com/I/39622?sr=1309403&anid=\"/></a>";
                            break;
                        case 2 :
                            echo "<a href=\"https://mmwebhandler.aff-online.com/C/39602?sr=1309402&anid=\" rel=\"nofollow\"><img src=\"https://mmwebhandler.aff-online.com/I/39602?sr=1309402&anid=\"/></a>";
                            break;
                        default:
                            echo "<img src=\"/assets/images/banner_top_right.png\" alt=\"banner\" class=\"img-responsive\">";
                    }
                } else {
                    echo "<img src=\"/assets/images/banner_top_right.png\" alt=\"banner\" class=\"img-responsive\">";
                }
                ?>
            </div>
            <div class="col-xs-12 visible-xs-inline visible-sm-inline text-center" id="social_bar">
                <ul class="list-inline responsiveSocials">
                    <?php if (function_exists('the_msls')) the_msls(); ?>
                    <li>
                        <a href="#" rel="nofollow" target="_blank"><i class="fa fa-facebook"></i><span class="sr-only">Facebook</span></a>
                    </li>
                    <li>
                        <a href="#" rel="nofollow" target="_blank"><i class="fa fa-twitter"></i><span class="sr-only">Twitter</span></a>
                    </li>
                    <li>
                        <a href="#" rel="nofollow" target="_blank"><i class="fa fa-google-plus"></i><span
                                class="sr-only">Google Plus</span></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</header>
