<?php 
include("../../reciclado/connect_database.php");
$product_id = $_POST['pro_id'];
//$product_id = 110;

$sqlName="SELECT * from products WHERE id='$product_id'";
$resName=$connect->query($sqlName);
if($resName->num_rows>0){
    $rowName=$resName->fetch_assoc();

    echo $rowName['name'] . ": £" . $rowName['price'];
}

?>
