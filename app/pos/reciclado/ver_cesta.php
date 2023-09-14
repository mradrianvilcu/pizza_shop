<?php

include("../../reciclado/session.php"); 
include("../../reciclado/conectar_base_datos.php");


if(empty($_SESSION['username_Session'])){    
    $user_conectado = $_COOKIE['username_Cookie'];
}else{
    $user_conectado = $_SESSION['username_Session'];
}

//echo $user_conectado;

$sqlActualizarCesta = "SELECT * FROM cesta WHERE user_id='$user_conectado'";
$ActualizarCesta = $connect -> query ($sqlActualizarCesta);

if($ActualizarCesta -> num_rows > 0){ ?>

    <table id="listaTabla">
    <tr>
                        <th>PROD</th>
                        <th>QTY</th>
                        <th>PRICE</th>
                        <th>
                        <th>
                    </tr>

    <?php 
    while( $productoCesta = $ActualizarCesta-> fetch_assoc()){
    
        if($productoCesta['pro_id1'] == "0"){ // para productos normales ?>
       
       <tr id="<?php echo "filalista" . "?" . $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" class="row<?php echo $productoCesta['pro_id1'];?>" >
                                    <!------ NOMBRE DEL PRODUCTO -------->
                                    <td id="<?php echo "name" . "?" . $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" class="row<?php echo $value['item_pro_id1'];?>" >
                                     
                                    <?php
                                         // sacamos nombre usando el id
                                        $auxNombre = $productoCesta['product_id']; 
                                        $sqlAveriguarNombre = "SELECT * FROM products WHERE id='$auxNombre'";
                                        $resultadoNombre = $connect->query($sqlAveriguarNombre);
                                        $resNombre = $resultadoNombre -> fetch_assoc();

                                        echo $resNombre['name'];
                                        
                                        ?>

                                    </td>
                                    <td id="<?php echo "quantity" . "?" . $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" > <?php echo $productoCesta['quantity']; ?></td>
                                    <td id="<?php echo "price" . "?" . $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" class="row<?php echo $value['item_pro_id1'];?>" ><?php echo $productoCesta['price']; ?></td>
                                    <td>
                                        <p class="btnDelete" onclick="borrarElementoLista(this)" id="<?php echo "delete" . "?" .  $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" class="row<?php echo $value['item_pro_id1'];?>" >DEL</p>
                                    </td>
                                </tr>

       <?php
        }else{ //para productos que son menu  ?>


<tr id="<?php echo "filalista" . "?" . $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" class="row<?php echo $value['item_pro_id1'];?>" >
                                    <!------ NOMBRE DEL MENU -------->
    
                                    <td id="<?php echo "name" . "?". $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" class="row<?php echo $value['item_pro_id1'];?>" >
                                     
                                       <?php
                                         // sacamos nombre usando el id
                                        $auxNombre = $productoCesta['product_id']; 
                                        $sqlAveriguarNombre = "SELECT * FROM products WHERE id='$auxNombre'";
                                        $resultadoNombre = $connect->query($sqlAveriguarNombre);
                                        $resNombre = $resultadoNombre -> fetch_assoc();

                                        echo $resNombre['name'];
                                        
                                        ?>
                                        

                                        <ul>
                                            <?php
                                            for ($i = 1; $i <= 6; $i++) {
                                                if ($productoCesta['pro_id' . $i] != "0") {
                                                    $auxProductoMenu = $productoCesta['pro_id' . $i];
                                                    $sqlAveriguarProductoMenu = "SELECT * FROM products WHERE id='$auxProductoMenu'";
                                                    $resultadoProductoMenu = $connect->query($sqlAveriguarProductoMenu);
                                                    if ($resultadoProductoMenu->num_rows > 0) {
                                                        $rowProductoMenu = $resultadoProductoMenu->fetch_assoc();
                                                        
                                                        if($rowProductoMenu['name'] != "0"){ ?>
                                                               
                                                               <li> +
                                                        <?php echo $rowProductoMenu['name']; ?>
                                                              </li>

                                                       <?php }else{

                                                        }
                                                    }
                                                    ?>
                                                               
                                                   

                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>



                                    </td>
                                    <td id="<?php echo "quantity" . "?" . $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" > <?php echo $productoCesta['quantity']; ?></td>
                                    <td id="<?php echo "price" . "?" . $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" class="row<?php echo $value['item_pro_id1'];?>" ><?php echo $productoCesta['price']; ?></td>
                                    <td>
                                        <p class="btnDelete" onclick="borrarElementoLista(this)" id="<?php echo "delete" . "?" . $productoCesta['product_id'] . "?" . $productoCesta['pro_id1'] . "?" . $productoCesta['pro_id2'] . "?" . $productoCesta['pro_id3'] . "?" . $productoCesta['pro_id4'] . "?" . $productoCesta['pro_id5'] . "?" . $productoCesta['pro_id6'];?>" class="row<?php echo $value['item_pro_id1'];?>" >DEL</p>
                                    </td>
                                </tr>

 <?php

        }

    
    }

    ?>

    </table>

    <?php

}else{ // no hay nada en la cesta;

}

?>