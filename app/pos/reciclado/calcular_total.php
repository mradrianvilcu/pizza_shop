<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include("../../reciclado/conectar_base_datos.php");

// USER CONECTADO
if(empty($_SESSION['username_Session'])){    
  $user_conectado = $_COOKIE['username_Cookie'];
}else{
  $user_conectado = $_SESSION['username_Session'];
}

//echo "USER CONECTADO: " . $user_conectado;

// FIN USER CONECTADO


$aux_Total=0;

$sqlCalculoTotal = "SELECT * FROM cesta WHERE user_id='$user_conectado'";
    $calculoTotal = $connect -> query($sqlCalculoTotal);
    if($calculoTotal -> num_rows > 0){
        while($ver_total = $calculoTotal-> fetch_assoc()){
            $aux_Total = $aux_Total + ($ver_total['price'] * $ver_total['quantity']);
        }
          
    }


echo $aux_Total;



?>