   <!-------- START INVOICE KITCHEN ------->


   <div id="invoiceKitchen" style="background-color:white; padding:0.2rem; margin:0.2rem; display:none;">




       <div style="text-align:center; font-size:2rem; margin:1rem;">
           <b># <?php
                session_start();
                include("conectar_base_datos.php");
                $order = $_SESSION['id_imprimir'];

                if ($order < 100) {
                    echo "0" . ($order);
                } else {
                    echo substr($order, -3);
                }
                ?></b>
       </div>

       <?php
        $sqlOrderConcreta = "SELECT * FROM orders WHERE id='$order'";
        $orderConcreta = $connect->query($sqlOrderConcreta);
        if ($orderConcreta->num_rows > 0) {
            $rowOrderConcreta = $orderConcreta->fetch_assoc();
            $pers_id = $rowOrderConcreta['pers_id'];
        ?>
           <div style="text-align:center; font-size:2rem; margin:1rem;">
               <?php

                if (strpos($rowOrderConcreta['postcode'], "GEAM") !== false) {
                    echo "GEAM";
                } else if (strpos($rowOrderConcreta['postcode'], "JUST") !== false) {
                    echo "JUST EAT";
                }

                ?>
           </div>
           <div style="margin-bottom:1rem;"><b><?php echo date("d/m/Y H:i", strtotime($rowOrderConcreta['created_at'])); ?></b></div>

           <?php


            $sqlOrderDetails = "SELECT * FROM order_details WHERE order_id='$pers_id'";
            $orderDetails = $connect->query($sqlOrderDetails);
            if ($orderDetails->num_rows > 0) {



                while ($rowOrderDetails = $orderDetails->fetch_assoc()) {



                    $aux_id_producto = $rowOrderDetails['product_id'];
                    $sqlNameProducto = "SELECT * FROM products WHERE id='$aux_id_producto'";
                    $nameProducto = $connect->query($sqlNameProducto);
                    if ($nameProducto->num_rows > 0) {
                        $resName = $nameProducto->fetch_assoc();

                        echo "<b>" . $rowOrderDetails['quantity'] . "</b>" . " " . $resName['name'] . "<br/>";

                        if ($rowOrderDetails['pro_id1'] == "0") {
                            echo "---------------------------------------------" . "<br/>";
                        } else {
                            for ($c = 1; $c < 7; $c++) {
                                if ($rowOrderDetails['pro_id' . $c] != "0") {
                                    $aux_id_p = $rowOrderDetails['pro_id' . $c];
                                    $sqlNameP = "SELECT * FROM products WHERE id='$aux_id_p'";
                                    $nameP = $connect->query($sqlNameP);
                                    if ($nameP->num_rows > 0) {
                                        $resN = $nameP->fetch_assoc();
                                        if ($resN['name'] != "NULL") {
                                            echo " + " . $resN['name'] . "<br/>";
                                        } else {
                                        }
                                    }
                                }
                            }
                            echo "---------------------------------------------" . "<br/>";
                        }
                    }
                }
            }



            ?>

       <?php
        }

        ?>








       <div>Comments: <?php echo $rowOrderConcreta['comments']; ?></div>
   </div>