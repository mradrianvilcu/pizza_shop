<?php
session_start();
$cantidad = $_POST['total'];
if($cantidad > 0){
    $_SESSION["totalM0"] = true;
}else if(isset($_SESSION["totalM0"])){
    unset($_SESSION["totalM0"]);
}else{
    session_destroy();
}
?>