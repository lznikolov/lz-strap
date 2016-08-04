<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 21.7.2016 г.
 * Time: 18:21
 */

$newsCounter = 0;
$args = array(
    'cat' => $GLOBALS['newsCategory'],
    'showposts' => 200,
    'post_status' => 'publish',
    'post_type' => 'page',
    'caller_get_posts' => 1
);
$my_query = new WP_Query($args);
if ($my_query->have_posts()) {
    ?>
    <!-- News -->
    <div class="container-fluid" id="news-container">
        <div class="container" id="carousel-example-generic">
            <!-- Wrapper for slides -->
            <div class="row">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php
                        // broi kolko nivi ima i generirai li-tata
                        ?>
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $setActive = false;
                        while ($my_query->have_posts()) :
                            $my_query->the_post();
                            ?>
                            <div class="item <?php $setActive ? "active" : ""; ?>">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img src="<?php the_post_thumbnail(); ?>" alt="post_thumbnail">
                                <?php } ?>
                                <div class="carousel-caption">
                                    <h3><a href="<?php echo the_permalink(); ?>"
                                           title="<?php echo the_title_attribute(); ?>"><?php echo the_title(); ?> </a></h3>
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                                <?php $setActive = true; ?>
                            </div>
                        <?php endwhile; ?>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
