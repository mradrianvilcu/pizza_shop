<?php
$id_order = $_POST['id_order'];
//$id_order = 832;
//echo $id_order  . "<br/>";
include("reciclado/conectar_base_datos.php");
include("reciclado/conectar_base_datos_online.php");

//  GET PERS_ID

$sqlPersId="SELECT * FROM orders WHERE id='$id_order'";
$resultadoPersId= $connect-> query($sqlPersId);
if($resultadoPersId -> num_rows > 0){
    $rowPersId = $resultadoPersId -> fetch_assoc();
    $id_personalizado = $rowPersId['pers_id'];
}

//echo $id_personalizado . "<br/>";


$path_kitchen_invoice="C:/xampp/htdocs/unitypos/myproject/last_kitchen_invoice.txt";


$sqlOrderConcreta = "SELECT * FROM orders WHERE id='$id_order' AND deleted='0'";
        $orderConcreta = $connect->query($sqlOrderConcreta);
        if ($orderConcreta->num_rows > 0) {
            $rowOrderConcreta = $orderConcreta->fetch_assoc();
                                        shell_exec("echo." . " > " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo." . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo " . "----------------------------" . " >> " . $path_kitchen_invoice);
                                        
                                        if($rowOrderConcreta['printed']=="1"){
                                            shell_exec("echo" . " RE-PRINTED" . " >> " . $path_kitchen_invoice);
                                        }
                                         // 3 ultimas cifras del id
                                        if($id_order < 100){
                                            echo "#00" . ($id_order) . "<br/>";
                                            shell_exec("echo #00" . $id_order . " >> " . $path_kitchen_invoice);
                                        }else if($id_order < 100){
                                            echo "#0" . ($id_order) . "<br/>";
                                            shell_exec("echo #0" . $id_order . " >> " . $path_kitchen_invoice);
                                        }else{
                                           echo "#" . substr($id_order, -3) . "<br/>";   
                                           shell_exec("echo #" . substr($id_order, -3) . " >> " . $path_kitchen_invoice);
                                        }
                                        
                                        if($rowOrderConcreta['tacamuri']==1){
                                            $aux_kitchen_tacamuri="--- CU TACAMURI ---";
                                        }else{
                                            $aux_kitchen_tacamuri="--- FARA TACAMURI ---";
                                        }

                                        shell_exec("echo " . $aux_kitchen_tacamuri . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo " . date("H:i d/m/Y ",strtotime($rowOrderConcreta['created_at'])) . " >> " . $path_kitchen_invoice);
                                        shell_exec("echo " . $rowOrderConcreta['postcode'] . " >> " . $path_kitchen_invoice);
                                        /*
                                        // geam o just eat
                                        if(strpos($rowOrderConcreta['postcode'],"GEAM") !== false){
                                            echo "GEAM <br/>";
                                            shell_exec("echo " . "----------------------------" . " >> " . $path_kitchen_invoice);
                                            shell_exec("echo " . "GEAM" . " >> " . $path_kitchen_invoice);
                                        }else if(strpos($rowOrderConcreta['postcode'],"JUST") !== false){
                                            echo "JUST EAT <br/>";
                                            shell_exec("echo " . "----------------------------" . " >> " . $path_kitchen_invoice);
                                            shell_exec("echo " . "JUST EAT" . " >> " . $path_kitchen_invoice);
                                        }
                                        */
                                       
                                        
                echo "-------------------------------------------------------" . "<br/>";
          
                
                shell_exec("echo " . "----------------------------" . " >> " . $path_kitchen_invoice);
         

                $sqlOrderDetails = "SELECT * FROM order_details WHERE order_id='$id_personalizado'";
                    $orderDetails = $connect->query($sqlOrderDetails);
                    if ($orderDetails->num_rows > 0) {
                        while ($rowOrderDetails = $orderDetails->fetch_assoc()) {

                            $aux_id_producto = $rowOrderDetails['product_id'];
                            $sqlNameProducto = "SELECT * FROM products WHERE id='$aux_id_producto'";
                            $nameProducto = $connect->query($sqlNameProducto);
                            if ($nameProducto->num_rows > 0) {
                                $resName = $nameProducto->fetch_assoc();
                                
                                if(strpos($resName['name'], "Delivery") !== false){
                                    echo "Delivery Word Found!";
                                } else{
                                    
                                    echo $rowOrderDetails['quantity'] . " " . $resName['name'] . "<br/>";
                        
                                    shell_exec("echo " .  $rowOrderDetails['quantity'] . " " . $resName['name'] . " >> " . $path_kitchen_invoice);
                                }
                               
                       
                               
                                
                                if ($rowOrderDetails['pro_id1'] == "0") {
                                    // si no es menu
                                    echo "-------------------------------------------------------" . "<br/>";
                         
                                    shell_exec("echo " . "----------------------------" . " >> " . $path_kitchen_invoice);
                        
                                }else{
                                    // si es menu
                                    for ($c = 1; $c < 7; $c++) {
                                        if ($rowOrderDetails['pro_id' . $c] != "0") {
                                                $aux_id_p = $rowOrderDetails['pro_id' . $c];
                                                $sqlNameP = "SELECT * FROM products WHERE id='$aux_id_p'";
                                                $nameP = $connect->query($sqlNameP);
                                                     if ($nameP->num_rows > 0) {
                                                             $resN = $nameP->fetch_assoc();
                                                             if($resN['name'] != "NULL"){
                                                                echo " + " .$resN['name'] . "<br/>";
                                                             shell_exec("echo " . " + " .$resN['name'] . " >> " . $path_kitchen_invoice);
                                                            }else{}
                                                             
                                                             
                                                     }
                                        }
                                    }

                                    echo "-------------------------------------------------------" . "<br/>";
                        
                                    shell_exec("echo " . "----------------------------" . " >> " . $path_kitchen_invoice);
                          
                                }

                                 

                                 


                            }

                        }

                    }
              //starting time
        
                            $comparador1 = date("d/m/Y H:i",strtotime($rowOrderConcreta['created_at']));
                            $comparador2 = date("d/m/Y H:i",strtotime($rowOrderConcreta['updated_at']));
                            if($comparador1 != $comparador2){ 
                                     $auxiliarFecha = date("d/m/Y H:i",strtotime($rowOrderConcreta['updated_at']));
                                     shell_exec("echo " . "START TIME: " . $auxiliarFecha . " >> " . $path_kitchen_invoice);
                            }
              
             // comments
                    echo "Comments: " . $rowOrderConcreta['comments'] . "<br/>";
                                 shell_exec("echo " . "Comments: " . $rowOrderConcreta['comments'] . " >> " . $path_kitchen_invoice);
                
           

                 //enviar .txt a impresora
        $printer1="Bucatarie";
        $printer2="Bucatarie2";
        $printer3="Bucatarie3";
        
        exec("start /min notepad /PT \"$path_kitchen_invoice\" \"$printer1\"");
        exec("start /min notepad /PT \"$path_kitchen_invoice\" \"$printer2\"");
        exec("start /min notepad /PT \"$path_kitchen_invoice\" \"$printer3\"");
        //exec("start /min notepad /PT " . $path_kitchen_invoice . " " . $printer1); // imprimir segunda vez


         //cambiamos el valor de la tabla a impreso
         $sqlImpreso = "UPDATE orders SET printed='1' WHERE pers_id='$id_personalizado'";
         $connect -> query($sqlImpreso);
         $connect_online -> query($sqlImpreso);



        }


   

?>