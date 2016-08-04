<?php
/**
 * A Simple Category Template
 */
?>

<?php get_header(); ?>
    <!-- Logo Top -->
<?php require_once(get_template_directory() . '/inc/header.php'); ?>
    <!-- Menu -->
<?php require_once(get_template_directory() . '/inc/menu.php'); ?>

    <!-- Main content -->
    <div class="container" id="mainContainer">
        <div class="row">

            <!-- Content -->
            <section class="col-md-8" id="categoryContainer">


                <?php
                // Check if there are any posts to display
                if (have_posts()) : ?>
                    <header class="page-header text-capitalize">

                        <h1>
                            <img src="/assets/images/category-tag.png" alt="link_icon">
                            <?php echo single_cat_title('', false) . ' Info' ?>
                            <small>
                                <?php
                                // Display optional category description
                                if (category_description()) : ?>
                                    <div class="archive-meta" hidden><?php echo category_description(); ?></div>
                                <?php endif; ?>
                            </small>
                        </h1>

                    </header>


                    <?php
                    // The Loop
                    while (have_posts()) : the_post(); ?>
                        <article class="row">
                            <div class="col-sm-12 hvr-wobble-horizontal">
                                <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                            </div>
                            <div class="col-sm-12">
                                <h2>
                                    <a
                                        href="<?php the_permalink() ?>" rel="bookmark"
                                        title="Permanent Link to <?php the_title_attribute(); ?>">
                                        <?= single_cat_title('', false); ?> &raquo; <?php the_title(); ?>
                                    </a>
                                </h2>
                                <small class="hidden"><?php the_time('F jS, Y') ?>
                                    by <?php the_author_posts_link() ?></small>
                                <div class="text-justify collapse">
                                    <?php the_excerpt(); ?>
                                    <p class="postmetadata hidden">
                                        <?php comments_popup_link('No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed'); ?>
                                    </p>
                                    <p>
                                        <a href="<?php the_permalink() ?>"><?= __('read-more', 'mini-strap') ?> &raquo;</a>
                                    </p>
                                </div>
                            </div>
                        </article>

                    <?php endwhile; ?>

                <?php else: ?>
                    <p>Sorry, no posts matched your criteria.</p>
                <?php endif; ?>
            </section>

            <!-- Sidebar -->
            <div class="col-md-4" id="sidebarContainer">
                <?php get_sidebar(); ?>
            </div>

        </div>
    </div>
    <!-- Footer -->
<?php get_footer(); ?>