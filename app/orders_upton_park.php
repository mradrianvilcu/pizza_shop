<html>

<head>
  <link href="css/index.css" type="text/css" rel="stylesheet" />
  <link href="css/imprimir.css" type="text/css" rel="stylesheet" />
  <script src="javascript/ajax.js"></script>
  <script src="javascript/temporizador_reload.js"></script>
</head>

<body onload="imp_kitchen(), imp_invoice(), imp_deleted(), temp_reload(),temp_reload2(),temp_reload3()">

  <?php
  include("reciclado/conectar_base_datos.php");
  include("reciclado/session.php");
  session_start();
  $cantidad_orders=0;
  $cantidad_printed_orders=0;
  $nr_not_deleted_orders=0;
  ?>
  <div id="divPadre">
    <div ><a id="btnTakeOrder" href="pos/take_order.php">Take Order</a></div>
    <!---- INICIO DIV PADRE ---->

    <!-- VER QUIEN ESTA LOGEADO EN ESTA CUENTA -->
    <div>Logged as: <?php 
    if(isset($_COOKIE['username_Cookie'])){    
        echo $_COOKIE['username_Cookie'];
    }else{
    }
    ?></div>



    <?php
       //sacar las dos fechas de hoy
    date_default_timezone_set('Europe/London');
    $timeNow = new DateTime('now');
    $day = $timeNow->format('Y-m-d');
    $datetime1 = $day . " 00:00:00";
    $datetime2 = $day . " 23:59:59";
    
    $sqlverOrders = "SELECT * FROM orders  WHERE created_at BETWEEN '$datetime1' AND '$datetime2' AND branch='upton_park' ORDER BY id DESC";
    $orders = $connect->query($sqlverOrders);
    if ($orders->num_rows > 0) {  // si hay alguna order
     
      while ($rowOrders = $orders->fetch_assoc()) { // recorre todas las orders 
          
          $cantidad_orders++;

          if($rowOrders['printed'] == 0){ // no esta impreso ?>
  <div class="divHijoNoEnviado" id="div_order<?php echo $rowOrders['id']; ?>"> 
          <?php }else{ // esta impreso
              $cantidad_printed_orders++;
            ?>

            <div class="divHijoEnviado" id="div_order<?php echo $rowOrders['id']; ?>"> 
          <?php } ?>
         
          <div><b># <?php 
                                        if($rowOrders['id'] < 100){
                                            echo "0" . (intval($rowOrders['id']));
                                        }else{
                                           echo substr($rowOrders['id'], -3);   
                                        }
                                        ?></b>
                                        <a href="view_order.php?id_order=<?php echo $rowOrders['id']; ?>"><img class="view_order" src="img/eye.png"> </a>
                                    </div>
                                    
                                        <div style="text-align:center; padding:0.5rem;">
                                        <?php 
                                           if(strpos($rowOrders['branch'],"upton_park") !== false){
                                            echo "<b>UPTON PARK</b>";
                                        }else if(strpos($rowOrders['branch'],"beckton") !== false){
                                            echo "<b>BECKTON</b>";
                                        }
                                        ?>
                                        
                                    </div>

                   <!-- SACAR CANTIDAD DE ORDERS HECHAS A ESA DIRECCION-->
   <?php
             $postcodeRep = $rowOrders['postcode'];
             $repeticiones= 0;
             $sqlCuantasOrders = "SELECT * FROM orders WHERE postcode='$postcodeRep'";
             $repOrders = $connect -> query($sqlCuantasOrders);
             if($repOrders -> num_rows > 0){
                while($repO = $repOrders->fetch_assoc()){
                    $repeticiones++;    
                }
             }
            ?>


                                    
                                      <!-- ENLACE QUE LLEVA A MODIFICAR LA ORDER -->
                                      <?php
                    if($rowOrders['deleted'] == '0'){ 
                        $nr_not_deleted_orders++;
                        ?>
                     <a id="enlacemodificar" href="pos/take_order.php?order=<?php echo $rowOrders['id']; ?>">
                            <div>H: <?php echo date("d/m/Y H:i",strtotime($rowOrders['created_at'])); ?></div>
                            <div>Postcode: <?php echo $rowOrders['postcode']; ?></div>
                            <div>Address: <?php echo $rowOrders['address']; ?></div>
                            <div><b>Total: <?php echo $rowOrders['total']; ?></b></div>
                            <div>Ordered <?php echo $repeticiones; ?> times</div>
                            <div>Comments: <?php echo $rowOrders['comments']; ?></div>
                            <div>Name: <?php echo $rowOrders['name']; ?></div>
                            <div>Payment: <?php echo $rowOrders['payment']; ?></div>
                            <?php 
                            $comparador1 = date("d/m/Y H:i",strtotime($rowOrders['created_at']));
                            $comparador2 = date("d/m/Y H:i",strtotime($rowOrders['updated_at']));
                            if($comparador1 != $comparador2){ ?>
                            <div>STARTING TIME: <?php echo date("H:i",strtotime($rowOrders['updated_at'])); ?></div>
                            <?php
                            }?>
                            </a>
                  <?php  }else{  ?>
                    <div>H: <?php echo date("d/m/Y H:i",strtotime($rowOrders['created_at'])); ?></div>
                            <div>Postcode: <?php echo $rowOrders['postcode']; ?></div>
                            <div>Address: <?php echo $rowOrders['address']; ?></div>
                            <div><b>Total: <?php echo $rowOrders['total']; ?></b></div>
                            <div>Ordered <?php echo $repeticiones; ?> times</div>
                            <div>Comments: <?php echo $rowOrders['comments']; ?></div>
                            <div>Name: <?php echo $rowOrders['name']; ?></div>
                            <div>Payment: <?php echo $rowOrders['payment']; ?></div>
                            <?php 
                            $comparador1 = date("d/m/Y H:i",strtotime($rowOrders['created_at']));
                            $comparador2 = date("d/m/Y H:i",strtotime($rowOrders['updated_at']));
                            if($comparador1 != $comparador2){ ?>
                            <div>STARTING TIME: <?php echo date("H:i",strtotime($rowOrders['updated_at'])); ?></div>
                            <?php
                            }?>
                  <?php  }
              ?>
                            

               <!-----        START INVOICE --------->


            <div id="<?php echo "invoice" . $rowOrders['id'] ?>" style=" width:300px;  border: 1px solid; padding:1rem; display:none;">
        <?php
        $pers_id2=$rowOrders['pers_id'];
        $sqlOrderConcreta2 = "SELECT * FROM orders WHERE pers_id='$pers_id2'";
        $orderConcreta2 = $connect->query($sqlOrderConcreta2);
        if ($orderConcreta2->num_rows > 0) {
            $rowOrderConcreta2 = $orderConcreta2->fetch_assoc(); ?>

            <div style="margin-top:1rem;text-align:center;"><img style="width:200px;" src="img/logo.png"></div>
            <div style="margin-bottom:1rem;text-align:center;"><b># <?php 
            //numero orders
            if($rowOrders['id'] < 100){
                echo "0 " . (intval($rowOrders['id']));
            }else{
               echo substr($rowOrders['id'], -3);   
            }
            
            ?> </b></div>
          
                <div>H: <?php echo date("d/m/Y H:i",strtotime($rowOrders['created_at'])); ?></div>
            <div class="linea">---------------------------------------------</div>
            <div style="margin-top:0.5rem; text-align:left">Postcode: <?php echo $rowOrderConcreta2['postcode']; ?></div>
            <div style="text-align:left">Address: <?php echo $rowOrderConcreta2['address']; ?></div>
            <div style="text-align:left;">Telephone: <?php echo $rowOrderConcreta2['telephone']; ?></div>
            <div style="text-align:left;">Tacamuri: <?php 
             if($rowOrderConcreta2['tacamuri']==1){
                echo "YES";
             }else{
                echo "NO";
             }
             ?>
             </div>
            <div style="text-align:left; margin-bottom:0.5rem;">Comments:  <?php echo $rowOrderConcreta2['comments']; ?> </div>
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
                    $sqlOrderDetails2 = "SELECT * FROM order_details WHERE order_id='$pers_id2' ";
                    $orderDetails2 = $connect->query($sqlOrderDetails2);
                    if ($orderDetails2->num_rows > 0) {
                        while ($rowOrderDetails2 = $orderDetails2->fetch_assoc()) { ?>





                            <tr style="display:flex; justify-content:space-between; width:100%; border-bottom-width:1px; border-bottom-style:solid; border-color:black;">
                                <td style="width:60%; text-align:left"> <?php
                                                                        $aux_id_producto2 = $rowOrderDetails2['product_id'];
                                                                        $sqlNameProducto2 = "SELECT * FROM products WHERE id='$aux_id_producto2'";
                                                                        $nameProducto2 = $connect->query($sqlNameProducto2);
                                                                        if ($nameProducto2->num_rows > 0) {
                                                                            $resName2 = $nameProducto2->fetch_assoc();

                                                                            echo $resName2['name'];
                                                                        }


                                                                        if ($rowOrderDetails2['pro_id1'] != "0") { ?>
                                        <ul style="padding:0; list-style-type:none;">
                                            <?php
                                                                            for ($c = 1; $c < 7; $c++) {
                                                                                if ($rowOrderDetails2['pro_id' . $c] != "0") { ?>
                                                    <li><?php
                                                                                    $aux_id_p2 = $rowOrderDetails2['pro_id' . $c];
                                                                                    $sqlNameP2 = "SELECT * FROM products WHERE id='$aux_id_p2'";
                                                                                    $nameP2 = $connect->query($sqlNameP2);
                                                                                    if ($nameP2->num_rows > 0) {
                                                                                        $resN2 = $nameP2->fetch_assoc();
                                                                                        if($resN2['name'] != "NULL"){
                                                                                            echo "&nbsp; &bull;" . $resN2['name'];
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
                                <td style="width:20%; text-align:right">x<?php echo $rowOrderDetails2['quantity']; ?></td>
                                <td style="width:20%; text-align:right">£<?php echo $rowOrderDetails2['price']; ?></td>
                            </tr>

                    <?php
                        } ?>

                        
       <?php
                    }
                    ?>


                </table>
            </div>
           
            <div class="linea">---------------------------------------------</div>
            <div style="margin-top:0.5rem;margin-bottom:0.5rem; text-align:right"><b>TOTAL: <?php echo $rowOrderConcreta2['total']; ?></b></div>
            <div class="linea">---------------------------------------------</div>
            <div class="linea">Ordered <?php echo $repeticiones; ?> times</div>
            <div class="linea">Toate produsele au TVA 20%.</div>
            <div class="linea">Va multumim!</div>
            <div class="linea">---------------------------------------------</div>
            <div class="linea">Business Name: CONAMOR LTD</div>
            <div class="linea">F. Popescu</div>
            <div class="linea">Sort Code:20-06-09</div>
            <div class="linea">Account Number:13310728</div>
            <div style="font-size:0.5rem;"><?php echo $rowOrders['id']?></div>
            <div style="margin-top:1rem;margin-bottom:0.5rem; text-align:center;">www.pizzamaria.uk</div>
            <div style="text-align:center;"><img style="width:100px; height:100px; object-fit:contain;" src="img/qr.png"></div>
            
           
            

        <?php
        }

        ?>
    </div>
             
             <!-- BOTONES -->
              
              <div class="invoice" id=<?php echo "btnInvoice" . $rowOrders['id']; ?>>INVOICE</div>
              <div><select>
                <option> Select Driver </option>
                <option value="viki" class="drivers" <?php if($rowOrders['driver'] == "viki"){ echo "selected"; } ?>> Viki </option>
                <option value="raja" <?php if($rowOrders['driver'] == "raja"){ echo "selected"; } ?>> Raja </option>
                <option value="nasir" <?php if($rowOrders['driver'] == "nasir"){ echo "selected"; } ?>> Nasir </option>
                <option value="mun"<?php if($rowOrders['driver'] == "mun"){ echo "selected"; } ?>> Mun </option>
              </select>
              <select>
                
                           <option <?php if($rowOrders['paid'] == "notpaid"){ echo "selected";} ?>> Not Paid </option>
                           <option <?php if($rowOrders['paid'] == "cash"){ echo "selected";} ?>> Cash </option>
                           <option <?php if($rowOrders['paid'] == "card"){ echo "selected";} ?>> Card </option>
                           <option <?php if($rowOrders['paid'] == "transfer"){ echo "selected";} ?>> Transfer </option>
              </select></div>
              <?php
                    if($rowOrders['deleted'] == '0'){ ?>
                     <div class="kitchen" id=<?php echo "btnKitchen" . $rowOrders['id']; ?>>KITCHEN</div>
                      <div class="kitchen2" id=<?php echo "btnDelete" . $rowOrders['id']; ?>>DELETE</div>
                  <?php  }else{  ?>
                    <div class="kitchenY">KITCHEN</div>
                    <div class="kitchenX">DELETED</div>
                  <?php  }
              ?>

             
              </div>



        <?php
       
           
        }
        
      }else{
    
      }

      
        ?>


            </div>
            <!---- FIN DIV PADRE ---->

            <div style="display:none"><b>ORDERS: <p id="nr_orders"><?php echo $cantidad_orders; ?></p></b></div>
            <div><b>ORDERS: <p><?php echo $nr_not_deleted_orders; ?></p></b></div>
            <div style="display:none"><b>PRINTED ORDERS: <p id="nr_printed_orders"><?php echo $cantidad_printed_orders; ?></p></b></div>
</body>

</html>