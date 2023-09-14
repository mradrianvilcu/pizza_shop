<?php
$charge_a_modificar = $_GET['id-mod'];
$charge = $_POST['charge'];


include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

$sqlInsertCategoria = "UPDATE charge SET charge='$charge' WHERE id='$charge_a_modificar'";
$connect -> query($sqlInsertCategoria);
$connect_online -> query($sqlInsertCategoria);

header("location: ../delivery_charge.php");

?>