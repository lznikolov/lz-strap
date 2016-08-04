<?php
/**
 * The template for displaying 404 pages (Not Found)
 **/
?>
<?php get_header(); ?>
<?php get_template_part( 'partials/default' , 'header'); ?>
<?php get_template_part( 'partials/default' , 'menu'); ?>
    <div class="container" id="error404">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header text-center">
                    <h1><?= _x('header', '404', 'mini-strap'); ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <!--<img class="img-responsive"
                     src="/assets/images/monopoly-banker-with-empty-pockets.png" alt="404"
                     style="margin: 0 auto; height: 308px;"> -->
                <h2>404</h2>
            </div>
            <div class="col-sm-6">
                  <ul>
                    <li><?= _x('opt1', '404', 'mini-strap'); ?></li>
                    <li><?= _x('opt2', '404', 'mini-strap'); ?></li>
                    <li><?= _x('opt3', '404', 'mini-strap'); ?></li>
                </ul>
            </div>
        </div>
    </div>

<?php get_footer(); ?>