<?php
include("../../reciclado/connect_database.php");
session_start();

if(isset($_POST['address']) && isset($_POST['email']) && isset($_POST['postcode']) && isset($_POST['telephone'])){

    // ------------------------------------ SE CREA ORDER NUEVA 
    //datos
    $address=$_POST['address'];
    $postcode=$_POST['postcode'];
    $telephone=$_POST['telephone'];
    $tacamuri=$_POST['tacamuri'];
    $comments=$_POST['comments'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $payment = $_POST['payment'];
    $aux_datos=$_POST['datos'];
    $checked = $_POST['remember'];
    $date = $_POST['date'];
    echo $payment; // nos redirige a la siguiente pagina.
    $branch='upton_park';
    $aux_total_bucatarie = 0;
    $aux_total_pizza = 0;
    $aux_Total=0;
    $seEnviaALaBaseDeDatos = false;

    

    if($checked == 1){
        setcookie('name',$name,time()+3600*24*30,"/");
        setcookie('email',$email,time()+3600*24*30,"/");
        setcookie('postcode',$postcode,time()+3600*24*30,"/");
        setcookie('address',$address,time()+3600*24*30,"/");
        setcookie('telephone',$telephone,time()+3600*24*30,"/");
        setcookie('checked',"1",time()+3600*24*30,"/");
    }else{
        setcookie('name', null, -1, '/'); 
        setcookie('email', null, -1, '/'); 
        setcookie('postcode', null, -1, '/'); 
        setcookie('address', null, -1, '/'); 
        setcookie('telephone', null, -1, '/'); 
        setcookie('checked', null, -1, '/'); 
    }
    
    
    //--------------- AGREGAR CHARGE -----------------------


    $postcode_sin_espacio=str_replace(" ", "" ,$postcode);
    $notFound = false;
    $select_tabla_charge = "SELECT * FROM charge";
    $tabla_charge = $connect->query($select_tabla_charge);
    if ($tabla_charge->num_rows > 0) {
        while($row_charge = $tabla_charge -> fetch_assoc()){
            $aux_check_charge = strtoupper($row_charge['postcode']);
            $aux_check = strtoupper($postcode_sin_espacio);
            
             if(str_starts_with($aux_check, $aux_check_charge)){
                $auxCantidadCharge = $row_charge['charge'];
                $notFound = false;
                break;
             }else{
                $notFound = true;
             }
        }
       
         //delivery charge 1 -> {"id":"150?0?0?0?0?0?0?1","quantity":"1","price":"1"}]
         //delivery charge 2 -> {"id":"151?0?0?0?0?0?0?2","quantity":"1","price":"2"}]
         //delivery charge 3 -> {"id":"152?0?0?0?0?0?0?3","quantity":"1","price":"3"}]
         //delivery charge 4 -> {"id":"153?0?0?0?0?0?0?4","quantity":"1","price":"4"}]
         //delivery charge 5 -> {"id":"154?0?0?0?0?0?0?5","quantity":"1","price":"5"}]


        if($notFound == false){
            if($auxCantidadCharge == 1){
                $aux_datos2 = str_replace("]", ",{\"id\":\"150?0?0?0?0?0?0?1\",\"quantity\":\"1\",\"price\":\"1\"}]" , $aux_datos);
                $_SESSION["delivery"] = "1";
            }else if($auxCantidadCharge == 2){
             $aux_datos2 = str_replace("]", ",{\"id\":\"151?0?0?0?0?0?0?2\",\"quantity\":\"1\",\"price\":\"2\"}]" , $aux_datos);
             $_SESSION["delivery"] = "2";
            }else if($auxCantidadCharge == 3){
             $aux_datos2 = str_replace("]", ",{\"id\":\"152?0?0?0?0?0?0?3\",\"quantity\":\"1\",\"price\":\"3\"}]" , $aux_datos);
             $_SESSION["delivery"] = "3";
            }else if($auxCantidadCharge == 4){
             $aux_datos2 = str_replace("]", ",{\"id\":\"153?0?0?0?0?0?0?4\",\"quantity\":\"1\",\"price\":\"4\"}]" , $aux_datos);
             $_SESSION["delivery"] = "4";
            }else if($auxCantidadCharge == 5){
             $aux_datos2 = str_replace("]", ",{\"id\":\"154?0?0?0?0?0?0?5\",\"quantity\":\"1\",\"price\":\"5\"}]" , $aux_datos);
             $_SESSION["delivery"] = "5";
            }
         }else{
            $aux_datos2=$aux_datos;
         }
    
    
    }else{
        echo "ERROR";
    }

    $datos=json_decode($aux_datos2);


    //total bucatarie y pizza
    for($g=0; $g < count($datos); $g++){
           if($datos[$g]->{'quantity'} > 0){
            $seEnviaALaBaseDeDatos = true;
             $aux_ids = explode("?",$datos[$g]->{'id'});
             $aux_id = $aux_ids[0];
            
             $selectFromDatabase = "SELECT * FROM products where id='$aux_id'";
             $resultadoFD = $connect -> query($selectFromDatabase);
             if($resultadoFD -> num_rows > 0){
                $rowFD = $resultadoFD -> fetch_assoc();
                $aux_Total+= $rowFD['price'] * $datos[$g]->{'quantity'};

                if($rowFD['is_pizza'] == '1'){
                    $aux_total_pizza+= $rowFD['price'] * $datos[$g]->{'quantity'};
                }else{
                    $aux_total_bucatarie+= $rowFD['price'] * $datos[$g]->{'quantity'}; // se suma el charge tambien al estar en el json
                }
             }
           }
    }
   
    $_SESSION["totalO"] = $aux_Total;
      
    //sacar un numero de pedido personalizado
    $sqlFecha = "SELECT LOCALTIME";
    $resultadoFecha = $connect -> query($sqlFecha);
    $fecha = $resultadoFecha -> fetch_assoc();
    $datetime=strtotime(date($fecha['LOCALTIME']));
    $pers_id=date("dmYHis") . rand(100,999);


    //escribimos la order
    $mayusPostcode = strtoupper($postcode);
    $nospacePostcode = str_replace( " ", " " ,$mayusPostcode);
    date_default_timezone_set("Europe/London");
    $timezone = date("Y-m-d H:i:s");


    $sqlEscribirOrder = "INSERT INTO orders (pers_id, name, email, telephone,postcode,address,total,total_bucatarie, total_pizza, payment, branch,comments,tacamuri,printed,imported,created_at,updated_at) VALUES('$pers_id', '$name' , '$email','$telephone','$nospacePostcode','$address','$aux_Total','$aux_total_bucatarie' , '$aux_total_pizza' , '$payment','$branch','$comments', '$tacamuri','0','0','$timezone','$date')";
    if($seEnviaALaBaseDeDatos == true){
      $connect -> query($sqlEscribirOrder);
    }
    

    //segundo se escribe la order_details
    for($g2=0; $g2 < count($datos); $g2++){
        if($datos[$g2]->{'quantity'} > 0){

           $aux_ids2 = explode("?",$datos[$g2]->{'id'});
           $aux_id2 = $aux_ids2[0];
           if(isset($aux_ids2[1])){
            $pro_id1 = $aux_ids2[1];
           }else{
            $pro_id1 = "0";
           }
           if(isset($aux_ids2[2])){
            $pro_id2 = $aux_ids2[2];
           }else{
            $pro_id2 = "0";
           }
           if(isset($aux_ids2[3])){
            $pro_id3 = $aux_ids2[3];
           }else{
            $pro_id3 = "0";
           }
           if(isset($aux_ids2[4])){
            $pro_id4 = $aux_ids2[4];
           }else{
            $pro_id4 = "0";
           }
           if(isset($aux_ids2[5])){
            $pro_id5 = $aux_ids2[5];
           }else{
            $pro_id5 = "0";
           }
           if(isset($aux_ids2[6])){
            $pro_id6 = $aux_ids2[6];
           }else{
            $pro_id6 = "0";
           }
           
          $quantity = $datos[$g2]->{'quantity'};
         
          $selectFromDatabase2 = "SELECT * FROM products where id='$aux_id2'";
          $resultadoFD2 = $connect -> query($selectFromDatabase2);
          if($resultadoFD2 -> num_rows > 0){
             $rowFD2 = $resultadoFD2 -> fetch_assoc();

             $price = $rowFD2['price'];
             $sqlInsertarOrderDetails = "INSERT INTO order_details (order_id,product_id,quantity,price,pro_id1,pro_id2,pro_id3,pro_id4,pro_id5,pro_id6,created_at,updated_at) VALUES ('$pers_id','$aux_id2','$quantity','$price','$pro_id1','$pro_id2','$pro_id3','$pro_id4','$pro_id5', '$pro_id6','$timezone','$timezone')";
             if($seEnviaALaBaseDeDatos == true){
              $connect -> query($sqlInsertarOrderDetails);
            }
          }
        }
 }

}


// ---------------- SEND EMAIL-----------------------------

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';


        //-------------- ENVIAR EMAIL INFORMATIVO -----------
        $order_id=$pers_id;
        include("../reciclado/connect_database.php");

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.pizzamaria.uk';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'no-reply@pizzamaria.uk';                     //SMTP username
            $mail->Password   = 'j5-ic4Mth7f$';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('no-reply@pizzamaria.uk', 'Pizza Maria');
            $mail->addAddress($email);     //Add a receipt
            $mail->addBCC('mariuseduardp82@gmail.com');
            $mail->addBCC('mradrianvilcu@gmail.com');
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Order #' . $order_id;
               

// ---------------------------------- INICIO  MENSAJE EMAIL ------------
      
$mensaje="<html><body style='margin:0; background-color:rgb(204,204,204);'>";
$mensaje.="<table cellspacing='0' width='100%'><tr><td></td><td style='background-color:white; width:600px;'>";
$mensaje.="<a href='https://pizzamaria.uk/'><div style='text-align:center;'><img style='width:600px; height:auto;' src='http://pizzamaria.uk/img/email.png' alt='logo'></div></a>";
$mensaje.="<h2 style='text-align:center;'>We received your order!</h2>";
$mensaje.="<div style='margin:1rem;'> ";

        
        $sql_order_email = "SELECT * FROM orders WHERE pers_id='$order_id'";
        $order_email = $connect -> query($sql_order_email);
        if($order_email -> num_rows > 0){
            while($order_e = $order_email->fetch_assoc()){
                   $mensaje.= '<b>Delivery details:</b><br/>';
                   $mensaje.= $order_e['created_at'] . '<br/>';
                   $mensaje.='Starting time: ' . date("H:i",strtotime($order_e['updated_at'])) . '<br/>';
                   $mensaje.= 'Name: ' . $order_e['name'] . '<br/>';
                   $mensaje.= 'Telephone: ' . $order_e['telephone'] . '<br/>';
                   $mensaje.= 'Email: ' . $order_e['email'] .'<br/>';
                   $mensaje.= 'Address: ' .  $order_e['address'] . ' ' .$order_e['postcode'] .'<br/>';
                   if($order_e['tacamuri'] == 1){
                    $mensaje.= 'Tacamuri/Cutlery: ' . "Yes" . '<br/>';
                   }else if($order_e['tacamuri'] == 0){
                    $mensaje.= 'Tacamuri/Cutlery: ' . "No" . '<br/>';
                   }
                   
                   if($order_e['comments'] != ''){
                    $mensaje.= 'Comments: ' . $order_e['comments'] . '<br/>';
                   }
                   
                   $mensaje.= 'Payment: ' . $order_e['payment'] . '<br/>';
                   $mensaje.= '<b>TOTAL: £' . $order_e['total'] .'</b><br/><br/>';
            }
        }

        $mensaje.= '<b>Order details:</b><br/>';
        $sql_order_email_details = "SELECT * FROM order_details WHERE order_id='$order_id'";
        $order_email_details = $connect -> query($sql_order_email_details);
        if($order_email_details -> num_rows > 0){
            while($order_e_details = $order_email_details->fetch_assoc()){
                 $aux_id_product = $order_e_details['product_id'];
                 $sql_name="SELECT * FROM products WHERE id='$aux_id_product'";
                 $sql_n = $connect -> query($sql_name);
                 if($sql_n -> num_rows > 0){
                    $r_name = $sql_n ->fetch_assoc();
                    $mensaje.= "&bull; " . $r_name['name'];
                 }
                 $name_p=$connect -> query($sql_name);
                 $mensaje.= ' £' .  $order_e_details['price'] . ' x' .$order_e_details['quantity'] . '<br/>';
                 $id_compra = $order_e_details['product_id'] . "?" . $order_e_details["pro_id1"] . "?" . $order_e_details["pro_id2"] . "?" . $order_e_details["pro_id3"] . "?" . $order_e_details["pro_id4"] . "?" . $order_e_details["pro_id5"] . "?" . $order_e_details["pro_id6"];
                 $arrayCategoriasMenu = explode("?",$id_compra);
                 for($loop=1; $loop<=6;$loop++){
                    $aux_nombre_pro = $arrayCategoriasMenu[$loop];
                    if($aux_nombre_pro != 0){
                        $sqlSacarNombreProducto = "SELECT * FROM products where id='$aux_nombre_pro'";
                        $datos_nombres = $connect -> query($sqlSacarNombreProducto);
                        if($datos_nombres -> num_rows > 0){
                            $dato_name = $datos_nombres -> fetch_assoc();
                            $mensaje.= "&nbsp;&nbsp; + " . $dato_name['name'] . "<br/>";
                        }
                    }
                    
                 }
            }
        }



        $mensaje.="<div style='margin-top:48px; border-top-width:1px; border-top-color:black; border-top-style:solid; text-align:center'>";
        $mensaje.="<p>DO NOT REPLY TO THIS EMAIL.</p>";
        $mensaje.="<p><a  style='display:inline-block; margin-right:32px' href='https://www.instagram.com/pizzamariauk/'><img style='width:32px;height:32px;' src='http://pizzamaria.uk/img/icons/ig.png' alt='instagram'> </a>";    
        $mensaje.="<a style='display:inline-block' href='https://www.facebook.com/pizzamaria.uk/'> <img style='width:32px;height:32px;' src='http://pizzamaria.uk/img/icons/fb.png' alt='facebook'> </a></p>";
        $mensaje.="<p><a style='color:black; text-decoration:none;' href='https://pizzamaria.uk/'>pizzamaria.uk</a></p>";

        $mensaje.="</div></td><td></td></tr></table></body></html>";


// ---------------------------------- FIN MENSAJE EMAIL ---------------
    
            
        
            $mail->Body=$mensaje;
            $mail->CharSet = 'UTF-8';

            $mail->send();
            
        } catch (Exception $e) {
            //echo "We could not send the message. Sorry for the invocenveniences. Contact pizzamaria.uk . Mailer Error: {$mail->ErrorInfo}";
        }

  


  

?>