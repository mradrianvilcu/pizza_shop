<html>
<head>
    <?php
       include("../reciclado/connect_database.php");
        $categorie_id = $_GET['categorie_id'];
        if($categorie_id == 19){
            header("location:/");
        }
        $sqlDatos="SELECT * from categories WHERE id='$categorie_id'";
        $resultadosDatos=$connect->query($sqlDatos);
        if($resultadosDatos->num_rows>0){
           $rowCategorie=$resultadosDatos->fetch_assoc(); //sacamos los detalles de la categoria desde la db
        }
    ?>
    <title>Pizza Maria | <?php echo $rowCategorie['name']; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/cssGeneral.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="stylesheet" href="css/header.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="stylesheet" href="css/footer.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="icon" href="../img/favicon.gif" type="image/gif" sizes="16x16">
<script src="js/jquery.js<?php include("reciclado/reset_cache.php") ?>"></script>
<script src="js/jsGeneral.js<?php include("reciclado/reset_cache.php") ?>"></script> 
<script src="js/jsFotosMobile.js<?php include("reciclado/reset_cache.php") ?>"></script>
<script src="js/comprar.js<?php include("reciclado/reset_cache.php") ?>"></script>


</head>

<body onload="asdf(),comprar(),numeroCart(),desplegarMenu()">

<?php include("reciclado/header.php") ?>


     <!-- detalles/menu -->
<div class="primerlevel detalles" style="min-height:70%;" id="idDetalles">

<?php
$sqlProductos="SELECT * from products WHERE category_id='$categorie_id' && website='1' ORDER BY id ASC";
$resultados=$connect->query($sqlProductos);
if($resultados->num_rows>0){
    while($row=$resultados->fetch_assoc()){

?>

<div class="noIndexDetalles">
                
            <picture>
            <source media="(max-width:500px)" srcset="
            <?php
            ;
            echo $row['picture'];
            ?>
            ">
            <img style="width:250px; margin-bottom:1rem;" src="<?php echo $row['picture']; ?>" alt="<?php echo $row['name']; ?>"/>
            </picture>

            <?php 
             if($row['description'] != "DESCRIPTION"){
                echo "<b>" . $row['name'] . "</b><br/>" . $row['description'] . "<br/>"; 
             }else{
                echo "<b>" . $row['name'] . "</b><br/>";
             } ?>
             
            
             <b style="margin:0.5rem;">£<?php echo $row['price']; ?></b>

            <?php 
           
            $aux_id_compra = $row['id'];

            $sql = "SELECT * FROM menu WHERE product_id='$aux_id_compra'";
            $busquedaId=$connect -> query($sql);
            if($busquedaId->num_rows>0){
                $menu=$busquedaId->fetch_assoc();
                
                $id_compra = $row['id'] . "?" . $menu["category_id1"] . "?" . $menu["category_id2"] . "?" . $menu["category_id3"] . "?" . $menu["category_id4"] . "?" . $menu["category_id5"] . "?" . $menu["category_id6"] . "?" . $row['price']; ?>
                <div class="btnMenu" id="<?php echo $id_compra; ?>"><b style="pointer-events:none;"><?php echo $row['name']; ?></b></div>
                <div class="cortinaMenu" id="<?php echo "menu" . $id_compra; ?>" > 
                <p class ="closeCM" id="<?php echo "closeCortinaMenu" . $id_compra; ?>">×</p>
                <div>
                    <?php 
                     $arrayCategoriasMenu = explode("?",$id_compra);
                     for($rec=1; $rec < 7; $rec++){
                        if($arrayCategoriasMenu[$rec] > 0){ ?>
                    
                         <div>
                           <label><?php
                            $aux_id_categorie =  $arrayCategoriasMenu[$rec];
                            $sqlSacarNombreCategoria = "SELECT * FROM categories WHERE id='$aux_id_categorie'";
                            $resultadoNameCategorie = $connect -> query($sqlSacarNombreCategoria);
                            if($resultadoNameCategorie -> num_rows > 0){
                                $cat = $resultadoNameCategorie -> fetch_assoc();
                                echo $cat['name'] . ":" . "<br/>";
                            }
                            ?> 
                           </label>
                           <select class=<?php echo "selected" . $id_compra; ?>>
                              <?php
                              $sqlRecorrerCategoria = "SELECT * FROM products WHERE category_id='$aux_id_categorie' && belong_menu='1'";
                              $resultadosProCat = $connect -> query($sqlRecorrerCategoria);
                              if($resultadosProCat -> num_rows > 0){
                                while($rowProCat = $resultadosProCat -> fetch_assoc()){ 
                                    if($rowProCat['available']==1){ ?>

                                    <option value=<?php echo $rowProCat['id'] ?>><?php 
                                    echo $rowProCat['name'];
                                    ?></option>

                                 <?php                                    
                                 }else{}

                                    ?>
                                    
                              <?php
                                }
                              }
                              ?>
                           </select>
                         </div>
                         
                        <?php
                        }else{}
                     }
                    ?>
                <div class="contenedorBuy">
                <div id=<?php echo "buy" . $id_compra; ?> class="btnBuyMenu">
                            BUY
                </div></div>
                </div>
                </div>
                <?php

            }else{
                $id_compra = $row['id'] . "?0?0?0?0?0?0?" . $row['price']; ?>
                <div style="<?php 
                  if($row['available']==1){
                    
                }else{
                    echo "pointer-events:none";
                }
                ?>" class="btnComprar" id="<?php echo $id_compra; ?>"><?php 
                if($row['available']==1){
                    echo "Adaugă"; 
                }else{
                    echo "(NU ESTE DISPONIBIL)"; 
                }
                
                ?></b></div>
                <?php
            }

            ?>

            
             
            
        </div>

        <?php 
    }
    }

        ?>
    
</div>


            
                
           <?php include("reciclado/link_basket.php"); ?>
           <?php include("reciclado/footer.php"); ?>
</body>
</html>