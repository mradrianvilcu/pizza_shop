<?php
$postcode=$_POST['postcode'];
//$postcode="E15 3PN 18";
//echo $postcode;
$postcode_sin_espacio=explode(" ", $postcode);
//echo "<br/>";
//echo $postcode_sin_espacio[0];
//echo "<br/>";

// USER CONECTADO
if(empty($_SESSION['username_Session'])){    
    $user_conectado = $_COOKIE['username_Cookie'];
}else{
    $user_conectado = $_SESSION['username_Session'];
}

//echo "USER CONECTADO: " . $user_conectado;

// FIN USER CONECTADO

if(strlen($postcode_sin_espacio[0]) <= 3){
    //echo "POSTCODE DIRECTO";
    $postcodefinal = $postcode_sin_espacio[0] . $postcode_sin_espacio[1][0];
}else if((strlen($postcode_sin_espacio[0]) >= 5) && (strlen($postcode_sin_espacio[0]) <= 7)){
    //echo "POSTCODE PARA SEGUIR ANALIZANDO";
    $postcodefinal = substr_replace($postcode_sin_espacio[0], "", -3) . $postcode_sin_espacio[0][-3];
}


//echo "<br/>";
//echo "postcode final: " . $postcodefinal;
//echo "<br/>";

//delivery charge 1
//delivery charge 2
//delivery charge 3
//delivery charge 4
//delivery charge 5

include("../../reciclado/conectar_base_datos.php");
$select_charge = "SELECT * FROM charge WHERE postcode='$postcodefinal'";
$charge = $connect->query($select_charge);
if ($charge->num_rows > 0) {  // si hay alguna order

    $deliverycharge = $charge->fetch_assoc();
    $auxCantidadCharge = $deliverycharge['charge'];
    $auxProductoCharge = "Delivery CHARGE " . $auxCantidadCharge;
    //echo $auxCantidadCharge;

    $sqlBuscarProductoCharge = "SELECT * FROM products WHERE name='$auxProductoCharge'";
    $proCharge = $connect -> query($sqlBuscarProductoCharge);
    if($proCharge -> num_rows > 0){
           
        $el_charge = $proCharge-> fetch_assoc();
        $aux_el_charge=$el_charge['id'];

         $sqlAniadirCharge = "INSERT INTO cesta (user_id, product_id, quantity, price, pro_id1, pro_id2, pro_id3, pro_id4, pro_id5, pro_id6) VALUES('$user_conectado', $aux_el_charge, '1','$auxCantidadCharge','0','0','0','0','0','0')";
         $connect -> query($sqlAniadirCharge);
        

    }

   
}

?>