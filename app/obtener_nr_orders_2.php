<?php 
include("reciclado/conectar_base_datos.php");
$cantidad_viejas=$_POST['orders_viejas'];
$cantidad_orders = 0;

 //sacar las dos fechas de hoy
 date_default_timezone_set('Europe/London');
 $timeNow = new DateTime('now');
 $day = $timeNow->format('Y-m-d');
 $datetime1 = $day . " 00:00:00";
 $datetime2 = $day . " 23:59:59";
 
$sqlverOrders = "SELECT * FROM orders  WHERE created_at BETWEEN '$datetime1' AND '$datetime2'";

$orders = $connect->query($sqlverOrders);
if ($orders->num_rows > 0) {  // si hay alguna order

    while ($rowOrders = $orders->fetch_assoc()) { // recorre todas las orders 

            $cantidad_orders++;

    }

}
     
    echo $cantidad_orders;


?>