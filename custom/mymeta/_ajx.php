<?php
require($_SERVER["DOCUMENT_ROOT"] . "/wp-content/themes/mini-strap/custom/dbconnect.php");

if ($_POST['action'] == 'like') {
    if (!isset($_POST['bonus'])) {
        $_POST['bonus'] = $_POST['#038;bonus'];
    }
    if (!isset($_COOKIE['link_' . $_POST['bonus'] . ''])) {
        $link->query("UPDATE bonusmetas SET likes = likes+1, `real likes` = `real likes`+1 WHERE id = '" . $_POST['bonus'] . "'");
        $query = "SELECT `likes` FROM `bonusmetas` WHERE `id`='" . $_POST['bonus'] . "'" or die("Error in the consult.." . mysqli_error($link));
        $result = $link->query($query);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $newlikes = $row['likes'];
            }
        }
        if (!isset($newlikes)) {
            $newlikes = 1;
        }
        print '<span class="glyphicon glyphicon-heart redHeart"></span>' . $newlikes . ' Likes';
    } else {
        print "Gefällt dir schon";
    }
} else if ($_POST['action'] == 'click') {

    if (is_multisite()) {
        $site_id = get_current_blog_id();
        $link->query("UPDATE bonusmetas$site_id SET clicks = clicks+1, `real clicks` = `real clicks`+1 WHERE id = '" . $_POST['bonus'] . "'");
        $link->query("UPDATE bonusmetas$site_id SET clicks = clicks+1 WHERE bookie = 'bookiecount'");

        $query = "SELECT clicks FROM bonusmetas$site_id WHERE id='" . $_POST['bonus'] . "'" or die("Error in the consult.." . mysqli_error($link));

    } else {
        $link->query("UPDATE bonusmetas SET clicks = clicks+1, `real clicks` = `real clicks`+1 WHERE id = '" . $_POST['bonus'] . "'");
        $link->query("UPDATE bonusmetas SET clicks = clicks+1 WHERE bookie = 'bookiecount'");

        $query = "SELECT `clicks` FROM `bonusmetas` WHERE `id`='" . $_POST['bonus'] . "'" or die("Error in the consult.." . mysqli_error($link));

    }

    $result = $link->query($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $newlikes = $row['clicks'];
        }
    }
    if (!isset($newlikes)) {
        $newlikes = 1;
    }
    print "" . $newlikes . " Nutzer verwenden diesen Bonus";

} else if ($_POST['action'] == 'incrClicks') {
    if (is_multisite()) {
        $site_id = get_current_blog_id();
        $link->query("UPDATE bonusmetas$site_id SET clicks = clicks+1 WHERE bookie = 'bookiecount'");
    } else {
        $link->query("UPDATE bonusmetas SET clicks = clicks+1 WHERE bookie = 'bookiecount'");
    }

} else if ($_POST['action'] == 'updateNewsletter') {
    if (is_multisite()) {
        $site_id = get_current_blog_id();
        $link->query("UPDATE newslettermeta$site_id SET clicks = clicks+1 WHERE bookie = '" . $_POST['bookie'] . "'");

        $query = "SELECT `clicks` FROM bonusmetas$site_id WHERE `id`='" . $_POST['bonus'] . "'" or die("Error in the consult.." . mysqli_error($link));

    }else{
        $link->query("UPDATE newslettermeta SET clicks = clicks+1 WHERE bookie = '" . $_POST['bookie'] . "'");

        $query = "SELECT `clicks` FROM `bonusmetas` WHERE `id`='" . $_POST['bonus'] . "'" or die("Error in the consult.." . mysqli_error($link));
    }
    $result = $link->query($query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $newlikes = $row['clicks'];
        }
    }
    if (!isset($newlikes)) {
        $newlikes = 1;
    }
    print "" . $newlikes . " Nutzer verwenden diesen Bonus";

}
/*
else if ($_POST['action'] == 'getnewsletter') {

    $query = "SELECT `id` FROM `wp_wpmlsubscribers`";
    $rslt = $link->query($query);
    echo $rslt->num_rows + 11463;
}
 */