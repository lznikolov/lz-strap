<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 21.7.2016 г.
 * Time: 17:56
 */

global $post;
$orig_post = $post;
$tags = wp_get_post_tags($post->ID);
$relPagesQuery;
if ($tags) {
    $tag_ids = array();
    foreach ($tags as $individual_tag)
        $tag_ids[] = $individual_tag->term_id;
    $args = array(
        'post_type' => 'page',
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 10
    );
    $relPagesQuery = new WP_Query($args);
}
$post = $orig_post;
wp_reset_query();
if (!empty($relPagesQuery) && $relPagesQuery->have_posts()) { ?>
    <!-- Related Pages -->

    <div class="row" id="related_pages">
        <div class="col-xs-12">
            <h2><img src="/assets/images/link-icon.png" alt="related_logo"> <?= __('more-information', 'mini-strap'); ?>
            </h2>
        </div>
        <div class="col-xs-12"><strong>Tags:</strong>
            <?php foreach ($tags as $tag) {
                echo $tag->name . " ";
            }; ?>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <?php
                while ($relPagesQuery->have_posts()) {
                    $relPagesQuery->the_post(); ?>
                    <div class="col-xs-12 col-md-6">
                        <div class="media">
                            <div class="media-left media-top">
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                   title="<?php do_shortcode(the_title()); ?>">
                                    <?php the_post_thumbnail(array(64, 64), array('class' => 'media-object')); ?>

                                </a>
                            </div>
                            <div class="media-body">
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                   title="<?php do_shortcode(the_title()); ?>">
                                    <h4 class="media-heading"><?php the_title(); ?></h4>
                                </a>
                                <?php echo get_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>