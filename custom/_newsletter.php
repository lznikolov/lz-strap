<div class="row" id="newsletter_content">
    <div class="col-xs-12 col-sm-6">
        <b>Jetzt <?= $GLOBALS['siteNameString']; ?> Newsletter abonnieren!</b><br>
        <span><?= $GLOBALS['newsletterClicks'] ?> haben sich für den Gutschein-Newsletter abonniert</span>
    </div>
    <div class="col-xs-12 col-sm-6">
        <form action="<?= $GLOBALS['newsletterAction'] ?>" method="post" id="mc-embedded-subscribe-form"
              name="mc-embedded-subscribe-form" target="_blank">
            <div class="form-group">
                <label for="newsletter_content_email" class="sr-only">Email</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    </div>
                    <input type="email" class="form-control" required name="EMAIL" id="newsletter_content_email"
                           placeholder="Geben Sie Ihre E-Mail-Adresse ein">
                </div>
            </div>
            <button type="submit" name="subscribe" id="mc-embedded-subscribe"
                    class="btn btn-default btn-lg btn-block btn-warning hvr-wobble-horizontal">Jetzt Abonnieren
            </button>
        </form>
    </div>
</div>