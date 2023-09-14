<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
//error_reporting(0);
if((empty($_SESSION['username_Session'] AND $_SESSION['password_Session']) AND empty($_COOKIE['username_Cookie'] AND $_COOKIE['password_Cookie'])  ))  {
    header('location: index.php');
}


?>