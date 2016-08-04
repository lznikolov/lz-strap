<footer class="jumbotron-fluid footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="text-uppercase"><?= __('watched  by', 'mini-strap') ?></h4>
                <ul class="list-inline">
                    <li><a href="javascript:void(0);">
                            <span class="sr-only">Plus18</span>
                            <i class="footer-icons footer-icons-18"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="sr-only">Sch</span>
                            <i class="footer-icons footer-icons-sch"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="sr-only">T&Uuml;V</span>
                            <i class="footer-icons footer-icons-tuv"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="sr-only">VISA</span>
                            <i class="footer-icons footer-icons-visa"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="sr-only">Mastercard</span>
                            <i class="footer-icons footer-icons-mastercard"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="sr-only">PayPal</span>
                            <i class="footer-icons footer-icons-paypal"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="sr-only">Scrill</span>
                            <i class="footer-icons footer-icons-scrill"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="sr-only">NetTeller</span>
                            <i class="footer-icons footer-icons-netteler"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" style="margin-top: 60px;margin-bottom: 30px;">
            <div class="col-md-4">
                <img src="/assets/images/lz-casino-apps-logo-footer.png"
                     alt="CasinoApps, a service of LuckyLabz">
            </div>
            <div class="col-md-5">Copyright <?php echo date('Y'); ?> &copy; <?php bloginfo('name'); ?>. All Rights
                Reserved.
            </div>
            <div class="col-md-3">
                <?php
                /*
                  Bitte hinterlassen Sie uns hier Ihre Werbeanfrage. Wir werden Sie so schnell wie möglich kontaktieren.
                  <script src="https://leads-capturer.futuresimple.com/embed.js?token=d5132a3e9b4356d4b5704ebe9458e501" type="text/javascript"></script>
                 */
                if (is_multisite()) {
                    if (get_current_blog_id() == 2) { ?>
                        <ul class="list-inline">
                            <li><a href="<?php echo site_url("impressum"); ?>">Impressum</a></li>
                        </ul>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</footer>
<div class="scroll-top-wrapper">
    <img src="/assets/images/scroll_to_top/goToTop.png" alt="scrollToTop" class="img-responsive">
</div>

<div class="social collapse">
    <ul class="list-unstyled">
        <li>
            <a class="fa fa-facebook" href="#" rel="nofollow" target="_blank"><span>Facebook</span></a>
        </li>
        <li>
            <a class="fa fa-twitter" href="#" rel="nofollow" target="_blank"><span>Twitter</span></a>
        </li>
        <li>
            <a class="fa fa-google-plus" href="#" rel="nofollow" target="_blank"><span>Google Plus</span></a>
        </li>
        <?php if (function_exists('the_msls')) the_msls(); ?>
    </ul>
</div>

<?php
/*
if (isset($GLOBALS['ctaAnchorTitles'])) { ?>
    <script type="text/javascript">
        var ctaAnchors = '<?php echo json_encode($GLOBALS['ctaAnchorTitles']); ?>';
        var ctaAnchorsElement = '<?php echo json_encode($GLOBALS['ctaAnchorElement']); ?>';
    </script>
<?php }
*/
?>

<?php wp_footer(); ?>

</body>
</html>