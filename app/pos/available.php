<html>
<head>
<link href="css/take_order.css" type="text/css" rel="stylesheet" />
<link href="css/form.css" type="text/css" rel="stylesheet" />
<link href="css/links.css" type="text/css" rel="stylesheet" />
<script src="javascript/abrir_ajustes.js"></script>
<script src="javascript/outofstock.js"></script>
</head>
<body onload="ruedaAjustes(),Not_Available()">
    <?php
        include ("../reciclado/session2.php");
        include("reciclado/links.php");
        include("../reciclado/conectar_base_datos.php");
        //include("../reciclado/conectar_base_datos_online.php");
    ?>


<div style="width:100%; min-height:50%;">

<?php 
     $sqlCategorias = "SELECT * FROM categories ORDER BY name";
     $resultadoCategorias = $connect -> query($sqlCategorias);
     if($resultadoCategorias -> num_rows > 0){
        while($rowCategorias = $resultadoCategorias -> fetch_assoc()){  ?> 
          <div style="display:flex; flex-wrap:wrap;">  
            <?php echo "<b style='width:100%; font-size:2rem; text-align:center; background-color:black; color:white;'>" . $rowCategorias['name'] . "</b>"; 
            $aux_cat=$rowCategorias['id'];
            $sqlProductsFromCategorie = "SELECT * FROM products WHERE category_id='$aux_cat'";
            $resultado_p_c = $connect -> query($sqlProductsFromCategorie);
            if($resultado_p_c -> num_rows > 0){
                while($rowProduct = $resultado_p_c -> fetch_assoc()){
                    ?>

                    <div class="product_categorie" id="<?php echo $rowProduct['id']; ?>" style="width: 300px; height: 200px; margin:0.5rem; border-style:solid; border-color:black; border-width:1px; background-image:url('<?php echo $rowProduct['picture']; ?>'); background-size:contain;">
                        <?php echo "<b style='background-color:white;'>" . $rowProduct['name'] . "</b>"; ?>
                        <img id="stamp_<?php echo $rowProduct['id'];?>" src="<?php 
                        if($rowProduct['available'] == 1){
                               echo "img/noStampPizzaMaria.png";
                        }else if($rowProduct['available'] == 0){
                               echo "img/stampPizzaMaria.png";
                        }
                        ?>
                        " style="object-fit:contain; width:100%; height:100%; pointer-events: none;">
                    </div> 

                    <?php
                }
            }
            ?>
          </div>
          
          <?php      
        }
     }
?>

</div>



</body>
</html>