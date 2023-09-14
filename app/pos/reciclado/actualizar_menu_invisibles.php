

<?php
 include("../../reciclado/conectar_base_datos.php");
        
    $auxProductosDe = $_POST['productosde'];
    $sqlAbrirProductos = "SELECT * FROM products WHERE category_id='$auxProductosDe' ORDER BY name";
    $resultadoProductos = $connect->query($sqlAbrirProductos);
    if ($resultadoProductos->num_rows > 0) {
        while ($row2 = $resultadoProductos->fetch_assoc()) {
            if($row2['menu'] == 0){
                ?>

            <!----------- mesas/div con los productos --------->
            <a class="linkProducto" id="<?php echo $row2['id'] ?>">
                <?php echo $row2['name']; ?>
            </a>

<?php

            }else{
?>
            <a class="linkMenu" id="<?php echo $row2['id'] ?>">
                <?php echo $row2['name']; ?>
            </a>

<?php
            }

        }
    }




?>
