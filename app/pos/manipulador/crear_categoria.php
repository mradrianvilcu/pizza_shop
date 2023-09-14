<?php
$nombre_categoria=$_POST['nombre_Categoria'];
include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

$sqlInsertCategoria = "INSERT INTO categories (name) VALUES ('$nombre_categoria')";
$connect -> query($sqlInsertCategoria);
$connect_online -> query($sqlInsertCategoria);

header("location: ../categories");

?>