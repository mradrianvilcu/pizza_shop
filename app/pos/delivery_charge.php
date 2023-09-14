<html>
    <head>
    <link href="css/take_order.css" type="text/css" rel="stylesheet" />
<link href="css/form.css" type="text/css" rel="stylesheet" />
<link href="css/links.css" type="text/css" rel="stylesheet" />
<script src="javascript/abrir_ajustes.js"></script>
    </head>
    <body onload="ruedaAjustes()">
    <?php
        include ("../reciclado/session2.php");
        include("reciclado/links.php");
        include("../reciclado/conectar_base_datos.php");
    ?>


   <div style="margin:2rem; text-align:center;"><b>MODIFICA CHARGE</b></div>
   <div style="display:flex; flex-direction:column; align-items:center;">
<?php
        $sqlAbrirCharge = "SELECT * FROM charge ORDER BY postcode ASC";
        $resultadoCharge= $connect -> query($sqlAbrirCharge);
        if($resultadoCharge -> num_rows > 0){
            while($row=$resultadoCharge->fetch_assoc()){
                 ?>

                 <!----------- mesas/div con las categorias --------->
                <div id=<?php echo $row['id']; ?> style="
                border-style:solid;
                border-color:black;
                border-width:1px;
                width:auto;
                min-width:500px;
                margin:0.2rem;
                display:flex;
                justify-content:space-evenly;
                padding:0.5rem;
                
                ">
                   <p><?php echo $row['postcode']; ?></p> 
                   <p>£<?php echo $row['charge']; ?></p> 
                   <a style="background-color:blue;
                   color:white;
                   text-decoration:none;
                   padding:0.2rem;
                   " href="reciclado/mod_charge.php?id-producto=<?php echo $row['id'];?>">UPDATE</a>
                </div>

                <?php
            }
        }
       ?>
</div>


    </body>