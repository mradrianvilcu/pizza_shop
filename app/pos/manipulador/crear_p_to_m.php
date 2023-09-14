<?php

include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

if(isset($_POST['producto_to_m']) &&  isset($_POST['es_to_m']) ){

    $cual_to_m=$_POST['producto_to_m'];
    $option_to_m=$_POST['es_to_m'];
    $modificar_m="UPDATE products SET menu='$option_to_m' WHERE id='$cual_to_m' ";
    $connect-> query($modificar_m);
    $connect_online-> query($modificar_m);
    header("location: ../create_menu.php");

}






?>