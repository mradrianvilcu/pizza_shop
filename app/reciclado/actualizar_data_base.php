<?php
include("conectar_base_datos.php");
include("conectar_base_datos_online.php");
// creo una categoria que se llame imported que su default sea si desde pos, y 
// cuando se haga una order desde
// la pagina web su valor sea no

date_default_timezone_set('Europe/London');
    $timeNow = new DateTime('now');
    $day = $timeNow->format('Y-m-d');
    $datetime1 = $day . " 00:00:00";
    $datetime2 = $day . " 23:59:59";


$sqlImportados = "SELECT * FROM orders WHERE imported='0' && created_at BETWEEN '$datetime1' AND '$datetime2'";
$sqlResultadosImport = $connect_online -> query($sqlImportados);
if($sqlResultadosImport -> num_rows > 0){
    
    while($rowImport = $sqlResultadosImport -> fetch_assoc()){
        //check if exists in our db
        $pers_id=$rowImport['pers_id'];
        $sqlCheckAlreadyImported = "SELECT * FROM orders WHERE pers_id='$pers_id'";
        $sqlCheckImport = $connect -> query($sqlCheckAlreadyImported);
        if($sqlCheckImport -> num_rows > 0){
          //its already in our db so we do nothing  
        }else{
        echo "true";  
        $name=$rowImport['name'];
        $telephone=$rowImport['telephone'];
        $postcode=$rowImport['postcode'];
        $address=$rowImport['address'];
        $total=$rowImport['total'];
        $total_bucatarie=$rowImport['total_bucatarie'];
        $total_pizza=$rowImport['total_pizza'];
        $payment=$rowImport['payment'];
        $branch=$rowImport['branch'];
        $comments=$rowImport['comments'];
        $tacamuri=$rowImport['tacamuri'];
        $printed=$rowImport['printed'];
        $deleted=$rowImport['deleted'];
        $imported='0';
        $created_at=$rowImport['created_at'];
        $updated_at=$rowImport['updated_at'];

        $sqlInsertImport = "INSERT INTO orders (pers_id, name, telephone, postcode, address,
            total, total_bucatarie, total_pizza, payment,branch, comments, tacamuri, printed, 
            deleted, imported, created_at, updated_at
            ) VALUES ('$pers_id', '$name','$telephone', '$postcode', '$address',
            '$total', '$total_bucatarie', '$total_pizza', '$payment','$branch', '$comments', '$tacamuri', '$printed', 
            '$deleted', '$imported', '$created_at', '$updated_at')";
    
            $connect -> query($sqlInsertImport);


            // siempre toca insertar datos
        $sqlImportOrderDetails = "SELECT * FROM order_details WHERE order_id='$pers_id'";
        $sqlResultadosOrderDetails = $connect_online -> query($sqlImportOrderDetails);
        if($sqlResultadosOrderDetails -> num_rows > 0){
                while($rowOrderDetails = $sqlResultadosOrderDetails -> fetch_assoc()){
                   
                    $product_idX = $rowOrderDetails['product_id'];
                    $quantityX = $rowOrderDetails['quantity'];
                    $priceX = $rowOrderDetails['price'];
                    $pro_id1X = $rowOrderDetails['pro_id1'];
                    $pro_id2X = $rowOrderDetails['pro_id2'];
                    $pro_id3X = $rowOrderDetails['pro_id3'];
                    $pro_id4X = $rowOrderDetails['pro_id4'];
                    $pro_id5X = $rowOrderDetails['pro_id5'];
                    $pro_id6X = $rowOrderDetails['pro_id6'];
                    $created_atX = $rowOrderDetails['created_at'];
                    $updated_atX = $rowOrderDetails['updated_at'];
                    
                    //insertamos detalles de la order
                    $sqlInsertOrderDetails = "INSERT INTO order_details (order_id, product_id,
                    quantity, price, pro_id1, pro_id2, pro_id3, pro_id4, pro_id5, pro_id6, 
                    created_at, updated_at) VALUES ('$pers_id', '$product_idX', '$quantityX' , '$priceX', '$pro_id1X',
                    '$pro_id2X', '$pro_id3X', '$pro_id4X', '$pro_id5X', '$pro_id6X', '$created_atX', '$updated_atX')";
  
                     $connect -> query($sqlInsertOrderDetails);
                     
                }
            }


        }
        
         
        
    }
}else{
    echo "false";
}

?>