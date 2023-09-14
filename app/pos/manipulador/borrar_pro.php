<?php
$id_categoria_a_modificar = $_GET['id-producto'];


include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

$sqlInsertCategoria = "DELETE FROM products WHERE id='$id_categoria_a_modificar'";
$connect -> query($sqlInsertCategoria);
$connect_online -> query($sqlInsertCategoria);

header("location: ../products.php");

?>