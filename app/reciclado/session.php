<?php

error_reporting(E_ERROR | E_PARSE);
//error_reporting(0);
if(empty($_COOKIE['username_Cookie']))  {
    header('location: index.php');
}


?>