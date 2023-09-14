<?php
$domain='';
session_start();
include("../../reciclado/conectar_base_datos.php");


    // USER CONECTADO
if(empty($_SESSION['username_Session'])){    
    $user_conectado = $_COOKIE['username_Cookie'];
}else{
    $user_conectado = $_SESSION['username_Session'];
}

//echo "USER CONECTADO: " . $user_conectado;

// FIN USER CONECTADO


$sqlDeleteCesta = "DELETE FROM cesta WHERE user_id='$user_conectado'";
$connect -> query($sqlDeleteCesta);


header("location: ../../orders_upton_park.php");

?>