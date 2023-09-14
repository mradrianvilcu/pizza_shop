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
 
$sqlverOrders = "SELECT * FROM orders  WHERE created_at BETWEEN '$datetime1' AND '$datetime2' && WHERE printed='1'";
$orders = $connect->query($sqlverOrders);
if ($orders->num_rows > 0) {  // si hay alguna order

    while ($rowOrders = $orders->fetch_assoc()) { // recorre todas las orders 

        $sqlFecha = "SELECT LOCALTIME";

        $resultadoFecha = $connect->query($sqlFecha);

        $fecha = $resultadoFecha->fetch_assoc();


        $datetime1 = strtotime(date($fecha['LOCALTIME']));
        $datetime2 = strtotime($rowOrders['created_at']);


        $secs = abs($datetime2 - $datetime1); // == <seconds between the two times>
        $hours = $secs / (60 * 60);


        if ($hours < 14) { // menos de 14h
            $cantidad_orders++;
        }

    }

}
     
    echo $cantidad_orders;


?>