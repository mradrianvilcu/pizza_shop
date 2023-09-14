<?php
$pro_id=$_POST['id_borrar']; // esto es el item_id
//$pro_id=82;

$menu_pro_id1 = $_POST['menu_pro_id1'];
$menu_pro_id2 = $_POST['menu_pro_id2'];
$menu_pro_id3 = $_POST['menu_pro_id3'];
$menu_pro_id4 = $_POST['menu_pro_id4'];
$menu_pro_id5 = $_POST['menu_pro_id5'];
$menu_pro_id6 = $_POST['menu_pro_id6'];



session_start();
include("../../reciclado/conectar_base_datos.php");

// USER CONECTADO
if(empty($_SESSION['username_Session'])){    
    $user_conectado = $_COOKIE['username_Cookie'];
}else{
    $user_conectado = $_SESSION['username_Session'];
}

echo "USER CONECTADO: " . $user_conectado;

if(isset($pro_id)){

  
    $sqlBorrarElementoCesta="DELETE FROM cesta WHERE product_id='$pro_id' AND pro_id1='$menu_pro_id1' AND pro_id2='$menu_pro_id2' AND pro_id3='$menu_pro_id3' AND pro_id4='$menu_pro_id4' AND pro_id5='$menu_pro_id5' AND pro_id6='$menu_pro_id6' AND user_id='$user_conectado'";
    $connect -> query ($sqlBorrarElementoCesta);


   
}
   


?>