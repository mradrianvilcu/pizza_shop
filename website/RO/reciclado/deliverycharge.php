<?php
//--------------- AGREGAR CHARGE -----------------------
$postcode=$_POST['postcode'];
$notFound = false;
$postcode_sin_espacio=str_replace(" ", "" ,$postcode);


include("../../reciclado/connect_database.php");
$select_tabla_charge = "SELECT * FROM charge";
$tabla_charge = $connect->query($select_tabla_charge);
if ($tabla_charge->num_rows > 0) {
    while($row_charge = $tabla_charge -> fetch_assoc()){
        $aux_check_charge = strtoupper($row_charge['postcode']);
        $aux_check = strtoupper($postcode_sin_espacio);
        
         if(str_starts_with($aux_check, $aux_check_charge)){
            echo "Delivery charge: £" . $row_charge['charge'] . " ref: " . $aux_check_charge;
            $notFound = false;
            break;
         }else{
            $notFound = true;
         }
    }
   
    if($notFound == true){
        echo "Postcode out of delivery area.";
     }


}else{
    echo "ERROR";
}

?>