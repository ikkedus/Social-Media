<?php
date_default_timezone_set('UTC');

if(!isset($_GET['admin']) || $_GET['admin'] == ""){
    include 'default.php';
}else{
    include 'admin.php';
}
?>