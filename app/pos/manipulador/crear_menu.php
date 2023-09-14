<?php

include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

if(isset($_POST['producto_a_modificar']) &&  isset($_POST['row1']) && isset($_POST['row2']) && isset($_POST['row3']) && isset($_POST['row4']) && isset($_POST['row5'])){

    $cual_to_m=$_POST['producto_a_modificar'];
    $option1=$_POST['row1'];
    $option2=$_POST['row2'];
    $option3=$_POST['row3'];
    $option4=$_POST['row4'];
    $option5=$_POST['row5'];
    $option6=$_POST['row6'];

    //checkear si existe y sino crear
    $sqlCanecorso = "SELECT * FROM menu WHERE product_id='$cual_to_m'";
    $resCanecorso = $connect -> query($sqlCanecorso);
    if($resCanecorso -> num_rows > 0){ // existe ya

        $modificar_m="UPDATE menu SET category_id1='$option1', category_id2='$option2', category_id3='$option3', category_id4='$option4', category_id5='$option5', category_id6='$option6'  WHERE product_id='$cual_to_m' ";
        $connect-> query($modificar_m);
        $connect_online-> query($modificar_m);
        

    }else{ // no existe


        $crear_m="INSERT INTO menu (product_id, category_id1, category_id2, category_id3, category_id4, category_id5, category_id6) VALUES ('$cual_to_m','$option1','$option2','$option3','$option4','$option5','$option6')";
        $connect-> query($crear_m);
        $connect_online-> query($crear_m);

    }

    header("location: ../take_order.php");


}






?>