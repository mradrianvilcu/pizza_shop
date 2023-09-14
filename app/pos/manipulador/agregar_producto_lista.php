<?php

$pro_id=$_POST['producto_id'];
//$pro_id=117;


//------ 1
if(isset($_POST['menu_pro_id1'])){
    $menu_pro_id1=$_POST['menu_pro_id1'];
}else{
    $menu_pro_id1="0";
}

//------ 2
if(isset($_POST['menu_pro_id2'])){
    $menu_pro_id2=$_POST['menu_pro_id2'];
}else{
    $menu_pro_id2="0";
}

//------ 3
if(isset($_POST['menu_pro_id3'])){
    $menu_pro_id3=$_POST['menu_pro_id3'];
}else{
    $menu_pro_id3="0";
}

//------ 4
if(isset($_POST['menu_pro_id4'])){
    $menu_pro_id4=$_POST['menu_pro_id4'];
}else{
    $menu_pro_id4="0";
}

//------ 5
if(isset($_POST['menu_pro_id5'])){
    $menu_pro_id5=$_POST['menu_pro_id5'];
}else{
    $menu_pro_id5="0";
}
//------ 6
if(isset($_POST['menu_pro_id6'])){
    $menu_pro_id6=$_POST['menu_pro_id6'];
}else{
    $menu_pro_id6="0";
}

session_start();
include("../../reciclado/conectar_base_datos.php");

$domain='';

// USER CONECTADO
if(empty($_SESSION['username_Session'])){    
    $user_conectado = $_COOKIE['username_Cookie'];
}else{
    $user_conectado = $_SESSION['username_Session'];
}

echo "USER CONECTADO: " . $user_conectado;

// FIN USER CONECTADO

// SACAR PRECIO DEL PRODUCTO

$sqlDatosProducto = "SELECT * FROM products WHERE id='$pro_id'";
    $resDatosProducto = $connect -> query($sqlDatosProducto);
    if($resDatosProducto -> num_rows > 0){
        $rowDatosProducto = $resDatosProducto-> fetch_assoc();
           $price=$rowDatosProducto['price'];
    }


// fin SACAR PRECIO DEL PRODUCTO




// AGREGAR PRODUCTO A CESTA
//MIRAR SI HAY COPIAS PARA SUMARLE 1

$sqlComparadorCesta = "SELECT * FROM cesta WHERE product_id='$pro_id' AND user_id='$user_conectado'";
$ComparadorCesta = $connect -> query ($sqlComparadorCesta);

    
 
         
         if($ComparadorCesta -> num_rows > 0){
         $auxIdCopia=NULL;
         $auxCantidadCopias=NULL;
         $boolEsCopia = false;

          
            $auxContador=0;
            while( $ComparadorProductoCesta = $ComparadorCesta-> fetch_assoc()){
                $auxContador++;
                echo "PROD_ID1: " . $ComparadorProductoCesta['pro_id1'] . "\n";
                if($ComparadorProductoCesta['pro_id1'] == $menu_pro_id1){

                    if($ComparadorProductoCesta['pro_id2'] == $menu_pro_id2){

                        if($ComparadorProductoCesta['pro_id3'] == $menu_pro_id3){
                    
                            if($ComparadorProductoCesta['pro_id4'] == $menu_pro_id4){
                    
                                if($ComparadorProductoCesta['pro_id5'] == $menu_pro_id5){
                    
                                    if($ComparadorProductoCesta['pro_id6'] == $menu_pro_id6){
                    
                                        $auxIdCopia=$ComparadorProductoCesta['id'];
                                        $auxCantidadCopias=$ComparadorProductoCesta['quantity'] + 1;
                                        echo "CANTIDAD COPIAS: " . $auxCantidadCopias;
                                        $boolEsCopia = true;
                                        break;
                
                                    }else{
                                        $boolEsCopia = false;
                                    }
                    
                                }else{
                                    $boolEsCopia = false;
                                }
                
                            }else{
                                $boolEsCopia = false;
                            }
            
                        }else{
                            $boolEsCopia = false;
                        }
        
                    }else{
                        $boolEsCopia = false;
                    }

                }else{
                    $boolEsCopia = false;
                }


            }

            echo "CONTADOR: " . $auxContador;
            echo "AUXILIAR ID COPIA: " . $auxIdCopia;
            echo "BOOL ES COPIA: " . $boolEsCopia;
            if($boolEsCopia == true){

                $sqlAgregarACesta = "UPDATE cesta SET quantity ='$auxCantidadCopias' WHERE id='$auxIdCopia'";
                $connect -> query($sqlAgregarACesta);

            }else{ // es el mismo producto/menu pero con diferentes opciones

                $sqlAgregarACesta = "INSERT INTO cesta (user_id, product_id, quantity, price, pro_id1, pro_id2, pro_id3, pro_id4, pro_id5, pro_id6) VALUES('$user_conectado',$pro_id, '1','$price','$menu_pro_id1','$menu_pro_id2','$menu_pro_id3','$menu_pro_id4','$menu_pro_id5' , '$menu_pro_id6')";
                $connect -> query($sqlAgregarACesta);

            }


         }else{ // no se encuentra en la cesta este producto

            $sqlAgregarACesta = "INSERT INTO cesta (user_id, product_id, quantity, price, pro_id1, pro_id2, pro_id3, pro_id4, pro_id5, pro_id6) VALUES('$user_conectado',$pro_id, '1','$price','$menu_pro_id1','$menu_pro_id2','$menu_pro_id3','$menu_pro_id4','$menu_pro_id5' , '$menu_pro_id6')";
            $connect -> query($sqlAgregarACesta);

         }




?>