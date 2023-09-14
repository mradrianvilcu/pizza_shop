<?php
include("../../reciclado/conectar_base_datos.php");

$elid=$_POST['elid'];
$sqlBuscaElNombre = "SELECT * FROM products WHERE id='$elid'";
$resultadosBuscaNombre= $connect -> query($sqlBuscaElNombre);
if($resultadosBuscaNombre -> num_rows > 0){
    $resBuscaNombre = $resultadosBuscaNombre -> fetch_assoc();
    echo $resBuscaNombre['name'];
}else{
    echo "NULL";
}


?>