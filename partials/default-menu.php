<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 21.7.2016 г.
 * Time: 18:21
 */
?>

<?php
$operShortnameOrID = '';
$bonusType = '';
$bonusReplace = '';
$unsetBonusCheck = '';
$unsetStandartCheck = '';
$bonusLimit = '';

$bonuses = getBonuses($operShortnameOrID, $bonusType, $bonusReplace, $unsetBonusCheck, $unsetStandartCheck, $bonusLimit);


//tam kydeto imame prazno ili text v amount go zamestwame s 0, za da moje da raboti sortirovkata
$sortedOps = array();

//just in case if we don't have a rating value for the operator
foreach ($bonuses as $operator => $row) {
        $rating = $row['Casino Ratings']['10rating'];
        if (!empty($rating)) {
            if (!is_numeric($rating)) {
                $sortedOps[$operator] = 0;
            } else {
                $sortedOps[$operator] = $rating;
            }
        }
}
//sotirame syzdadeniqt array s dannite po jelaniq kluch
array_multisort($sortedOps, SORT_DESC,SORT_NUMERIC);
?>
<!-- Menu -->
<nav id="lz-menu" class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#lz-navbar" aria-expanded="false" aria-controls="lz-navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo home_url(); ?>" class="navbar-brand hidden" rel="home"
               title="Casino-Apps by LuckyLabz"></a>
        </div>
        <div class="navbar-collapse collapse" id="lz-navbar" aria-expanded="false">
            <ul class="nav navbar-nav">
                <!-- HOME -->
                <li class="dropdown" role="presentation">
                    <a href="<?php echo site_url(); ?>" id="home_menu" class="text-capitalize dropdown-toggle"
                       data-hover="dropdown"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/assets/images/header-menu/home_menu.png" alt="home_menu">
                        <strong>Casino Apps</strong> <span class="caret"></span>
                    </a>
                    <?php
                    if (count($bonuses) > 0) {
                    $i = 0;
                    $isCollapsed = false;
                    ?>
                    <ul class="dropdown-menu multicolumn-2" aria-labelledby="home_menu">
                        <?php
                        foreach ($sortedOps as $key => $val) {
                            $operatorOriginalName = $key;
                            $i == 10 ? $isCollapsed = true : null;
                            ?>
                            <li <?php echo $isCollapsed ? 'class="hidden-md hidden-lg"' : '' ?>>
                                <a href="<?php echo operatorPageURL($operatorOriginalName); ?>"
                                   class="hvr-wobble-vertical">
                                    <img
                                        src="<?php echo operatorImagePath($operatorOriginalName, '200x101', 'casino', 'dark-back'); ?>"
                                        alt="<?php echo $operatorOriginalName; ?>"
                                        style="width: 62px; height: 31px">
                                    <span class=" text-capitalize text-left" style="padding-left: 10px;">
                                        <?php echo $operatorOriginalName . ' App'; ?>
                                    </span>
                                    <span class="glyphicon glyphicon glyphicon-save pull-right" aria-hidden="true"
                                          style="color:#00C029;  margin-left: auto;"></span>
                                </a>
                            </li>
                            <?php
                            $i++;
                        } ?>
                        <li class="hidden-sm hidden-xs">
                            <a href="#" id="show-all-operators" class="text-uppercase"><?php echo __('Show me more', 'mini-strap'); ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <!-- iOS -->
                <li class="dropdown" role="presentation">
                    <a href="<?php echo site_url('ios'); ?>" id="ios_casino_dropdown"
                       class="text-capitalize dropdown-toggle"
                       data-hover="dropdown"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/assets/images/header-menu/apple_logo.png" alt="apple_casino_apps">
                        <strong>iOS/Apple Casino Apps</strong> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ios_casino_dropdown">
                        <li>
                            <a href="<?php echo site_url('ios/iphone'); ?>"><img
                                    src="/assets/images/header-menu/iphone.png" alt="iphone"
                                    style="width: 62px; height: 32px"> iPhone Casino Apps</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('ios/ipad'); ?>"><img src="/assets/images/header-menu/ipad.png"
                                                                               alt="ipad"
                                                                               style="width: 62px; height: 31px"> iPad
                                Casino Apps</a>
                        </li>
                    </ul>
                </li>
                <!-- Andorid -->
                <li class="dropdown" role="presentation">
                    <a href="<?php echo site_url('android'); ?>"
                       class="text-capitalize dropdown-toggle" id="android_casino_dropdown"
                       data-hover="dropdown"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/assets/images/header-menu/android_logo.png" alt="android_casino_apps">
                        <strong>Android Casino Apps</strong>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="android_casino_dropdown">
                        <li>
                            <a href="<?php echo site_url('android/samsung'); ?>"><img
                                    src="/assets/images/header-menu/samsung.png" alt="samsung"
                                    style="width: 62px; height: 31px"> Samsung Mobile Casino Apps</a>
                        </li>
                    </ul>
                </li>
                <!-- Windows -->
                <li class="dropdown" role="presentation">
                    <a href="<?php echo site_url('windows-phone'); ?>"
                       class="text-capitalize dropdown-toggle" id="windows_casino_dropdown"
                       data-hover="dropdown"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/assets/images/header-menu/windows-8_logo.png" alt="windows_casino_apps">
                        <strong>Windows Phone Casino Apps</strong>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="windows_casino_dropdown">
                        <li>
                            <a href="<?php echo site_url('windows-10'); ?>"><img
                                    src="/assets/images/header-menu/windows.png" alt="ipad"
                                    style="width: 62px; height: 32px"> Windows 10 Casino Apps</a>
                        </li>
                    </ul>
                </li>
                <!-- Mobile Casino Bonus-->
                <li class="dropdown hidden" role="presentation">
                    <a href="<?php echo site_url('mobile-casino-bonus'); ?>"
                       class="text-capitalize dropdown-toggle" id="mobile_casino_dropdown"
                       data-hover="dropdown"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/assets/images/header-menu/smartphone_logo.png" alt="mobile_casino_apps">
                        <strong>Mobile Casino Bonus</strong>
                    </a>
                </li>
                <!-- Live Casino Apps -->
                <li role="presentation" class="hidden">
                    <a href="<?php echo site_url('live-casino'); ?>"> <img
                            src="/assets/images/header-menu/live-casino_logo.png" alt="live_casino_apps"> Live Casino
                        Apps</a>
                </li>
                <!-- Casino Games-->
                <li class="dropdown hidden" role="presentation">
                    <a href="#"
                       id="live_casino_dropdown" class="text-capitalize dropdown-toggle"
                       data-hover="dropdown"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/assets/images/header-menu/casino_spiele.png" alt="live_casino_apps">
                        <strong>Casino <?php echo __('Games', 'mini-strap'); ?></strong>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="live_casino_dropdown">
                        <?php
                        $blog_id = get_current_blog_id();
                        if (is_multisite()) {
                            /* FIRST NETWORK SITE*/
                            if ($blog_id == 1) { ?>
                                <li><a href="<?php echo site_url('slots'); ?>">Slot Machines Apps</a></li>
                                <li><a href="<?php echo site_url('slots/book-or-ra'); ?>">Book of Ra App</a></li>
                                <li><a href="<?php echo site_url('roulette'); ?>">Roulette Casino Apps </a></li>
                                <li><a href="<?php echo site_url('black-jack'); ?>">Black Jack Casino Apps</a></li>
                                <li><a href="<?php echo site_url('merkur'); ?>">Merkur Casino Apps</a></li>
                                <li><a href="<?php echo site_url('novoline'); ?>">Novoline Casin Apps</a></li>
                                <li><a href="<?php echo site_url('netent'); ?>">NetEnt Casino Apps</a></li>
                                <li><a href="<?php echo site_url(''); ?>">Playtech Casino Apps</a></li>
                                <li><a href="<?php echo site_url(''); ?>">Microgaming Casino Apps</a></li>
                                <li><a href="<?php echo site_url(''); ?>">IGT Casino Apps</a></li>

                            <?php }
                            /* SECOND NETWORK SITE*/
                            if ($blog_id == 2) { ?>
                                <li><a href="<?php echo site_url('slots'); ?>">Spielautomaten Apps</a></li>
                                <li><a href="<?php echo site_url('slots/book-or-ra'); ?>">Book of Ra App</a></li>
                                <li><a href="<?php echo site_url('roulette'); ?>">Roulette Casino Apps </a></li>
                                <li><a href="<?php echo site_url('black-jack'); ?>">Black Jack Casino Apps</a></li>
                                <li><a href="<?php echo site_url('merkur'); ?>">Merkur Casino Apps</a></li>
                                <li><a href="<?php echo site_url('novoline'); ?>">Novoline Casin Apps</a></li>
                                <li><a href="<?php echo site_url('netent'); ?>">NetEnt Casino Apps</a></li>
                                <?php
                            }
                        } ?>
                    </ul>
                </li>
                <!-- News -->
                <li class="hidden"><a href="<?php echo site_url('news-template'); ?>">
                        <img src="/assets/images/header-menu/news.png"
                             alt="live_casino_apps"> <?php echo __('News', 'mini-strap'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
