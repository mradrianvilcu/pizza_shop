<?php
$id_categoria_a_modificar = $_GET['id-mod'];
$nom_pro = $_POST['nombre_Producto'];
$pre_pro = $_POST['precio_Producto'];
$cat_pro = $_POST['categoria_Producto'];
$is_pizza = $_POST['is_pizza'];
$is_website = $_POST['is_website'];

include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

$sqlInsertCategoria = "UPDATE products SET name='$nom_pro', price='$pre_pro', category_id='$cat_pro', website='$is_website',is_pizza='$is_pizza' WHERE id='$id_categoria_a_modificar'";
$connect -> query($sqlInsertCategoria);
$connect_online -> query($sqlInsertCategoria);

header("location: ../products.php");

?>