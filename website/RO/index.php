<html>
<head>
    <title>Pizza Maria | HOME</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pizza, gratare, mancaruri traditionale, supe/ciorbe, deserturi si painici proaspete.">
<link rel="stylesheet" href="css/cssGeneral.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="stylesheet" href="css/header.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="stylesheet" href="css/footer.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="stylesheet" href="css/index.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="icon" href="../img/favicon.gif" type="image/gif" sizes="16x16">
<script src="js/jquery.js<?php include("reciclado/reset_cache.php") ?>"></script>
<script src="js/jsGeneral.js<?php include("reciclado/reset_cache.php") ?>"></script>
<script src="js/comprar.js<?php include("reciclado/reset_cache.php") ?>"></script>
</head>

<body onload="asdf(),numeroCart()">

  <?php include("reciclado/header.php") ?>


     <!-- detalles/menu -->
<div class="primerlevel detalles" id="idDetalles">

        <div class="indexDetalles">
            <div id="ofertacasei">
            <div id="oferta1">
                <?php
                include("../reciclado/connect_database.php");
                $sqloferta1="SELECT * FROM products WHERE name='Oferta 1'";
                $resultado_oferta1 = $connect->query($sqloferta1);
                if($resultado_oferta1 -> num_rows > 0){
                    $oferta1=$resultado_oferta1->fetch_assoc(); ?>
                  <p><?php echo "£" . $oferta1['price'];?></p>  
                  <?php 
                  }

                ?>
                
            </div>
            <div id="oferta2">
            <?php
                include("reciclado/connect_database.php");
                $sqloferta1="SELECT * FROM products WHERE name='Oferta 2'";
                $resultado_oferta1 = $connect->query($sqloferta1);
                if($resultado_oferta1 -> num_rows > 0){
                    $oferta1=$resultado_oferta1->fetch_assoc(); ?>
                  <p><?php echo "£" . $oferta1['price'];?></p>  
                  <?php 
                  }

                ?>
            </div>
            <div id="oferta3">
            <?php
                include("reciclado/connect_database.php");
                $sqloferta1="SELECT * FROM products WHERE name='Oferta 3'";
                $resultado_oferta1 = $connect->query($sqloferta1);
                if($resultado_oferta1 -> num_rows > 0){
                    $oferta1=$resultado_oferta1->fetch_assoc(); ?>
                  <p><?php echo "£" . $oferta1['price'];?></p>  
                  <?php 
                  }

                ?>
            </div>
            <div id="oferta4">
            <?php
                include("reciclado/connect_database.php");
                $sqloferta1="SELECT * FROM products WHERE name='Oferta 4'";
                $resultado_oferta1 = $connect->query($sqloferta1);
                if($resultado_oferta1 -> num_rows > 0){
                    $oferta1=$resultado_oferta1->fetch_assoc(); ?>
                  <p><?php echo "£" . $oferta1['price'];?></p>  
                  <?php 
                  }

                ?>
            </div>
            </div>
        </div>
        <div class="indexDetalles">
        
            <p><b>Program livrare</b></p>
            <p>Luni: 17:00 - 22:00<br/>
            <p>Marti: closed<br/>
            <p>Miercuri: 17:00 - 22:00<br/>
            <p>Joi: 17:00 - 22:00<br/>
            <p>Vineri: 17:00 - 22:00<br/>
            <p>Sambata: 12:00 - 22:00<br/>
            <p>Duminica: 12:00 - 22:00<br/>
            <br/>
            <b>Timp de livrare? </b> <br/><br/>30min / 75min
            <br/><br/>
            <b>Telefon</b><br/><br/>
            --<br/><br/>
    073 9232 5383 <br/><br/>
    Whatsapp: 077 9961 5914<br/><br/>
            
            </p>
        </div>
        <div class="indexDetalles"> 
            
            <p><b>Harta livrare (+ charge distanta):</b></p>
            <p>Fiecare livrare va costa £2.Depinde de distanta se  va adauga £1-3 fiind in total un maxim de £5 pe livrare posibil.
                Pentru mai multa informatie priviti harta cu zonele unde facem livrari cu respectivul lor charge.
            </p>
            <br/>
            <img src="" alt="delivery map" class="chargemap">
        </div>

   

    
</div>

<!-- fotos pizza 18 / 12 -->

<div id="twoandhalf">
            <div id="ofertapizza">
            <img src="../img/comparation_pizzas.png" alt="pizzas">
            </div>
        </div>

           <?php include("reciclado/link_basket.php"); ?>
           <?php include("reciclado/footer.php"); ?>


</body>


</html>