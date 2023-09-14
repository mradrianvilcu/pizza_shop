<?php
$id_categoria_a_borrar = $_GET['id-categoria'];


include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

$sqlBorrarCategoria = "DELETE FROM categories WHERE id='$id_categoria_a_borrar'";
$connect -> query($sqlBorrarCategoria);
$connect_online -> query($sqlBorrarCategoria);

header("location: ../categories.php");

?>