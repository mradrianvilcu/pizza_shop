<?php
include("../../reciclado/connect_database.php");

$select_tabla_charge = "SELECT * FROM charge";
$tabla_charge = $connect->query($select_tabla_charge);
if ($tabla_charge->num_rows > 0) {
    while($row_charge = $tabla_charge -> fetch_assoc()){
        
        echo $row_charge['postcode'] ;
        
        
    }


}



?>