<?php
session_start();
$id_order = $_SESSION['id_imprimir'];
include("../../reciclado/conectar_base_datos.php");


    // configurar como enviado
    $sqlImpreso = "UPDATE orders SET printed='1' WHERE id='$id_order'";
    $connect -> query($sqlImpreso);

   

?>