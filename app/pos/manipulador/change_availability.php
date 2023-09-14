<?php
include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");
$product_id=$_POST['product_id'];
$available=$_POST['available'];

$sqlChangeA = "UPDATE products SET available='$available' WHERE id='$product_id'";
$connect -> query($sqlChangeA);
$connect_online -> query($sqlChangeA);
echo $product_id . " " . $available;

?>