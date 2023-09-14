<?php
$nombre_producto=$_POST['nombre_Producto'];
$precio_producto=$_POST['precio_Producto'];
$categoria_producto=$_POST['categoria_Producto'];
$is_pizza=$_POST['is_pizza'];
$is_website = $_POST['is_website'];
include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");


$sqlInsertCategoria = "INSERT INTO products (name,price,category_id,is_pizza,website) VALUES ('$nombre_producto','$precio_producto','$categoria_producto','$is_pizza','$is_website')";
$connect -> query($sqlInsertCategoria);
$connect_online -> query($sqlInsertCategoria);

header("location: /unitypos/myproject/pos/products.php");

?>