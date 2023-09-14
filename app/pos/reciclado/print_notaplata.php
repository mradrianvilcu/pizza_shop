<!-----        START INVOICE --------->

<div id="invoice" style=" width:300px;  border: 1px solid; padding:1rem; margin:1rem; background-color:white;">
        <?php
        session_start();
        include("../../reciclado/conectar_base_datos.php");
        $order = $_SESSION['id_imprimir'];
        $sqlOrderConcreta = "SELECT * FROM orders WHERE id='$order'";
        $orderConcreta = $connect->query($sqlOrderConcreta);
        if ($orderConcreta->num_rows > 0) {
            $rowOrderConcreta = $orderConcreta->fetch_assoc();
            $pers_id=$rowOrderConcreta['pers_id'];
            ?>
            
            <div style="margin-top:1rem;text-align:center;"><img style="width:200px;" src="img/logo.png"></div>
            <div style="margin-bottom:1rem;text-align:center;"><b># <?php 
            //numero orders
            if($rowOrderConcreta['id'] < 100){
                echo "0" . (intval($rowOrderConcreta['id']));
            }else{
               echo substr($rowOrderConcreta['id'], -3);   
            }
            
            ?> </b></div>
             <div>H: <?php echo date("d/m/Y H:i",strtotime($rowOrderConcreta['created_at'])); ?></div>
            <div class="linea">---------------------------------------------</div>
            <div style="margin-top:0.5rem; text-align:left">Postcode: <?php echo $rowOrderConcreta['postcode']; ?></div>
            <div style="text-align:left">Address: <?php echo $rowOrderConcreta['address']; ?></div>
            <div style="text-align:left;">Telephone: <?php echo $rowOrderConcreta['telephone']; ?></div>
            <div style="text-align:left; margin-bottom:0.5rem;">Comments:  <?php echo $rowOrderConcreta['comments']; ?> </div>
            <div class="linea">---------------------------------------------</div>
           
            <!-- tabla compra -->
            <div>
                <table style="width:100%;margin-top:0.5rem;margin-bottom:0.5rem; ">
                    <tr style="display:flex; justify-content:space-between; width:100%; border-bottom-width:1px; border-bottom-style:solid; border-color:black; ">
                        <th style="width:60%; text-align:left">Product</th>
                        <th style="width:20%; text-align:right">Qty</th>
                        <th style="width:20%; text-align:right">Price</th>
                    </tr>

                    <?php
                    $sqlOrderDetails = "SELECT * FROM order_details WHERE order_id='$pers_id' ";
                    $orderDetails = $connect->query($sqlOrderDetails);
                    if ($orderDetails->num_rows > 0) {
                        while ($rowOrderDetails = $orderDetails->fetch_assoc()) { ?>





                            <tr style="display:flex; justify-content:space-between; width:100%; border-bottom-width:1px; border-bottom-style:solid; border-color:black;">
                                <td style="width:60%; text-align:left"> <?php
                                                                        $aux_id_producto = $rowOrderDetails['product_id'];
                                                                        $sqlNameProducto = "SELECT * FROM products WHERE id='$aux_id_producto'";
                                                                        $nameProducto = $connect->query($sqlNameProducto);
                                                                        if ($nameProducto->num_rows > 0) {
                                                                            $resName = $nameProducto->fetch_assoc();

                                                                            echo $resName['name'];
                                                                        }


                                                                        if ($rowOrderDetails['pro_id1'] != "0") { ?>
                                        <ul style="list-style-type:none;">
                                            <?php
                                                                            for ($c = 1; $c < 7; $c++) {
                                                                                if ($rowOrderDetails['pro_id' . $c] != "0") { ?>
                                                    <li><?php
                                                                                    $aux_id_p = $rowOrderDetails['pro_id' . $c];
                                                                                    $sqlNameP = "SELECT * FROM products WHERE id='$aux_id_p'";
                                                                                    $nameP = $connect->query($sqlNameP);
                                                                                    if ($nameP->num_rows > 0) {
                                                                                        $resN = $nameP->fetch_assoc();
                                                                                        if($resN['name'] != "NULL"){
                                                                                            echo "&bull; " . $resN['name'];
                                                                                        }else{}
                                                                                        
                                                                                    }
                                                        ?></li>
                                            <?php
                                                                                }
                                                                            }
                                            ?>
                                        </ul>
                                    <?php

                                                                        } else {
                                                                        }

                                    ?>







                                </td>
                                <td style="width:20%; text-align:right">x<?php echo $rowOrderDetails['quantity']; ?></td>
                                <td style="width:20%; text-align:right">£<?php echo $rowOrderDetails['price']; ?></td>
                            </tr>

                    <?php
                        } ?>

                        
       <?php
                    }
                    ?>


                </table>
            </div>
           
            <div class="linea">---------------------------------------------</div>
            <div style="margin-top:0.5rem;margin-bottom:0.5rem; text-align:right"><b>TOTAL: <?php echo $rowOrderConcreta['total']; ?></b></div>
            <div class="linea">---------------------------------------------</div>
            <div style="font-size:0.5rem;"><?php echo $order?></div>
            <div style="margin-top:1rem;margin-bottom:0.5rem; text-align:center;">www.pizzamaria.uk</div>
            <div style="text-align:center;"><img style="width:100px; height:100px; object-fit:contain;" src="img/qr.png"></div>
            
           
            

        <?php
        }

        ?>
    </div>