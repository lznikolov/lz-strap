<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 21.7.2016 г.
 * Time: 17:49
 */
$current_operator = get_post_meta($post->ID, 'llbz_operator', true);
$bonus = getBonuses($operShortnameOrID = '', $bonusType = '', $bonusReplace = '', $unsetBonusCheck = '', $unsetStandartCheck = '', $bonusLimit = '', $useBonusGroup = '', $useShortname = '', $unsetSetTypeCheck = '');
$rating = isset($bonus[$current_operator]['Casino Ratings']['10rating']) ? $bonus[$current_operator]['Casino Ratings']['10rating'] : '0';
?>
<!-- Operator Schema -->
<script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type"           : "Review",
      "datePublished"   : "<?php the_date(); ?>",
      "dateModified"    : "<?php the_modified_date(); ?>",
      "inLanguage"      : "<?php echo get_locale(); ?>",
      "name"            : "<?php echo the_title(); ?>",
      "itemReviewed": {
        "@type" : "Thing",
        "name"  : "<?php echo $current_operator; ?>",
        "url"   : "<?php the_permalink() ?>",
        "image" : "<?php echo network_site_url() . operatorImagePath($current_operator); ?>"
      },
      "author": {
        "@type" : "Organization",
        "name"  : "<?php echo get_bloginfo('name'); ?>",
        "logo"  : "<?php echo network_site_url() . "/assets/images/logo_casino-apps.png" ?>",
        "url"   : "<?php echo site_url(); ?>"
      },
      "reviewRating": {
        "@type"         : "Rating",
        "ratingValue"   : "<?php echo $rating; ?>",
        "bestRating"    : "10",
        "worstRating"   : "1"
      }
    }

</script>
<div class="row" id="operatorContent">
    <div class="col-sm-1 hidden-xs" id="h2Counter"></div>
    <div class="col-sm-11 col-xs-12">
        <a href="<?php echo operatorPageURL($current_operator, 'normal', 'content-logo'); ?>" rel="nofollow" target="_blank">
            <img class="img-responsive pull-left"
                 src="<?php echo operatorImagePath($current_operator,'200x101'); ?>"
                 alt="<?php echo $current_operator; ?>">
        </a>
        <div class="text-justify"><?php the_content(); ?></div>
    </div>
</div>
