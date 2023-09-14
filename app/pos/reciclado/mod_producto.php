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
    $sqlGetNameProducto = "SELECT * FROM products WHERE id='$id_modificar'";
    $resultadoGetNameProducto = $connect -> query($sqlGetNameProducto);
    if($resultadoGetNameProducto -> num_rows > 0){
        $row=$resultadoGetNameProducto -> fetch_assoc(); 
      
?>

<div style="width:100%; height:50%; display:flex;justify-content:center; align-items:center; ">
<form action="../manipulador/modificar_producto.php?id-mod=<?php echo $id_modificar; ?>" method="POST">
    <div style="margin-bottom:2rem; text-align:center;"><b>MODIFICA PRODUCT</b></div>
    <div class="fila">
        <label for="nombre_Producto">Nume</label>
        <input type="text" name="nombre_Producto" value="<?php echo $row['name']; ?>" id="nombre_Producto">
    </div>
    <div class="fila">
        <label for="precio_Producto">Pret</label>
        <input type="text" name="precio_Producto" value="<?php echo $row['price']; ?>" id="precio_Producto">
    </div>
    <div class="fila">
        <label for="categoria_Producto">Categorie</label>
        <select id="categoria_Producto" name="categoria_Producto">
        <?php
         $sqlCategories="SELECT * from categories";
         $resultados=$connect->query($sqlCategories);

         if($resultados->num_rows > 0){
             while($row2=$resultados->fetch_assoc()){
                 if($row2['id'] == $row['category_id']){
                    echo "<option selected value=" . $row2['id'] . ">" . $row2['name'] . "</option>";
                 }else{
                    echo "<option value=" . $row2['id'] . ">" . $row2['name'] . "</option>";
                 }
                
             }
         }

         ?>
        
    </select>
    </div>
    <div class="fila">
        <label for="is_pizza">Productul este pizza ? </label>
        <select id="is_pizza" name="is_pizza">
        <?php 
         if($row['is_pizza'] == 0){ //no es pizza el producto
         ?>
        <option value=0 selected> Nu </option>
        <option value=1> Da </option>
         <?php
         }else{  // es pizza el producto
         ?>
        <option value=0> Nu </option>
        <option value=1 selected> Da </option>
         <?php
         } 
        ?>
      
        
    </select>
    </div>
    <div class="fila">
        <label for="is_website">Vizibil Website ? </label>
        <select id="is_website" name="is_website">
        <?php 
         if($row['website'] == 0){ //no se vende en la website
         ?>
        <option value=0 selected> Nu </option>
        <option value=1> Da </option>
         <?php
         }else{  // se vende en la website
         ?>
        <option value=0> Nu </option>
        <option value=1 selected> Da </option>
         <?php
         } 
        ?>
      
        
    </select>
    </div>
    <div style="text-align:center;" class="fila">
        <button type="submit" name="login">Modificar</button>
    </div>
</form>

</div>


        <?php
        
    }
    ?>



    </body>
</html>