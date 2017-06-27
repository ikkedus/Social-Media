<?php
date_default_timezone_set('UTC');
require_once 'classes/user.php';
session_start();
$user=($_SESSION["user"]);

if(!isset($_GET['admin']) || $_GET['admin'] == ""){
    include 'default.php';
}else{
    include 'admin.php';
}
?>
