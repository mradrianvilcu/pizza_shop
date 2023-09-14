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
        <form action="ver_top_ten.php" method="GET">
            <div class="fila">
                <label for="branch">Branch: </label>
                <select id="branch" name="branch">
                    <option value="upton_park"> Upton Park </option>
                    <option value="beckton"> Beckton </option>

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
                <button type="submit" style="background-color:black; color:white;padding:0.5rem;">CHECK TOP 10</button>
            </div>
        </form>
    </div>





    <!------------  VER ORDERS  ----------->
    <div style=" margin-top:4rem; display: flex; flex-direction:column; align-items:center;">
        <!---- INICIO DIV PADRE ---->
        <?php

$array = array(array());

        if ($_GET['start_date'] && $_GET['end_date']) {
            $aux_branch = $_GET['branch'];
            $start_date = strtotime($_GET['start_date']);

            $end_date = strtotime($_GET['end_date']);
            $sqlverOrders = "SELECT * FROM order_details WHERE created_at BETWEEN FROM_UNIXTIME('$start_date') AND  FROM_UNIXTIME('$end_date');";
            $orders = $connect->query($sqlverOrders);
            if ($orders->num_rows > 0) {  // si hay alguna order
                while ($rowOrders = $orders->fetch_assoc()) { // recorre todas las orders 
                    
                    // array (Product_id,Quantity,Price) [0][0] = producto, [0][1] = quantity, [0][2] = total
                    $aux_bool = false;
                    if (count($array) > 1){


                        for($i=1; $i < count($array); $i++){ // recorremos los productos
                            if($array[$i][0] == $rowOrders["product_id"]){ // ya está en el array
                             
                             $aux_bool = true;
                             $array[$i][1]=$array[$i][1] + $rowOrders["quantity"];
                             $array[$i][2]=$array[$i][2] + ($rowOrders["quantity"] * $rowOrders["price"]);
                             break; // una vez encontrado se debe salir del bucle
     
                            }else{ //no esta en el array
                             $aux_bool = false;
                            }
     
                            
                         }


                         if($aux_bool == false){ // se agrega si no se encuentra en el array
                            array_push($array,array($rowOrders["product_id"],$rowOrders["quantity"],($rowOrders["quantity"] * $rowOrders["price"]))); 
                         }else{
                            
                         }



                    }else{
                        array_push($array,array($rowOrders["product_id"],$rowOrders["quantity"],($rowOrders["quantity"] * $rowOrders["price"])));  
                    }

                    
                }
            }

            //en este punto tenemos ya el array hecho, solo queda reordenarlo
            //print_r($array);

            $arrayOrdenado=array(array());
            $arrayOrdenado2=array(array());
            $arrayOrdenado3=array(array());
            $arrayOrdenado3=$array;


            //lo usamos para buscar la mayor cantidad

            for($k=0 ; $k < 10; $k++){ // sacamos 10 veces el numero mas grande;
                $aux_array = 0;
                for($j=1; $j < count($array); $j++){

                    if($array[$j][1] > $aux_array){
                        $aux_array=$array[$j][1];
                        $aux_index = $j;
                    }
                
                }
                
                array_push($arrayOrdenado,array($array[$aux_index][0], $array[$aux_index][1], $array[$aux_index][2]));
                unset($array[$aux_index]);

            }

            // buscamos el mayor profit


            for($k2=0 ; $k2 < 10; $k2++){ // sacamos 10 veces el numero mas grande;
                $aux_array2 = 0;
                for($j2=1; $j2 < count($arrayOrdenado3); $j2++){

                    if($arrayOrdenado3[$j2][2] > $aux_array2){
                        $aux_array2=$arrayOrdenado3[$j2][2];
                        $aux_index2 = $j2;
                    }
                
                }
                
                array_push($arrayOrdenado2,array($arrayOrdenado3[$aux_index2][0], $arrayOrdenado3[$aux_index2][1], $arrayOrdenado3[$aux_index2][2]));
                unset($arrayOrdenado3[$aux_index2]);

            }
          
            //print_r($arrayOrdenado);
            //print_r($arrayOrdenado2);
         

                    ?>

                    <div style="font-size:2rem; padding:0.5rem;"><b>TOP 10: QUANTITY</b></div>
     
                 <?php

            //leemos el array Ordenado
            //las unidades mas vendidas
            for($m=1; $m <= 10; $m++){
                $aux_nombre_producto = $arrayOrdenado[$m][0];
                $sqlLeer = "SELECT * FROM products WHERE id='$aux_nombre_producto'";
                $leerProducto = $connect -> query($sqlLeer);
                        if($leerProducto -> num_rows > 0){
                              $producto = $leerProducto -> fetch_assoc(); ?>
                              <div> 
                                <?php
                                echo "<b>$m</b>" . ". " .$producto['name'] . " " . " <b>Quantity:</b> " . $arrayOrdenado[$m][1] . " <b>Total:</b> " . "£" .$arrayOrdenado[$m][2];
                                ?>
                            </div>
                                    
                                    <?php
                }
            }

            ?>

               <div style="font-size:2rem; padding:0.5rem; margin-top:1rem;"><b>TOP 10: TOTAL</b></div>

            <?php
            //los mayores profit 
            for($m=1; $m <= 10; $m++){
                $aux_nombre_producto = $arrayOrdenado2[$m][0];
                $sqlLeer = "SELECT * FROM products WHERE id='$aux_nombre_producto'";
                $leerProducto = $connect -> query($sqlLeer);
                        if($leerProducto -> num_rows > 0){
                              $producto = $leerProducto -> fetch_assoc(); ?>
                              <div> 
                                <?php
                                echo "<b>$m</b>" . ". " .$producto['name'] . " " . " <b>Quantity:</b> " . $arrayOrdenado2[$m][1] . " <b>Total:</b> " . "£" .$arrayOrdenado2[$m][2];
                                ?>
                            </div>
                                    
                                    <?php
                }
            }

        }
        ?>

    </div>
    <!---- FIN DIV PADRE ---->

    <div><b> START DATE:  <?php echo $_GET['start_date']; ?> <br/>
             END DATE:  <?php echo $_GET['end_date']; ?>
        </b></div>



</body>

</html>