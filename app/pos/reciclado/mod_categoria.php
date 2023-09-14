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
    $id_modificar=$_GET['id-categoria'];
    $sqlGetNameCategoria = "SELECT * FROM categories WHERE id='$id_modificar'";
    $resultadoGetNameCategoria = $connect -> query($sqlGetNameCategoria);
    if($resultadoGetNameCategoria -> num_rows > 0){
        $row=$resultadoGetNameCategoria -> fetch_assoc(); ?>

<div style="width:100%; height:50%; display:flex;justify-content:center; align-items:center; ">
<form action="../manipulador/modificar_categoria.php?id-mod=<?php echo $id_modificar ?>" method="POST">
    <div style="margin-bottom:2rem; text-align:center;"><b>MODIFICAR CATEGORIA</b></div>
    <div class="fila">
        <label for="nombre_Categoria">Nombre de categoria</label>
        <input type="text" name="nombre_Categoria" value="<?php echo $row['name']; ?>" id="nombre_Categoria">
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