<?php
/**
 * Template Name: Subscribe Template
 *
 * @package WordPress
 * @subpackage Mini-Strap
 */
?>

<?php get_header(); ?>
<!-- Logo Top -->
<?php require_once(get_template_directory() . '/inc/header.php'); ?>
<!-- Menu -->
<?php require_once(get_template_directory() . '/inc/menu.php'); ?>
<?php $errors = $_GET['Errors']; ?>

    <!-- Main content -->
    <div class="container" id="mainContainer">
        <div class="row">
            <!-- Content -->
            <div class="col-xs-12" id="subscribeContainer">
                <?php
                if (have_posts()) :
                    while (have_posts()) : {
                        the_post();
                        //php empty fix. empty can be used only on variables and not on function returns
                        $the_tile = get_the_title();
                        if (!empty($the_tile)) { ?>
                            <?php get_template_part('partials/page', 'title'); ?>
                        <?php } ?>
                        <div class="row" id="subscribeContent">
                            <div class="col-xs-12">
                                <div class="text-justify"><?php the_content(); ?></div>
                            </div>
                        </div>
                        <?php if (!empty($errors)) {?>
                            <!--Errors-->
                            <div class="row">
                                <ul>
                                    <?php
                                    $errors = explode('<br%2F>',$_GET['Errors']);
                                    foreach ($errors as $error) {?>
                                        <li><?= substr ($error,6) ?></li>
                                    <?php } ?>
                                </ul>

                            </div>
                        <?php } ?>

                        <?php
                    }
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
    <!-- Footer -->
<?php get_footer(); ?>