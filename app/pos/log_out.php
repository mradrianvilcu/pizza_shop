<?php
//destruimos cookies
$aux_username = $_COOKIE['username_Cookie'];
setcookie("username_Cookie",$aux_username,time() - 3600 * 24 * 30,"/");

header('location: ../index.php');

?>