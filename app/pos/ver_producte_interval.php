<html>

<head>
    <link href="css/links.css" type="text/css" rel="stylesheet" />
    <link href="css/form.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <?php
       include ("../reciclado/session2.php");
       include("reciclado/links.php");
       include("../reciclado/conectar_base_datos.php");


    ?>


    <div style=" margin-top:5rem; display:flex; align-items:center; justify-content:center;">
        <form action="ver_producte_interval.php" method="GET">
            <div class="fila">
                <label for="branch">Branch: </label>
                <select id="branch" name="branch">
                    <option value="upton_park"> Upton Park </option>
                    <option value="beckton"> Beckton </option>

                </select>
            </div>
            <div class="fila">
                <label for="product_1">Product 1: </label>
                <select id="product_1" name="product_1">
                     <?php
                           $sql_get_products="SELECT * FROM products ORDER BY name"; 
                           $resultados_productos=$connect->query($sql_get_products);
                  
                           if($resultados_productos->num_rows > 0){
                               while($row=$resultados_productos->fetch_assoc()){
                                   echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                               }
                           }
                  

                     ?>

                </select>
            </div>
            <div class="fila">
                <label for="product_2">Product 2: </label>
                <select id="product_2" name="product_2">
                     <?php
                           $sql_get_products="SELECT * FROM products ORDER BY name"; 
                           $resultados_productos=$connect->query($sql_get_products);
                  
                           if($resultados_productos->num_rows > 0){
                               while($row=$resultados_productos->fetch_assoc()){
                                   echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                               }
                           }
                  

                     ?>

                </select>
            </div>
            <div class="fila">
                <label for="product_3">Product 3: </label>
                <select id="product_3" name="product_3">
                     <?php
                           $sql_get_products="SELECT * FROM products ORDER BY name"; 
                           $resultados_productos=$connect->query($sql_get_products);
                  
                           if($resultados_productos->num_rows > 0){
                               while($row=$resultados_productos->fetch_assoc()){
                                   echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                               }
                           }
                  

                     ?>

                </select>
            </div>
            <div class="fila">
                <label for="product_4">Product 4: </label>
                <select id="product_4" name="product_4">
                     <?php
                           $sql_get_products="SELECT * FROM products ORDER BY name"; 
                           $resultados_productos=$connect->query($sql_get_products);
                  
                           if($resultados_productos->num_rows > 0){
                               while($row=$resultados_productos->fetch_assoc()){
                                   echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                               }
                           }
                  

                     ?>

                </select>
            </div>
            <div class="fila">
                <label for="product_5">Product 5: </label>
                <select id="product_5" name="product_5">
                     <?php
                           $sql_get_products="SELECT * FROM products ORDER BY name"; 
                           $resultados_productos=$connect->query($sql_get_products);
                  
                           if($resultados_productos->num_rows > 0){
                               while($row=$resultados_productos->fetch_assoc()){
                                   echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                               }
                           }
                  

                     ?>

                </select>
            </div>
            <div class="fila">
                <label for="start_date">Start Date: </label>
                <input type="date" name="start_date" id="start_date" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div class="fila">
                <label for="end_date">End Date: </label>
                <input type="date" name="end_date" id="end_date" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div style="text-align:center;" class="fila">
                <button type="submit" style="background-color:black; color:white;padding:0.5rem;">CHECK TOTAL</button>
            </div>
        </form>
    </div>





    <!------------  VER ORDERS  ----------->
    <div style=" margin-top:4rem; display: flex; flex-direction:column; align-items:center;">
        <!---- INICIO DIV PADRE ---->
        <?php


        if ($_GET['start_date'] && $_GET['end_date']) {
            $aux_branch = $_GET['branch'];
            $start_date = strtotime($_GET['start_date']);
            $end_date = strtotime($_GET['end_date']);
            $aux_product1 = $_GET['product_1'];
            $aux_price_product1=0;
            $aux_quantity_product1=0;
            //echo  $aux_product1;
            $aux_product2 = $_GET['product_2'];
            $aux_quantity_product2=0;
            $aux_price_product2=0;
            $aux_product3 = $_GET['product_3'];
            $aux_quantity_product3=0;
            $aux_price_product3=0;
            $aux_product4 = $_GET['product_4'];
            $aux_quantity_product4=0;
            $aux_price_product4=0;
            $aux_product5 = $_GET['product_5'];
            $aux_quantity_product5=0;
            $aux_price_product5=0;

            $sqlverOrdersDetails = "SELECT * FROM order_details WHERE created_at BETWEEN FROM_UNIXTIME('$start_date') AND  FROM_UNIXTIME('$end_date')";
            $orders_details = $connect->query($sqlverOrdersDetails);
            if ($orders_details->num_rows > 0) {  // si hay alguna order
                while ($rowOrdersDetails = $orders_details->fetch_assoc()) { // recorre todas las orders 
                      
                    if($rowOrdersDetails['product_id'] == $aux_product1){
                        $aux_price_product1 = $aux_price_product1 + $rowOrdersDetails['price'] * $rowOrdersDetails['quantity'];
                        $aux_quantity_product1 = $aux_quantity_product1 + $rowOrdersDetails['quantity'];
                    }else if($rowOrdersDetails['product_id'] == $aux_product2){
                        $aux_price_product2 = $aux_price_product2 + $rowOrdersDetails['price'] * $rowOrdersDetails['quantity'];
                        $aux_quantity_product2 = $aux_quantity_product2 + $rowOrdersDetails['quantity'];
                    }else if($rowOrdersDetails['product_id'] == $aux_product3){
                        $aux_price_product3 = $aux_price_product3 + $rowOrdersDetails['price'] * $rowOrdersDetails['quantity'];
                        $aux_quantity_product3 = $aux_quantity_product3 + $rowOrdersDetails['quantity'];
                    }else if($rowOrdersDetails['product_id'] == $aux_product4){
                        $aux_price_product4 = $aux_price_product4 + $rowOrdersDetails['price'] * $rowOrdersDetails['quantity'];
                        $aux_quantity_product4 = $aux_quantity_product4 + $rowOrdersDetails['quantity'];
                    }else if($rowOrdersDetails['product_id'] == $aux_product5){
                        $aux_price_product5 = $aux_price_product5 + $rowOrdersDetails['price'] * $rowOrdersDetails['quantity'];
                        $aux_quantity_product5 = $aux_quantity_product5 + $rowOrdersDetails['quantity'];
                    }
                
                    ?>
        <?php

                }
            }
        }
        ?>

    </div>
    <!---- FIN DIV PADRE ---->

    <div>
        PRODUCT 1:
        <?php 
        $sqlVerProdutos = "SELECT * FROM products WHERE id='$aux_product1'";
        $vproductos = $connect -> query($sqlVerProdutos);
        $vp=$vproductos ->fetch_assoc();
        echo $vp['name'];
        ?>
        > Quantity:<?php echo $aux_quantity_product1; ?> > Total: &#163; <?php echo $aux_price_product1; ?>
    </div>
    <div>
        PRODUCT 2:
        <?php 
        $sqlVerProdutos = "SELECT * FROM products WHERE id='$aux_product2'";
        $vproductos = $connect -> query($sqlVerProdutos);
        $vp=$vproductos ->fetch_assoc();
        echo $vp['name'];
        ?>
        > Quantity:<?php echo $aux_quantity_product2; ?> > Total: &#163; <?php echo $aux_price_product2; ?>
    </div>
    <div>
        PRODUCT 3:
        <?php 
        $sqlVerProdutos = "SELECT * FROM products WHERE id='$aux_product3'";
        $vproductos = $connect -> query($sqlVerProdutos);
        $vp=$vproductos ->fetch_assoc();
        echo $vp['name'];
        ?>
        > Quantity:<?php echo $aux_quantity_product3; ?> > Total: &#163; <?php echo $aux_price_product3; ?>
    </div>
    <div>
        PRODUCT 4:
        <?php 
        $sqlVerProdutos = "SELECT * FROM products WHERE id='$aux_product4'";
        $vproductos = $connect -> query($sqlVerProdutos);
        $vp=$vproductos ->fetch_assoc();
        echo $vp['name'];
        ?>
        > Quantity:<?php echo $aux_quantity_product4; ?> > Total: &#163; <?php echo $aux_price_product4; ?>
    </div>
    <div>
        PRODUCT 5:
        <?php 
        $sqlVerProdutos = "SELECT * FROM products WHERE id='$aux_product1'";
        $vproductos = $connect -> query($sqlVerProdutos);
        $vp=$vproductos ->fetch_assoc();
        echo $vp['name'];
        ?>
        > Quantity:<?php echo $aux_quantity_product5; ?> > Total: &#163; <?php echo $aux_price_product5; ?>
    </div>
    <div><b> START DATE:  <?php echo $_GET['start_date']; ?> <br/>
             END DATE:  <?php echo $_GET['end_date']; ?>
        </b></div>



</body>

</html>