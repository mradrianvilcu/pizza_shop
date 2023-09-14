<html>
    <head>
    <link href="../css/take_order.css" type="text/css" rel="stylesheet" />
<link href="../css/form.css" type="text/css" rel="stylesheet" />
<link href="../css/links.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
    <?php
    include ("../../reciclado/session.php");
    include("links2.php");
    include("../../reciclado/conectar_base_datos.php");
    $id_modificar=$_GET['id-producto'];
    $sqlGetNameProducto = "SELECT * FROM charge WHERE id='$id_modificar'";
    $resultadoGetNameProducto = $connect -> query($sqlGetNameProducto);
    if($resultadoGetNameProducto -> num_rows > 0){
        $row=$resultadoGetNameProducto -> fetch_assoc(); 
      
?>

<div style="width:100%; height:50%; display:flex;justify-content:center; align-items:center; ">
<form action="../manipulador/modificar_charge.php?id-mod=<?php echo $id_modificar; ?>" method="POST">
    <div style="margin-bottom:2rem; text-align:center;"><b>MODIFICA CHARGE</b></div>
    <div class="fila">
        <label for="postcode">Postcode:</label>
         <b><?php echo $row['postcode'];?> </b>
    </div>
    <div class="fila">
        <label for="charge">Charge: intre 1 si 5</label>
        <input type="text" name="charge" value="<?php echo $row['charge']; ?>" id="charge">
    </div>
    <div style="text-align:center;" class="fila">
        <button type="submit" name="login">Modifica</button>
    </div>
</form>

</div>


        <?php
        
    }
    ?>



    </body>
</html>