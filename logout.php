<?php
session_start();

$_SESSION = array();
session_destroy();
$link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
header "Location:$link";
exit;
?>
