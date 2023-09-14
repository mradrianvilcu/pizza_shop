<html><body style='margin:0; background-color:rgb(204,204,204);'>
<table cellspacing='0' width='100%'><tr><td></td><td style='background-color:white; width:600px;'>

        <a href='https://pizzamaria.uk/'><div style='text-align:center;'><img style='width:600px; height:auto;' src='http://pizzamaria.uk/img/email.png' alt='logo'></div></a>
        <h2 style='text-align:center;'>We received your order!</h2>
        <div style='margin:1rem;'> 
        <?php
        $order_id='27082023085934245';
        include("../../reciclado/connect_database.php");
        $sql_order_email = "SELECT * FROM orders WHERE pers_id='$order_id'";
        $order_email = $connect -> query($sql_order_email);
        if($order_email -> num_rows > 0){
            while($order_e = $order_email->fetch_assoc()){
                   echo '<b>Delivery details:</b><br/>';
                   echo 'Name: ' . $order_e['name'] . '<br/>';
                   echo 'Email: ' . $order_e['email'] .'<br/>';
                   echo 'Address: ' .  $order_e['address'] . ' ' .$order_e['postcode'] .'<br/>';
                   if($order_e['tacamuri'] == 1){
                    echo 'Tacamuri/Cutlery: ' . "Yes" . '<br/>';
                   }else if($order_e['tacamuri'] == 0){
                    echo 'Tacamuri/Cutlery: ' . "No" . '<br/>';
                   }
                   
                   if($order_e['comments'] != ''){
                    echo 'Comments: ' . $order_e['comments'] . '<br/>';
                   }
                   
                   echo 'Payment: ' . $order_e['payment'] . '<br/>';
                   echo 'TOTAL: £' . $order_e['total'] .'<br/><br/>';
            }
        }

        echo '<b>Order details:</b><br/>';
        $sql_order_email_details = "SELECT * FROM order_details WHERE order_id='$order_id'";
        $order_email_details = $connect -> query($sql_order_email_details);
        if($order_email_details -> num_rows > 0){
            while($order_e_details = $order_email_details->fetch_assoc()){
                 $aux_id_product = $order_e_details['product_id'];
                 $sql_name="SELECT * FROM products WHERE id='$aux_id_product'";
                 $sql_n = $connect -> query($sql_name);
                 if($sql_n -> num_rows > 0){
                    $r_name = $sql_n ->fetch_assoc();
                    echo "&bull; " . $r_name['name'];
                 }
                 $name_p=$connect -> query($sql_name);
                 echo ' £' .  $order_e_details['price'] . ' x' .$order_e_details['quantity'] . '<br/>';
                 $id_compra = $order_e_details['product_id'] . "?" . $order_e_details["pro_id1"] . "?" . $order_e_details["pro_id2"] . "?" . $order_e_details["pro_id3"] . "?" . $order_e_details["pro_id4"] . "?" . $order_e_details["pro_id5"] . "?" . $order_e_details["pro_id6"];
                 $arrayCategoriasMenu = explode("?",$id_compra);
                 for($loop=1; $loop<=6;$loop++){
                    $aux_nombre_pro = $arrayCategoriasMenu[$loop];
                    if($aux_nombre_pro != 0){
                        $sqlSacarNombreProducto = "SELECT * FROM products where id='$aux_nombre_pro'";
                        $datos_nombres = $connect -> query($sqlSacarNombreProducto);
                        if($datos_nombres -> num_rows > 0){
                            $dato_name = $datos_nombres -> fetch_assoc();
                            echo "&nbsp;&nbsp; + " . $dato_name['name'] . "<br/>";
                        }
                    }
                    
                 }
                 
            }
        }

        ?>

        
    
     

        <div style='margin-top:48px; border-top-width:1px; border-top-color:black; border-top-style:solid; text-align:center'>
        <p>DO NOT REPLY TO THIS EMAIL.</p>
        <p><a  style='display:inline-block; margin-right:32px' href='https://www.instagram.com/pizzamariauk/'><img style='width:32px;height:32px;' src='http://pizzamaria.uk/img/icons/ig.png' alt='instagram'> </a>     
        <a style='display:inline-block' href='https://www.facebook.com/pizzamaria.uk/'> <img style='width:32px;height:32px;' src='http://pizzamaria.uk/img/icons/fb.png' alt='facebook'> </a></p>
        <p><a style='color:black; text-decoration:none;' href='https://pizzamaria.uk/'>pizzamaria.uk</a></p>

        </div></td><td></td></tr></table></body></html>