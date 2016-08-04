<?php get_header(); ?>
<?php get_template_part( 'partials/default' , 'header'); ?>
<?php get_template_part( 'partials/default' , 'menu'); ?>
<!-- Main content -->
<div class="container" id="mainContainer">
    <div class="row">
        <!-- Content -->
        <div class="col-md-8" id="defaultContainer">
            <?php
            if (have_posts()) :
                while (have_posts()) : {
                    the_post();
                    //php empty fix. empty can be used only on variables and not on function returns
                    $the_tile = get_the_title();
                    if (!empty($the_tile)) { ?>
                        <?php get_template_part( 'partials/page', 'title' ); ?>
                    <?php } ?>
                    <?php get_template_part( 'partials/default' , 'content'); ?>
                <?php }
                endwhile;
            endif;?>
            <?php get_template_part( 'partials/page' , 'related'); ?>
            <?php comments_template(); ?>
        </div>
        <?php get_template_part( 'partials/default' , 'sidebar'); ?>
    </div>
</div>

<!-- Footer -->
<?php get_footer(); ?>