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

<div style="width:100%; height:50%; display:flex;justify-content:center; align-items:center; ">
<form action="manipulador/crear_menu.php" method="POST">
    <div style="margin-bottom:2rem; text-align:center;"><b>CREEAZA MENU</b></div>
    <div class="fila">
        <label for="producto_a_modificar">Product</label>
        <select id="producto_a_modificar" name="producto_a_modificar">
        <?php
         $sqlCategories="SELECT * from products WHERE menu='1'";
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
        <label for="row1">Option 1</label>
        <select id="row1" name="row1">
        <option value=NULL> select option </option>
        <?php
         $sqlCategories="SELECT * from categories";
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
        <label for="row2">Option 2</label>
        <select id="row2" name="row2">
        <option value=NULL> select option </option>
        <?php
         $sqlCategories="SELECT * from categories";
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
        <label for="row3">Option 3</label>
        <select id="row3" name="row3">
        <option value=NULL> select option </option>
        <?php
         $sqlCategories="SELECT * from categories";
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
        <label for="row4">Option 4</label>
        <select id="row4" name="row4">
        <option value=NULL> select option </option>
        <?php
         $sqlCategories="SELECT * from categories";
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
        <label for="row5">Option 5</label>
        <select id="row5" name="row5">
        <option value=NULL> select option </option>
        <?php
         $sqlCategories="SELECT * from categories";
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
        <label for="row6">Option 6</label>
        <select id="row6" name="row6">
        <option value=NULL> select option </option>
        <?php
         $sqlCategories="SELECT * from categories";
         $resultados=$connect->query($sqlCategories);

         if($resultados->num_rows > 0){
             while($row=$resultados->fetch_assoc()){
                 echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
             }
         }

         ?>
        
    </select>
    </div>
    <div style="text-align:center;" class="fila">
        <button type="submit" name="login">Schimba</button>
    </div>
</form>
</div>



    </body>
</html>