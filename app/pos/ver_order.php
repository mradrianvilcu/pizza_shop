<html>
    <head>
    <script src="javascript/imprimir.js"></script>
    <link href="css/imprimir.css" type="text/css" rel="stylesheet" />
    <link href="css/links.css" type="text/css" rel="stylesheet" />
    <script src="javascript/abrir_ajustes.js"></script>
    </head>
    <body onload="ruedaAjustes(), imprimir() ">


    <?php

include ("../reciclado/session2.php");
include("reciclado/links.php");
include("../reciclado/conectar_base_datos.php");



?>

<form  style="text-align:center; margin:2rem;"action="ver_order.php" method="POST">
    <div style="margin-bottom:2rem; text-align:center;"><b>CHECK FOR AN ORDER</b></div>
    <div class="fila">
        <label for="id_order">#ID Order</label>
        <input type="text" name="id_order" id="id_order">
    </div>
  
    <div style="text-align:center; margin:2rem;" class="fila">
        <button style="padding:0.5rem; color:white; background-color:black; " type="submit" name="login">SEARCH</button>
    </div>
</form>


<?php if(isset($_POST['id_order']) || (isset($_GET['id_order']))){ 
   
    if(isset($_POST['id_order'])){
        $id_order = $_POST['id_order'];
    }else{
        $id_order = $_GET['id_order'];
    }
//  GET PERS_ID

$sqlPersId="SELECT * FROM orders WHERE id='$id_order'";
$resultadoPersId= $connect-> query($sqlPersId);
if($resultadoPersId -> num_rows > 0){
    $rowPersId = $resultadoPersId -> fetch_assoc();
    $pers_id = $rowPersId['pers_id'];
    echo  $pers_id;
}else{ ?>
   <div style="text-align:center;"><b><?php echo "ORDER #" . $id_order . " DOESN'T EXIST."; ?> </b></div> 
<?php }

    ?>

   
        <?php
        $sqlOrderConcreta = "SELECT * FROM orders WHERE pers_id='$pers_id'";
        $orderConcreta = $connect->query($sqlOrderConcreta);
        if ($orderConcreta->num_rows > 0) {
            $rowOrderConcreta = $orderConcreta->fetch_assoc(); ?>
             <div style="width:100%; height:auto; display:flex; flex-direction:column; justify-content:center; align-items:center;">
    <div id="invoice" style="  border: 1px solid; padding:1rem;">

            <div style="margin-top:1rem;text-align:center;"><img style="width:150px;" src="img/logo.png"></div>
            <div style="margin-bottom:1rem;text-align:center;"><b># <?php echo $id_order; ?> </b></div>
            <div style="margin-bottom:1rem;"><b><?php echo date("d/m/Y H:i",strtotime($rowOrderConcreta['created_at'])); ?></b></div>
            <div class="linea">-------------------------------------------------------</div>
            <div style="margin-top:0.5rem;text-align:left">Telephone: <?php echo $rowOrderConcreta['telephone']; ?></div>
            <div style="text-align:left">Postcode: <?php echo $rowOrderConcreta['postcode']; ?></div>
            <div style="text-align:left">Address: <?php echo $rowOrderConcreta['address']; ?></div>
            <div style="margin-bottom:0.5rem;text-align:left">Comments: <?php echo $rowOrderConcreta['comments']; ?> </div>
            <div class="linea">-------------------------------------------------------</div>
            <!-- tabla compra -->
            <div>
                <table style="width:100%;margin-top:0.5rem;margin-bottom:0.5rem; ">
                    <tr style="display:flex; justify-content:space-between; width:100%; border-bottom-width:1px; border-bottom-style:solid; border-color:black; ">
                        <th style="width:60%; text-align:left">Product</th>
                        <th style="width:20%; text-align:right">Qty</th>
                        <th style="width:20%; text-align:right">Price</th>
                    </tr>

                    <?php
                    $sqlOrderDetails = "SELECT * FROM order_details WHERE order_id='$pers_id'";
                    $orderDetails = $connect->query($sqlOrderDetails);
                    if ($orderDetails->num_rows > 0) {
                        while ($rowOrderDetails = $orderDetails->fetch_assoc()) { ?>





                            <tr style="display:flex; justify-content:space-between; width:100%;border-bottom-width:1px; border-bottom-style:solid; border-color:black;">
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
                                                                            for ($c = 1; $c < 6; $c++) {
                                                                                if ($rowOrderDetails['pro_id' . $c] != "0") { ?>
                                                    <li><?php
                                                                                    $aux_id_p = $rowOrderDetails['pro_id' . $c];
                                                                                    $sqlNameP = "SELECT * FROM products WHERE id='$aux_id_p'";
                                                                                    $nameP = $connect->query($sqlNameP);
                                                                                    if ($nameP->num_rows > 0) {
                                                                                        $resN = $nameP->fetch_assoc();

                                                                                        echo "+ " . $resN['name'];
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
                


                </table>
            </div>
            <div class="linea">-------------------------------------------------------</div>
            <div style="margin-top:0.5rem;margin-bottom:0.5rem; text-align:right"><b>TOTAL: <?php echo $rowOrderConcreta['total']; ?></b></div>
            <div class="linea">-------------------------------------------------------</div>
            <div style="margin-top:1rem;margin-bottom:2rem; text-align:center;">www.pizzamaria.uk</div>
           

        <?php
        }

        ?>
    </div>
    <div id="btnImprimir" style="background-color:black; color:white; padding:0.5rem; margin:1rem; cursor:pointer;">PRINT</div>
   
   <?php  }
                    ?>

</div>


<?php
}else{

}
?>






    </body>
</html>

