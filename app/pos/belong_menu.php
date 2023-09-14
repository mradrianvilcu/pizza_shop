<html>
    <head>
    <link href="css/take_order.css" type="text/css" rel="stylesheet" />
    <link href="css/links.css" type="text/css" rel="stylesheet" />
<link href="css/form.css" type="text/css" rel="stylesheet" />
<script src="javascript/abrir_ajustes.js"></script>
    </head>
    <body onload="ruedaAjustes()">
    <?php
     include ("../reciclado/session2.php");
    include("reciclado/links.php");
    include("../reciclado/conectar_base_datos.php");?>


    <div style="width:100%; height:50%; display:flex;justify-content:center; align-items:center; ">
<form action="manipulador/belong_to_menu.php" method="POST">
    <div style="margin-bottom:2rem; text-align:center;"><b>PRODUCT VIZIBIL IN MENU?</b></div>
    <div class="fila">
        <label for="belong_to_m">Product</label>
        <select id="belong_to_m" name="belong_to_m">
        <?php
         $sqlCategories="SELECT * from products ORDER BY name ASC";
         $resultados=$connect->query($sqlCategories);

         if($resultados->num_rows > 0){
             while($row=$resultados->fetch_assoc()){
                 echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
             }
         }

         ?>
        
    </select>
    </div>
    <div class="fila">
        <label for="view">Vizibil ? </label>
        <select id="view" name="view">
        <option value=0> Nu </option>
        <option value=1 selected> Da </option>
        
    </select>
    </div>
    <div style="text-align:center;" class="fila">
        <button type="submit" name="login">Schimba</button>
    </div>
</form>
</div>


    </body>
</html>