<?php
$id_categoria_a_modificar = $_GET['id-mod'];
$nombre_categoria=$_POST['nombre_Categoria'];
include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

$sqlInsertCategoria = "UPDATE categories SET name='$nombre_categoria' WHERE id='$id_categoria_a_modificar'";
$connect -> query($sqlInsertCategoria);
$connect_online -> query($sqlInsertCategoria);

header("location: ../categories");

?>