<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error - custom_content:" . mysqli_error($link));
?>