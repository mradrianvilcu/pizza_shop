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
<form action="manipulador/crear_producto.php" method="POST">
    <div style="margin-bottom:2rem; text-align:center;"><b>CREEAZA PRODUCT</b></div>
    <div class="fila">
        <label for="nombre_Producto">Nume</label>
        <input type="text" name="nombre_Producto" id="nombre_Producto">
    </div>
    <div class="fila">
        <label for="precio_Producto">Pret</label>
        <input type="text" name="precio_Producto" id="precio_Producto">
    </div>
    <div class="fila">
        <label for="categoria_Producto">Categorie</label>
        <select id="categoria_Producto" name="categoria_Producto">
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
        <label for="is_pizza">Productul este pizza ? </label>
        <select id="is_pizza" name="is_pizza">
        <option value=0 selected> Nu </option>
        <option value=1> Da </option>
    </select>
    </div>
    <div class="fila">
        <label for="is_website">Vizibil Website ? </label>
        <select id="is_website" name="is_website">
        <option value=0> Nu </option>
        <option value=1 selected> Da </option>
    </select>
    </div>
    <div style="text-align:center; margin-top:1rem;" class="fila">
        <button type="submit" name="login">Creeaza</button>
    </div>
</form>

</div>


<div style="margin:3rem; text-align:center;"><b>MODIFICA PRODUCT</b></div>
<div style="display:flex; flex-direction:column; align-items:center;">
<?php
        $sqlAbrirCategorias = "SELECT * FROM products ORDER BY name";
        $resultadoCategorias= $connect -> query($sqlAbrirCategorias);
        if($resultadoCategorias -> num_rows > 0){
            while($row=$resultadoCategorias->fetch_assoc()){
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
                <a style="background-color:red;
                   color:white;
                   text-decoration:none;
                   padding:0.2rem;
                   " href="manipulador/borrar_pro.php?id-producto=<?php echo $row['id'];?>">DELETE</a>
                   <p><?php echo $row['name']; ?></p> 
                   <p>£<?php echo $row['price']; ?></p> 
                   <a style="background-color:blue;
                   color:white;
                   text-decoration:none;
                   padding:0.2rem;
                   " href="reciclado/mod_producto.php?id-producto=<?php echo $row['id'];?>">UPDATE</a>
                </div>

                <?php
            }
        }
       ?>
</div>




</body>
</html>