<?php
include("../../reciclado/conectar_base_datos.php");
if(isset($_POST['postcode'])){

    $data = array();
    $postcode=$_POST['postcode'];
    //$postcode="ge";
    $sqlQuery = "SELECT * FROM customers WHERE postcode LIKE '%" . $postcode . "%' LIMIT 5 ";
    $result = $connect -> query($sqlQuery);

    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $data[]=array(
                'postcode' => $row['postcode'],
                'address' => $row['address'],
                'telephone' => $row['telephone']
            );
        }

    }
    
    echo json_encode($data);


}



?>