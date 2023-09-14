<?php
include("../../reciclado/conectar_base_datos.php");
include("../../reciclado/conectar_base_datos_online.php");

  // USER CONECTADO
if(empty($_SESSION['username_Session'])){    
    $user_conectado = $_COOKIE['username_Cookie'];
}else{
    $user_conectado = $_SESSION['username_Session'];
}

//echo "USER CONECTADO: " . $user_conectado;

// FIN USER CONECTADO

    if(isset($_POST['id_order_a_modificar']) && isset($_POST['pers_id_order_a_modificar'])){  // --------- SE MODIFICA ORDER EXISTENTE
      $id_order=$_POST['id_order_a_modificar'];
      $pers_id_order=$_POST['pers_id_order_a_modificar'];
      $telephone = $_POST['telephone']; 
      $postcode = $_POST['postcode'];
      $address = $_POST['address'];
      $comments = $_POST['comments'];
      $branch = $_POST['branch'];
      $tacamuri = $_POST['tacamuri'];
      $aux_tacamuri;
      if($tacamuri==1){
        $aux_tacamuri=1;
      }else{
        $aux_tacamuri=0;
      }
      $aux_total_bucatarie = 0;
      $aux_total_pizza = 0;
      $aux_Total=0;


      //total bucatarie y pizza


    $sqlcalcularTotal = "SELECT * FROM cesta WHERE user_id='$user_conectado'";
    $calcularTotal = $connect -> query($sqlcalcularTotal); 
    if($calcularTotal -> num_rows > 0){
      while($elementoCesta = $calcularTotal -> fetch_assoc()){
          $aux_Total = $aux_Total + ($elementoCesta['price'] * $elementoCesta['quantity']);

          //mirar si es pizza

          $aux_product_id=$elementoCesta['product_id'];
          $mirarTotalPizza = "SELECT * FROM products WHERE id='$aux_product_id'";
          $resultadoTotalPizza = $connect -> query($mirarTotalPizza);
    if($resultadoTotalPizza -> num_rows > 0){
        while($rowValorPizza=$resultadoTotalPizza->fetch_assoc()){
          if($rowValorPizza['is_pizza'] == 0){ // no es pizza
              $aux_total_bucatarie += ($elementoCesta['price'] * $elementoCesta['quantity']);
          }else{  // es pizza
            $aux_total_pizza += ($elementoCesta['price'] * $elementoCesta['quantity']);
          }
        }
    }
      }
    }


    // modificamos la order

$mayusPostcode = strtoupper($postcode);
$nospacePostcode = str_replace( " ", " " ,$mayusPostcode);
date_default_timezone_set("Europe/London");
$timezone = date("Y-m-d H:i:s");


$sqlEscribirOrder = "UPDATE orders SET telephone='$telephone', postcode='$postcode', address='$address', total='$aux_Total' , total_bucatarie='$aux_total_bucatarie', total_pizza='$aux_total_pizza', branch='$branch', comments='$comments',tacamuri='$aux_tacamuri' , printed='0', created_at='$timezone', updated_at='$timezone' WHERE pers_id='$pers_id_order'";
$connect -> query($sqlEscribirOrder);
$connect_online -> query($sqlEscribirOrder); // ----------------------- ONLINE


//agregamos el customer o modificamos


$sqlcheckCustomer = "SELECT * FROM customers WHERE postcode='$nospacePostcode'";
$resultadoCustomer = $connect -> query($sqlcheckCustomer);
if($resultadoCustomer -> num_rows > 0){
    $sqlupdateCustomer = "UPDATE customers SET address='$address', telephone='$telephone' WHERE postcode='$nospacePostcode'";
    $connect -> query($sqlupdateCustomer);
    $connect_online -> query($sqlupdateCustomer); // ----------------------- ONLINE
}else{
    $sqlinsertCustomer = "INSERT INTO customers (postcode,address,telephone) VALUES ('$nospacePostcode','$address','$telephone')";
    $connect -> query($sqlinsertCustomer);
    $connect_online -> query($sqlinsertCustomer); // ----------------------- ONLINE
}


// segundo se escribe la order_details pero primero para ello hay que borrar los datos antiguos
//borrar
$borrarOrderDetails = "DELETE FROM order_details WHERE order_id='$pers_id_order'";
$connect -> query($borrarOrderDetails);
$connect_online -> query($borrarOrderDetails); // ------------------------------------------- ONLINE

//agregar
$leerCesta = "SELECT * FROM cesta WHERE user_id='$user_conectado'";
$pasarCesta = $connect -> query($leerCesta);
if($pasarCesta -> num_rows > 0){
  while($row = $pasarCesta -> fetch_assoc()){
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $price = $row['price'];
    $pro_id1 = $row['pro_id1'];
    $pro_id2 = $row['pro_id2'];
    $pro_id3 = $row['pro_id3'];
    $pro_id4 = $row['pro_id4'];
    $pro_id5 = $row['pro_id5'];
    $pro_id6 = $row['pro_id6'];

    $sqlInsertarOrderDetails = "INSERT INTO order_details (order_id,product_id,quantity,price,pro_id1,pro_id2,pro_id3,pro_id4,pro_id5,pro_id6,created_at,updated_at) VALUES ('$pers_id_order','$product_id','$quantity','$price','$pro_id1','$pro_id2','$pro_id3','$pro_id4','$pro_id5', '$pro_id6','$timezone','$timezone')";
    $connect -> query($sqlInsertarOrderDetails);  
    $connect_online -> query($sqlInsertarOrderDetails); // ------------------------------------------ ONLINE
       
  }
}

$sqlDeleteCesta = "DELETE FROM cesta WHERE user_id='$user_conectado'"; // SE BORRA LA CESTA
$connect -> query($sqlDeleteCesta);
    


    }else{      // ------------------------------------ SE CREA ORDER NUEVA 

      $telephone = $_POST['telephone']; 
      $postcode = $_POST['postcode'];
      $address = $_POST['address'];
      $comments = $_POST['comments'];
      $tacamuri = $_POST['tacamuri'];
      $aux_tacamuri;
      if($tacamuri==1){
        $aux_tacamuri=1;
      }else{
        $aux_tacamuri=0;
      }
      $branch = $_POST['branch'];
      $aux_total_bucatarie = 0;
      $aux_total_pizza = 0;
      $aux_Total=0;


      //total bucatarie y pizza


    $sqlcalcularTotal = "SELECT * FROM cesta WHERE user_id='$user_conectado'";
    $calcularTotal = $connect -> query($sqlcalcularTotal); 
    if($calcularTotal -> num_rows > 0){
      while($elementoCesta = $calcularTotal -> fetch_assoc()){
          $aux_Total = $aux_Total + ($elementoCesta['price'] * $elementoCesta['quantity']);

          //mirar si es pizza

          $aux_product_id=$elementoCesta['product_id'];
          $mirarTotalPizza = "SELECT * FROM products WHERE id='$aux_product_id'";
          $resultadoTotalPizza = $connect -> query($mirarTotalPizza);
    if($resultadoTotalPizza -> num_rows > 0){
        while($rowValorPizza=$resultadoTotalPizza->fetch_assoc()){
          if($rowValorPizza['is_pizza'] == 0){ // no es pizza
              $aux_total_bucatarie += ($elementoCesta['price'] * $elementoCesta['quantity']);
          }else{  // es pizza
            $aux_total_pizza += ($elementoCesta['price'] * $elementoCesta['quantity']);
          }
        }
    }
      }
    }


//sacar un numero de pedido personalizado
    
$sqlFecha = "SELECT LOCALTIME";
$resultadoFecha = $connect -> query($sqlFecha);
$fecha = $resultadoFecha -> fetch_assoc();

$datetime=strtotime(date($fecha['LOCALTIME']));

$pers_id=date("dmYHis") . rand(100,999);


// primero escribir la order

$mayusPostcode = strtoupper($postcode);
$nospacePostcode = str_replace( " ", " " ,$mayusPostcode);
date_default_timezone_set("Europe/London");
$timezone = date("Y-m-d H:i:s");


$sqlEscribirOrder = "INSERT INTO orders (pers_id,telephone,postcode,address,total,total_bucatarie, total_pizza, branch,comments,tacamuri,printed,created_at,updated_at) VALUES('$pers_id','$telephone','$nospacePostcode','$address','$aux_Total','$aux_total_bucatarie' , '$aux_total_pizza' ,'$branch','$comments', '$aux_tacamuri','0','$timezone','$timezone')";
$connect -> query($sqlEscribirOrder);
$connect_online -> query($sqlEscribirOrder); // ------------------------------------ ONLINE

//agregamos el customer o modificamos


$sqlcheckCustomer = "SELECT * FROM customers WHERE postcode='$nospacePostcode'";
$resultadoCustomer = $connect -> query($sqlcheckCustomer);
if($resultadoCustomer -> num_rows > 0){
    $sqlupdateCustomer = "UPDATE customers SET address='$address', telephone='$telephone' WHERE postcode='$nospacePostcode'";
    $connect -> query($sqlupdateCustomer);
    $connect_online -> query($sqlupdateCustomer); // ------------------- ONLINE
}else{
    $sqlinsertCustomer = "INSERT INTO customers (postcode,address,telephone) VALUES ('$nospacePostcode','$address','$telephone')";
    $connect -> query($sqlinsertCustomer);
    $connect_online -> query($sqlinsertCustomer); // ------------------ ONLINE
}



// segundo se escribe la order_details

$leerCesta = "SELECT * FROM cesta WHERE user_id='$user_conectado'";
$pasarCesta = $connect -> query($leerCesta);
if($pasarCesta -> num_rows > 0){
  while($row = $pasarCesta -> fetch_assoc()){
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $price = $row['price'];
    $pro_id1 = $row['pro_id1'];
    $pro_id2 = $row['pro_id2'];
    $pro_id3 = $row['pro_id3'];
    $pro_id4 = $row['pro_id4'];
    $pro_id5 = $row['pro_id5'];
    $pro_id6 = $row['pro_id6'];

    $sqlInsertarOrderDetails = "INSERT INTO order_details (order_id,product_id,quantity,price,pro_id1,pro_id2,pro_id3,pro_id4,pro_id5,pro_id6,created_at,updated_at) VALUES ('$pers_id','$product_id','$quantity','$price','$pro_id1','$pro_id2','$pro_id3','$pro_id4','$pro_id5', '$pro_id6','$timezone','$timezone')";
    $connect -> query($sqlInsertarOrderDetails);  
    $connect_online -> query($sqlInsertarOrderDetails);  // -------------------- ONLINE
       
  }
}

$sqlDeleteCesta = "DELETE FROM cesta WHERE user_id='$user_conectado'"; // SE BORRA LA CESTA
$connect -> query($sqlDeleteCesta);



    }

    

 header("location: ../../orders.php");
  

?>