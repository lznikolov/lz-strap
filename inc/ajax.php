<?php
/**
 * Created by PhpStorm.
 * User: Rangel
 * Date: 15.6.2016 г.
 * Time: 9:48
 */
/*
IMPORTANT
In the data Object in AJAX Request the value of action MUST be equal the name of the PHP function witch return the result
Example:
PHP function name lz_ajax_downloads()
data:{ 'action': 'lz_ajax_downloads', 'some_key:'some_value' }
in the PHP function the some_key is in the $_REQUEST
*/
function lz_ajax_script()
{ ?>
    <script>
        console.log("all clicks");
        var ajaxurl = "<?= admin_url('admin-ajax.php'); ?>";

        //all clicks ajax request
        setInterval(function () {
            $.ajax({
                method: "POST",
                url: ajaxurl,
                data: {
                    'action': 'lz_ajax_downloads',
                    'req': 'downloads'
                }
            })
                .success(function (data) {
                    $('.odometer').html(data);
                })
                .error(function () {
                    console.log("ERROR ajax");
                })
                .complete(function (data) {
                    //console.log(data);
                });
        }, 20000);

        //type the new ajax request hier
    </script>
<?php }

function lz_ajax_downloads()
{
    global $wpdb;

    // The $_REQUEST contains all the data sent via ajax
    if (isset($_REQUEST)) {
        $action = $_REQUEST['req'];
        if ($action == 'downloads') {
            if (is_multisite()) {
                $site_id = get_current_blog_id();
                $query = "SELECT clicks FROM bonusmetas$site_id WHERE bookie='bookiecount'" or die("Error in the consult.." . mysqli_error($link));
            } else {
                $query = "SELECT clicks FROM bonusmetas WHERE bookie='bookiecount'" or die("Error in the consult.." . mysqli_error($link));
            }
            $data = $wpdb->get_results($query, OBJECT);
            $result = $data[0]->clicks;
        }
    }
    echo $result;
    wp_die();
}


if (is_admin()) {
    add_action('wp_ajax_lz_ajax_downloads', 'lz_ajax_downloads');
    add_action('wp_ajax_nopriv_lz_ajax_downloads', 'lz_ajax_downloads');
} else {
    add_action('wp_footer', 'lz_ajax_script');
}



