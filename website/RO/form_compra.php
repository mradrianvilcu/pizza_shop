<head>
    <meta charset="UTF-8"/>
        <title>Order</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="../img/favicon.gif" type="image/gif" sizes="16x16">
        <link href="css/order.css<?php include("reciclado/reset_cache.php") ?>" type="text/css" rel="stylesheet" />
        <script src="js/jquery.js<?php include("reciclado/reset_cache.php") ?>"></script>
        
        

    </head>
    <body>
<?php
//header("location: no_orders_notice.php");
session_start();
if(isset($_SESSION["totalM0"])){ ?>

<div id=container>
    <form action="manipulador/send_order.php" id="formulario" method="POST">
    <div class="divFila">
            <label class="textoFila" for="name">Nume:</label>
            <input class="inputFila" type="text" id="name" name="name" 
            <?php if(isset($_COOKIE['name'])){
                echo "value='" . $_COOKIE['name'] . "'";
            } ?>
            >
            <p class="avisoFila">*necesar</p>
    </div>
    <div class="divFila">
            <label class="textoFila" for="email">Email:</label>
            <input class="inputFila" type="text" id="email" name="email" 
            <?php if(isset($_COOKIE['email'])){
                echo "value='" . $_COOKIE['email'] . "'";
            } ?>
            >
            <p class="avisoFila">*necesar</p>
    </div>
    
    <div class="divFila">
            <label class="textoFila" for="postcode">Cod Postal:</label>
            <input class="inputFila" type="text" id="postcode" name="postcode"
            <?php if(isset($_COOKIE['postcode'])){
                echo "value='" . $_COOKIE['postcode'] . "'";
            } ?>
            >
            <p class="avisoFila">*necesar</p>
            <p id="dCButton" style="<?php if(isset($_COOKIE['postcode'])){
                echo "display:block";
            }else{
                echo "display:none";
            } ?>
            ">ARATA DELIVERY CHARGE</p>
            <p id="dCInfo">In aceasta zona nu facem delivery.</p>
    </div>
    <div class="divFila">
            <label class="textoFila" for="address">Address:</label>
            <input class="inputFila" type="text" id="address" name="address"
            <?php if(isset($_COOKIE['address'])){
                echo "value='" . $_COOKIE['address'] . "'";
            } ?>
            >
            <p class="avisoFila">*required</p>
    </div>
    <div class="divFila">
            <label class="textoFila" for="telephone">Telephone:</label>
            <input class="inputFila" type="text" id="telephone" name="telephone"
            <?php if(isset($_COOKIE['telephone'])){
                echo "value='" . $_COOKIE['telephone'] . "'";
            } ?>
            >
            <p class="avisoFila">*necesar</p>
    </div>
    <div class="divFila">
            <label class="textoFila" for="time">STARTING TIME:</label>
            <select id="time" name="time">
                <?php date_default_timezone_set('Europe/London'); ?>
                <?php 
                $timeMin = new DateTime('now');
                //echo $datetime->format('Y-m-d H:i:s');
                $day = $timeMin->format('Y-m-d');
                $aux_time_min  = $timeMin->format('i');
                $aux_time_hour = $timeMin->format('H');
                $aux_time_day = $timeMin->format('D'); //Mon, Tue, Wed, Thu, Fri, Sat, Sun
                for($x1=0; $aux_time_min <= 60; $x1++){
                    $aux_time_min++;
                    
                     if($aux_time_min == 00){
                        break;
                     }else if($aux_time_min == 15){
                        break;
                     }else if($aux_time_min == 30){
                        break;
                     }else if($aux_time_min == 45){
                        break;
                     }else if($aux_time_min == 60){
                        $aux_time_min=00;
                        $aux_time_hour++;
                        break;
                     }

                     
                }
                
                //echo $aux_time_hour . ":" . $aux_time_min; // tenemos la primera hora de delivery;
                ?>
                <option>--Selectioneaza o ora--</option>
                <?php

                $end = false;
                if($aux_time_hour == 21 && $aux_time_min > 45){
                    $end = true;
                }else if($aux_time_hour >= 21){
                    $end = true;
                }

                while($end == false){ 
                    if($aux_time_min == 0){
                        $aux_time_min = "00";
                    }

                    include("../days_open.php");

                        if($aux_time_hour >= $que_hora_empezar){ // la hora a la que empieza el delivery
                            ?>
                          <option value="<?php echo $day . " " . $aux_time_hour . ":" . $aux_time_min . ":" . "00" ?>">  <?php echo $aux_time_hour . ":" . $aux_time_min ?>  </option>
                          <?php
                           }
                    
                    
                    $aux_time_min+=15;
                    if($aux_time_min == 60){
                        $aux_time_min = 0;
                        $aux_time_hour++;
                     }

                     if($aux_time_hour == 22){
                        $end = true;
                        break;
                     }

                     

                }

                ?>
            
            </select>
    </div>
    <div class="divFila">
            <label class="textoFila" for="tacamuri">Tacamuri:</label>
            <select id="tacamuri" name="tacamuri">
                <option selected value="0">No</option>
                <option value="1">Yes</option>
            </select>
    </div>
    <div class="divFila">
            <label class="textoFila" for="payment">Plata:</label>
            <select id="payment" name="payment">
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
            </select>
    </div>
    <div class="divFila">
            <label class="textoFila" for="comments">Comentarii pentru bucatarie:</label>
            <textarea  rows="4" autocomplete="off" name="comments" id="comments"></textarea>
            <p id="minimum_payment">Minima comanda este £17.</p>
    </div>
    <div>
            <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE['checked'])){ echo "checked"; } ?> >
            <label for="remember">Remember me</label><br>
    </div>
    <div class="divFila">
        <div id="btnsPN">
            <a class="btnPN" href="basket.php">BACK</a>
            <div class="btnPN" id="btnEnviar">PLACE ORDER<div>
           
        </div>
            
    </div>
    
    </form>
</div>

<script src="js/formulario-order.js?123321"></script>

    <?php
}else{
    header("location: /");
}



?>
</body>