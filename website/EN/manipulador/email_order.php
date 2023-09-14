<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/Exception.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';


        //-------------- ENVIAR EMAIL INFORMATIVO -----------
        $order_id='27082023085934245';
        include("../../reciclado/connect_database.php");

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
            $mail->addAddress('mradrianvilcu@gmail.com');     //Add a receipt
            $mail->addBCC('mariuseduardp82@gmail.com');
        
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
                   $mensaje.= 'Name: ' . $order_e['name'] . '<br/>';
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
            echo "We could not send the message. Sorry for the invocenveniences. Contact pizzamaria.uk . Mailer Error: {$mail->ErrorInfo}";
        }

  

?>