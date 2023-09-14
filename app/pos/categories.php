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
<form action="manipulador/crear_categoria.php" method="POST">
    <div style="margin-bottom:2rem; text-align:center;"><b>CREEAZA CATEGORIE</b></div>
    <div class="fila">
        <label for="nombre_Categoria">Nume categorie</label>
        <input type="text" name="nombre_Categoria" id="nombre_Categoria">
    </div>
    <div style="text-align:center;" class="fila">
        <button type="submit" name="login">Creeaza</button>
    </div>
</form>
</div>

<div style="margin-bottom:2rem; text-align:center;"><b>MODIFICA CATEGORIE</b></div>
<div style="display:flex; flex-direction:column; align-items:center;">
<?php
        $sqlAbrirCategorias = "SELECT * FROM categories ORDER BY name";
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
                   " href="manipulador/borrar_categoria.php?id-categoria=<?php echo $row['id'];?>">DELETE</a>
                   <p><?php echo $row['name']; ?></p> 
                   <a style="background-color:blue;
                   color:white;
                   text-decoration:none;
                   padding:0.2rem;
                   " href="reciclado/mod_categoria.php?id-categoria=<?php echo $row['id'];?>">UPDATE</a>
                </div>

                <?php
            }
        }
       ?>
</div>



</body>
</html>