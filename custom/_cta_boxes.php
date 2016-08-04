<?php
require('dbconnect.php');

$operShortnameOrID = '';
$bonusType = 'Casino Apps';
$bonusReplace = '';
$unsetBonusCheck = '';
$unsetStandartCheck = '';
$bonusLimit = '';

$bonuses = getBonuses($operShortnameOrID, $bonusType, $bonusReplace, $unsetBonusCheck, $unsetStandartCheck, $bonusLimit);
?>
    <div class="row" id="bonus_boxes">
        <?php
        $count = 0;
        foreach ($bonuses as $operator => $bonus) {
            foreach ($bonus as $bonusName => $options) {
                $count++;

                $bonuscode = $options['bonuscode'];

                $bonusAmmountOpp = $options['amount'];
                if ($bonusAmmountOpp['usd'] != '') {
                    $bonusAmmount = $bonusAmmountOpp['usd'];
                    $bonusAmmountSign = '$';
                }
                if ($bonusAmmountOpp['eur'] != '') {
                    $bonusAmmount = $bonusAmmountOpp['eur'];
                    $bonusAmmountSign = '€';
                }
                if ($bonusAmmountOpp['gbp'] != '') {
                    $bonusAmmount = $bonusAmmountOpp['gbp'];
                    $bonusAmmountSign = '£';
                }

                $turnover = $options['turnover'] . ' x ' . $options['turnovertype'];
                $prozent = $options['percentage'];
                $minodd = $options['minodd'];
                $bonuses_id = $options['title'];
                $bonusID = $options['bonusID'];
                $operatorID = $options['operatorID'];
                $oper_id = $options['operatorID'];

                $clean_operator = str_replace(" " . strtolower($GLOBALS['jsonType']), "", strtolower($operator));
                $clean_operator = explode('.', $clean_operator);
                $clean_operator = $clean_operator[0];

                if (is_multisite()) {
                    $site_id = get_current_blog_id();
                    $query = "SELECT * FROM bonusmetas$site_id WHERE bookie='" . $clean_operator . "' AND bonus = 'No-Deposit'" or die("Error in the consult.." . mysqli_error($link));
                } else {
                    $query = "SELECT * FROM bonusmetas WHERE bookie='" . $clean_operator . "' AND bonus = 'No-Deposit'" or die("Error in the consult.." . mysqli_error($link));
                }

                $result = $link->query($query);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $likes = $row['likes'];
                        $clicks = $row['clicks'];
                        $likes_id = $row['id'];
                    }
                }

                /*Read the coockies and get the input values*/
                if (!isset($_COOKIE["m_" . strip4url($operator) . ""])) {
                    $viewcode = 0;
                } else {
                    $viewcode = 1;
                }

                /*Read the coockies and get the input values*/
                if ($viewcode == 1) {
                    if (isset($_COOKIE["m_" . strip4url($operator) . "_" . $bonuses_id])) {
                        if ($bonuscode != '' && $bonuscode != 'Aktuell kein Bonuscode notwendig!') {
                            $input = '<input type="text" value="' . $bonuscode . '" />';
                        } else {
                            $input = '<input type="text" value="Kein Code nötig"/>';
                        }
                    } else {
                        $input = '<input type="password" value="bonuscode"/>';
                    }

                } else {
                    $input = '<input type="password" value="bonuscode"/>';
                }

                if ($count > 3) {
                    $hidebox = 'hidden';
                } else {
                    $hidebox = 'show';
                }

                //OUTPUT VALUES
                $output_amount = '
            <div class="col-xs-12 col-sm-4">
				Maximaler Bonus' . $bonusAmmount . ' ' . $bonusAmmountSign . '
			</div>';

                $output_turnover = '
            <div class="col-xs-12 col-sm-4">
				Umsatz ' . EncodeSpecialCharacters($turnover) . '
			</div>';

                $output_minodd = '
            <div class="col-xs-12 col-sm-4">
				Mindestquote ' . EncodeSpecialCharacters($minodd) . '
			</div>';
                ?>
                <!--BONUS BOX-->
                <div class="col-sm-12 <?= $hidebox ?>">
                    <div class="row boxes-top">
                        <div class="col-md-3">
                            <a href="<?= getGoUrl($operator, 1) ?>" target="_blank" rel="nofollow">
                                <img
                                    src="/assets/images/logos_105x53/<?= strip4url($operator) ?>_105x53.png"
                                    alt="<?= $operator ?>" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-md-9">
                            <h4 class="text-uppercase text-center"><?= $operator ?> Gutschein <span class="hidden-xs">ohne Einzahlung</span></h4>
                        </div>
                    </div>
                    <div class="row boxes-middle">
                        <div class="col-xs-6 col-sm-3">
                            <div data-likebonus="<?= $likes_id ?>">
                                <span class="glyphicon glyphicon-heart"></span> <?= $likes ?> Likes
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <span class="bonus_users"><?= $clicks ?></span> mal wurde der Bonus bereits genutzt
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <a href="<?= get_the_permalink() ?>?b=<?= $bonusID ?>&opid=<?= $oper_id ?>"
                               class="show_bonus_button" data-url="<?= getGoUrl($operator, 1) ?>" target="_blank"
                               rel="nofollow" data-bon="<?= $bonuses_id ?>" data-bonid="<?= $likes_id ?>"
                               data-operator="<?= strip4url($operator) ?>">
                                <button class="btn btn-lg btn-warning hvr-wobble-horizontal">
                                    ANZEIGEN <span class="glyphicon glyphicon-chevron-right"></span>
                                </button>
                            </a>
                            <button class="show_bonus_button" data-url="<?= getGoUrl($operator, 1) ?>" data-bon="<?= $bonuses_id ?>" data-bonid="<?= $likes_id ?>"
                                    data-operator="<?= strip4url($operator) ?>">demo</button>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <a href="<?= get_the_permalink() ?>?b=<?= $bonusID ?>&opid=<?= $oper_id ?>"
                               class="boxes-boxLink" data-url="<?= getGoUrl($operator, 1) ?>" target="_blank"
                               rel="nofollow" data-bon="<?= $bonuses_id ?>" data-bonid="<?= $likes_id ?>"
                               data-operator="<?= strip4url($operator) ?>">
                                <?= $input ?>
                            </a>
                        </div>
                    </div>
                    <div class="row boxes-down text-center">
                        <?= $output_amount
                        . $output_turnover
                        . $output_minodd
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <!-- TOGGLE BOXES LIST -->
    <div class="row" id="toggle_bonus_boxes">
        <div class="col-sm-12">
            <div class="text-center hvr-pulse">
                <img src="/assets/images/arrowdown1orange.png">
                <p class="text-uppercase"><strong>Alle Gutscheine ohne<br> Einzahlung anzeigen</strong></p>
            </div>
        </div>
    </div>
<?php
include('wp-content/themes/mini-strap/custom/newsletter.php');
include('wp-content/themes/mini-strap/custom/mymeta/popup/popup.php');
?>
    <!-- Loading popups -->
<?php
if ($_GET['b']) {
    echo '<script type="text/javascript">var popup_id = "' . $_GET['b'] . '";</script>';
}