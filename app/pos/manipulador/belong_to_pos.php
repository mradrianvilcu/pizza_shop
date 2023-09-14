<?php
include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

if(isset($_POST['belong_to_m']) && isset($_POST['view'])){
   
    $aux_belong_to_m=$_POST['belong_to_m'];
    $aux_view=$_POST['view'];

    $sqlVerEnMenu = "UPDATE products SET belong_menu='$aux_view' WHERE id='$aux_belong_to_m'";
    $connect -> query($sqlVerEnMenu);
    $connect_online -> query($sqlVerEnMenu);

    header("location: ../belong_menu.php");
}

?>