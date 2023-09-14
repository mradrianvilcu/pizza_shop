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
        <form action="ver_total_dia.php" method="GET">
            <div class="fila">
                <label for="branch">Branch: </label>
                <select id="branch" name="branch">
                    <option value="upton_park"> Upton Park </option>
                    <option value="beckton"> Beckton </option>

                </select>
            </div>
            <div class="fila">
                <label for="date">Date: </label>
                <input type="date" name="date" id="date" value="<?php echo date("Y-m-d");?>">
            </div>
            <div style="text-align:center;" class="fila">
                <button type="submit" style="background-color:black; color:white;padding:0.5rem;">CHECK TOTAL</button>
            </div>
        </form>
    </div>





    <!------------  VER ORDERS  ----------->
    <div style=" display: flex;
    justify-content: flex-start;
    flex-wrap:wrap;">
     ORDERS:
        <!---- INICIO DIV PADRE ---->
        <?php


        $cantidad_orders = 0;
        $total_orders = 0;
        $total_pizza = 0;
        $total_bucatarie = 0;
        $total_geam = 0;
        $total_justeat = 0;
        $total_deliveroo = 0;
        $aux_branch = $_GET['branch'];
        $sqlverOrders = "SELECT * FROM orders WHERE branch='$aux_branch' AND deleted='0' ORDER BY id ASC";
        $orders = $connect->query($sqlverOrders);


        if ($orders->num_rows > 0) {  // si hay alguna order
            while ($rowOrders = $orders->fetch_assoc()) { // recorre todas las orders 
                // comparacion tiempos
                $datetime1 = $_GET['date'];
                $datetime2 = date("Y-m-d", strtotime($rowOrders['created_at']));
                //echo $datetime1 = strtotime(date($_POST['date']));

                if ($datetime1 == $datetime2) {
                    $cantidad_orders++;
                    $total_orders += $rowOrders['total']; 
                    $total_bucatarie += $rowOrders['total_bucatarie'];
                    $total_pizza += $rowOrders['total_pizza'];


                    if(strpos($rowOrders['postcode'],"GEAM") !== false){
                        $total_geam += $rowOrders['total'];
                    }else if(strpos($rowOrders['postcode'],"JUST") !== false){
                        $total_justeat += $rowOrders['total'];
                    }else if(strpos($rowOrders['postcode'],"DELIVERO") !== false){
                        $total_deliveroo += $rowOrders['total'];
                    }
                    ?>
                 

                    <div style="border-width:1px; border-color:black; border-style:solid; border-radius:5px; margin:1rem; padding:0.5rem; ">
                        <div><b># <?php echo $rowOrders['id']; ?></b></div>
                        <div>Telephone: <?php echo $rowOrders['telephone']; ?></div>
                        <div>Postcode: <?php echo $rowOrders['postcode']; ?></div>
                        <div>Address: <?php echo $rowOrders['address']; ?></div>
                        <div><b>Total: <?php echo $rowOrders['total']; ?></b></div>
                        <div>Comments: <?php echo $rowOrders['comments']; ?></div>
                        <div style="color:white;
    background-color:black;
    margin:1rem;
    text-align: center;
    cursor:pointer;"><a style=" display:block;
    text-decoration:none;
    background-color: black;
    padding:0.5rem;
    color:white;" href="<?php echo "ver_order.php?id_order=" . $rowOrders['id']; ?>">INVOICE</a></div>
                    </div>


                <?php
                }

                ?>



        <?php
            }
        }
        ?>









    </div>
    <!---- FIN DIV PADRE ---->
    
    <div><b> DATE:
   <?php
        if ($_GET["date"]) {
            echo $datoTime = date("d-m-Y", strtotime($_GET['date']));
        } else {
        }


   ?>


    </b></div>
    <div><b>Qty: <?php echo $cantidad_orders; ?></b></div>
    <div>PIZZA: <?php echo $total_pizza; ?></div>
    <div>BUCATARIE: <?php echo $total_bucatarie; ?></div>
    <div>GEAM: <?php echo $total_geam; ?></div>
    <div>JUST EAT: <?php echo $total_justeat; ?></div>
    <div>DELIVEROO: <?php echo $total_deliveroo; ?></div>
    <div><b>TOTAL VANZARE: <?php echo $total_orders; ?></b></div>

       <!-- VER ORDERS BORRADAS -->

       <div style=" display: flex;
    justify-content: flex-start;
    flex-wrap:wrap; margin-top:5rem; ">
     ORDERS (DELETED):
        <!---- INICIO DIV PADRE ---->
        <?php


        $cantidad_orders = 0;
        $total_orders = 0;
        $total_pizza = 0;
        $total_bucatarie = 0;
        $aux_branch = $_GET['branch'];
        $sqlverOrders = "SELECT * FROM orders WHERE branch='$aux_branch' AND deleted='1' ORDER BY id ASC";
        $orders = $connect->query($sqlverOrders);


        if ($orders->num_rows > 0) {  // si hay alguna order
            while ($rowOrders = $orders->fetch_assoc()) { // recorre todas las orders 
                // comparacion tiempos
                $datetime1 = $_GET['date'];
                $datetime2 = date("Y-m-d", strtotime($rowOrders['created_at']));
                //echo $datetime1 = strtotime(date($_POST['date']));

                if ($datetime1 == $datetime2) {
                    $cantidad_orders++;
                    $total_orders += $rowOrders['total']; 
                    $total_bucatarie += $rowOrders['total_bucatarie'];
                    $total_pizza += $rowOrders['total_pizza'];
                   
                    ?>

                    <div style="border-width:1px; border-color:red; border-style:solid; border-radius:5px; margin:1rem; padding:0.5rem; ">
                        <div><b># <?php echo $rowOrders['id']; ?></b></div>
                        <div>Telephone: <?php echo $rowOrders['telephone']; ?></div>
                        <div>Postcode: <?php echo $rowOrders['postcode']; ?></div>
                        <div>Address: <?php echo $rowOrders['address']; ?></div>
                        <div><b>Total: <?php echo $rowOrders['total']; ?></b></div>
                        <div>Comments: <?php echo $rowOrders['comments']; ?></div>
                        <div style="color:white;
    background-color:black;
    margin:1rem;
    text-align: center;
    cursor:pointer;"><a style=" display:block;
    text-decoration:none;
    background-color: red;
    padding:0.5rem;
    color:white;" href="<?php echo "ver_order.php?id_order=" . $rowOrders['id']; ?>">INVOICE</a></div>
                    </div>


                <?php
                }

                ?>



        <?php
            }
        }
        ?>









    </div>
    <!---- FIN DIV PADRE ---->
    
    <div><b> DATE:
   <?php
        if ($_GET["date"]) {
            echo $datoTime = date("d-m-Y", strtotime($_GET['date']));
        } else {
        }


   ?>


    </b></div>
    <div><b>Qty: <?php echo $cantidad_orders; ?></b></div>
    <div>PIZZA: <?php echo $total_pizza; ?></div>
    <div>BUCATARIE: <?php echo $total_bucatarie; ?></div>
    <div><b>TOTAL VANZARE (deleted): <?php echo $total_orders; ?></b></div>



</body>

</html>