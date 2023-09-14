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
        <form action="ver_total_interval.php" method="GET">
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
                <button type="submit" style="background-color:black; color:white;padding:0.5rem;">CHECK TOTAL</button>
            </div>
        </form>
    </div>





    <!------------  VER ORDERS  ----------->
    <div style=" margin-top:4rem; display: flex; flex-direction:column; align-items:center;">
        <b>ORDERS:</b>
        <!---- INICIO DIV PADRE ---->
        <?php


        $cantidad_orders = 0;
        $total_orders = 0;
        $total_bucatarie = 0;
        $total_pizza = 0;

        if ($_GET['start_date'] && $_GET['end_date']) {
            $aux_branch = $_GET['branch'];
            $start_date = strtotime($_GET['start_date']);

            $end_date = strtotime($_GET['end_date']);
            $sqlverOrders = "SELECT * FROM orders WHERE created_at BETWEEN FROM_UNIXTIME('$start_date') AND  FROM_UNIXTIME('$end_date') AND branch='$aux_branch' AND deleted='0';";
            $orders = $connect->query($sqlverOrders);
            if ($orders->num_rows > 0) {  // si hay alguna order
                while ($rowOrders = $orders->fetch_assoc()) { // recorre todas las orders 
                    $cantidad_orders++;
                    $total_orders += $rowOrders['total']; 
                    $total_bucatarie += $rowOrders['total_bucatarie'];
                    $total_pizza += $rowOrders['total_pizza'];
                    ?>

                    <div style="margin:0.5rem;">
                        <b># <?php echo $rowOrders['id']; ?></b>
                        <b>Telephone:</b> <?php echo $rowOrders['telephone']; ?>
                        <b>Postcode:</b> <?php echo $rowOrders['postcode']; ?>
                        <b>Address:</b> <?php echo $rowOrders['address']; ?>
                        <b>Total:</b> <?php echo $rowOrders['total']; ?>
                        <b>Comments:</b> <?php echo $rowOrders['comments']; ?>
                        <b>Date:</b> <?php echo $rowOrders['created_at']; ?>
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
    <div><b>Qty: <?php echo $cantidad_orders; ?></b></div>
    <div>PIZZA: <?php echo $total_pizza; ?></div>
    <div>BUCATARIE: <?php echo $total_bucatarie; ?></div>
    <div><b>TOTAL VENTA: <?php echo $total_orders; ?></b></div>



</body>

</html>