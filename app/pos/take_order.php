<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/take_order.css" type="text/css" rel="stylesheet" />
    <link href="css/links.css" type="text/css" rel="stylesheet" />
    <link href="css/imprimir.css" type="text/css" rel="stylesheet" />
    <script src="javascript/ajax.js"></script>
    <script src="javascript/enviar_form.js"></script>
    <script src="javascript/ver_menu.js"></script>
    <script src="javascript/abrir_ajustes.js"></script>
    <script src="javascript/jquery.js"></script>
</head>

<body onload="enviarDatos(),  agregarMenu(), agregarCharge(), cerrarOpciones(), ruedaAjustes()">
   <?php include("../reciclado/session2.php"); ?>


<!-- VER QUIEN ESTA LOGEADO EN ESTA CUENTA -->
<div>Logged as: <?php 
    if(isset($_COOKIE['username_Cookie'])){    
        echo $_COOKIE['username_Cookie'];
        $user_conectado = $_COOKIE['username_Cookie'];
    }else{  
    }
    ?></div>


    <?php
    include("reciclado/links.php");
    include("../reciclado/conectar_base_datos.php");

    // ver si tenemos algun POST;
    if(isset($_GET['order'])){
        $id_order = $_GET['order'];
        //echo "ID ORDER ES: " . $id_order;
        $compraAModificar = "SELECT * FROM orders WHERE id='$id_order'";
        $AModificar = $connect -> query($compraAModificar);
        if($AModificar -> num_rows > 0){
            $compra = $AModificar -> fetch_assoc();
            $aux_pers_id = $compra['pers_id'];
            //echo $aux_pers_id;
        }


        $order_details_a_modificar = "SELECT * FROM order_details WHERE order_id='$aux_pers_id'";
        $order_details = $connect -> query($order_details_a_modificar);
        if($order_details -> num_rows > 0){
            while($row_order_details = $order_details -> fetch_assoc()){

                $pro=$row_order_details['product_id']; // product id
                $pri=$row_order_details['price']; // price
                $qua=$row_order_details['quantity']; // quantity
                $menu_id1=$row_order_details['pro_id1']; 
                $menu_id2=$row_order_details['pro_id2'];  
                $menu_id3=$row_order_details['pro_id3'];  
                $menu_id4=$row_order_details['pro_id4'];  
                $menu_id5=$row_order_details['pro_id5'];  
                $menu_id6=$row_order_details['pro_id6'];  
                $insertarEnCesta = "INSERT INTO cesta (user_id, product_id, quantity, price, pro_id1, pro_id2, pro_id3, pro_id4, pro_id5, pro_id6) VALUES('$user_conectado',$pro, '$qua','$pri','$menu_id1','$menu_id2','$menu_id3','$menu_id4','$menu_id5' , '$menu_id6')";
                $connect -> query($insertarEnCesta);
            }
        }

    }else{
        //echo "NO ESTAMOS EN UNA ORDER EN CONCRETO";
    }
    
    ?>

    
    


    <div id="principal">
        <!------------ COLUMNA 1 -------------->
        <div id="columna1">
            <div id="categorias">

                <?php
                $sqlAbrirCategorias = "SELECT * FROM categories WHERE belong_pos='1' ORDER BY name";
                $resultadoCategorias = $connect->query($sqlAbrirCategorias);
                if ($resultadoCategorias->num_rows > 0) {
                    while ($row = $resultadoCategorias->fetch_assoc()) {
                ?>

                        <!----------- mesas/div con las categorias --------->
                      <!--  <a class="linkCategoria" href="take_order.php?productos-de=<?php echo $row['id']; ?>">  -->
                        <a class="linkCategoria" id="cat<?php echo $row['id'];?>">
                            <?php echo $row['name']; ?>
                        </a>

                <?php
                    }
                }
                ?>


            </div>

            <!-- AJAX PARA PRODUCTOS -->
            
        <script>
              

                    var botones_extension_categoria = document.getElementsByClassName("linkCategoria");
                
                for(var cat=0; cat < botones_extension_categoria.length; cat++){
                        botones_extension_categoria[cat].addEventListener("click",function(evento){
                            
                            var cat_id=evento.target.id.replace("cat","");

                 
                            $("#productos").load("reciclado/actualizar_menu_invisibles.php", 
                            {
                                productosde: cat_id
                            }, function(){
                                agregar();
                               
                                abrirOpciones();
                               
                                
                            }
                            );   
                            
                
   
                  
                        });
                }
       

       </script>

            <!--------- GESIONAMOS PRODUCTOS QUE SON SIMPLES O MENUS -------->
            <div id="productos">
                <?php
                if (isset($_GET['productos-de'])) {
                    $auxProductosDe = $_GET['productos-de'];
                    $sqlAbrirProductos = "SELECT * FROM products WHERE category_id='$auxProductosDe' ORDER BY name";
                    $resultadoProductos = $connect->query($sqlAbrirProductos);
                    if ($resultadoProductos->num_rows > 0) {
                        while ($row2 = $resultadoProductos->fetch_assoc()) {
                            if($row2['menu'] == 0){
                                ?>

                            <!----------- mesas/div con los productos --------->
                            <a class="linkProducto" id="<?php echo $row2['id'] ?>">
                                <?php echo $row2['name']; ?>
                            </a>

                <?php

                            }else{
?>
                            <a class="linkMenu" id="<?php echo $row2['id'] ?>">
                                <?php echo $row2['name']; ?>
                            </a>

<?php
                            }
                
                        }
                    }
                }
                ?>

            </div>
        </div>
   
        <?php
        // ------------- START MENUS INVISIBLES ------------
        $sqlAnalizarMenus = "SELECT * FROM menu";
        $resultadoMenus = $connect->query($sqlAnalizarMenus);
        if ($resultadoMenus->num_rows > 0) {
            while ($rowResultadoMenus = $resultadoMenus->fetch_assoc()) { // recorre todos los menus
        ?>

                <div class="divMenu" id="<?php echo "menu" . $rowResultadoMenus['product_id']; ?>">
                    <div>
                        <form action="manipulador/agregar_producto_lista.php" method="POST">

                            <?php
                            //echo $rowResultadoMenus['product_id']; // contiene el id del MENU

                            for ($ii = 1; $ii <= 6; $ii++) {
                                if (($rowResultadoMenus['category_id' . $ii]) != '0') {
                                    $auxid = $rowResultadoMenus['category_id' . $ii];

                            ?>
                                        
                                    <div>
                                        <label for="<?php echo "menu_pro_id" . $ii; ?>">
                                            <?php
                                            // buscamos el nombre de la categoria utilizando el id de la categoria
                                            $sqlNombreCategoria = "SELECT * FROM categories WHERE id='$auxid'";
                                            $resNombreCategoria = $connect->query($sqlNombreCategoria);
                                            if ($resNombreCategoria->num_rows > 0) {
                                                $nombreCategoria = $resNombreCategoria->fetch_assoc();
                                                echo $nombreCategoria['name']; // nos devuelve el nombre
                                            } ?>
                                        </label>
                                        <select class="<?php echo "menu_selected" . "?" . $rowResultadoMenus['product_id']?>" id="<?php echo "menu_pro_id" . $ii; ?>" name="<?php echo "menu_pro_id" . $ii; ?>">

                                            <?php

                                            $sqlProductos = "SELECT * from products WHERE category_id='$auxid'";
                                            $resultados = $connect->query($sqlProductos);

                                            if ($resultados->num_rows > 0) {
                                                while ($row = $resultados->fetch_assoc()) {
                                                    if($row['belong_menu'] == '1'){
                                                        echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                    }
                                                  
                                                }
                                            }
                                            ?>



                                        </select>
                                    </div>
                                <?php
                                }

                                ?>



                                </select>
                            <?php
                            }
                            ?>
                            <div>
                                <div>
                                    <p class="btnEnviarMenu" id="<?php echo "btnEnviarMenu" . $rowResultadoMenus['product_id']; ?>">Accept</p>
                                </div>
                                <div class="btnCerrar" id="<?php echo "btnCerrar" . $rowResultadoMenus['product_id']; ?>">
                                    &#x2716;
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        <?php
            }
        }



        // ------------- FIN MENUS INVISIBLES ------------
        ?>


        <!------------ COLUMNA 2 -------------->
        <div id="columna2">
            <div id="lista">
            <?php include("reciclado/ver_cesta.php");  ?>

            </div>
            <div id="divTotal">
                <div>TOTAL:&#160; <p id="total"><?php include("reciclado/calcular_total.php"); ?></p></div> 
            </div>

            <div id="detalles">  <!---------- DETALLES DEL CLIENTE ------------>
            
             
            <form autocomplete="off" style="width:80%; max-width:300px; " action="manipulador/enviar_pedido_db.php" id="form_detalles" method="POST">

            <!-- PARA CUANDO HAY QUE MODIFICAR UNA ORDER EN CONCRETO -->

            <?php 
            if(isset($_GET['order'])){ ?>

             <div style="display:none; flex-direction:column;">
             <input  id="id_order_a_modificar" type="text" name="id_order_a_modificar" readonly="readonly" value="<?php echo $id_order;?>">
             </div>
             <div style="display:none; flex-direction:column;">
             <input  id="pers_id_order_a_modificar" type="text" name="pers_id_order_a_modificar" readonly="readonly" value="<?php echo $aux_pers_id; ?>">
             </div>

            <?php  
            }else{}

            ?>

            <!-- FIN MODIFICAR ORDER -->

    <div style="display:flex; flex-direction:column;">
        <label  for="postcode">Postcode</label>
        <input  id="postcode" style="font-size:1.5rem;" type="text" name="postcode" 
        value="<?php
          if(isset($_GET['order'])){
             echo $compra['postcode'];  
        }else{
            echo "";
        }
        ?>"
      
        autocomplete="off" id="postcode" onkeyup="javascript:load_data(this.value)">
        <span id="search_result" style="font-size:2rem;"></span>
    </div>
    <div style="display:flex; flex-direction:column;">
        <label  for="address">Address</label>
        <input  style="font-size:1.5rem;" type="text" name="address" id="address"
        value="<?php
          if(isset($_GET['order'])){
             echo $compra['address'];  
        }else{
            echo "";
        }
        ?>"
        >
    </div>
    <div style="display:flex; flex-direction:column;">
        <label  for="telephone">Telephone&#160;</label>
        <textarea row="4" cols="50" name="telephone" id="telephone"><?php echo $compra['telephone'];?></textarea>
    </div>
    <div style="display:flex; flex-direction:column;">
        <label for="comments">Comments</label>
        <textarea  rows="4" cols="50" autocomplete="off" name="comments" id="comments"><?php echo $compra['comments'];?></textarea>
    </div>
    <div style="margin-top:0.5rem;">
    
    <label  for="tacamuri">TACAMURI:</label>
    <select name="tacamuri" id="tacamuri" >
    <?php
    if(isset($_GET['order'])){ ?>

                 <option value="-1">--</option>
                 <option value="1" <?php if($compra['tacamuri']==1){  echo "selected"; }?>>Da</option>
                 <option value="0" <?php if($compra['tacamuri']==0){  echo "selected"; }?>>Nu</option>
<?php
    }else{ ?>
                 <option value="-1">--</option>
                 <option value="1">Da</option>
                 <option value="0">Nu</option>
<?php 
    }
    ?>
   
</select>
    </div>
    <div style="margin:0.5rem;">
    <label  for="branch">BRANCH:</label>
    <select name="branch" id="branch" >
                 <option value="upton_park">Upton Park</option>
                 <option value="beckton">Beckton</option>
</select>
    </div>
   
</form>

<script>

function postcode_clicked(post){
    
    var postarray = post.split("?");
    // alert(postarray[0]); // POSTCODE
    // alert(postarray[1]); // ADDRESS
    // alert(postarray[2]); // TELEPHONE
 
    document.getElementById("postcode").value=postarray[0];
    document.getElementById("address").value=postarray[1];
    document.getElementById("telephone").value=postarray[2];
    document.getElementById("opciones_postcode").style.display="none";

     
}



function load_data(postcode){
       var html='<div id="opciones_postcode">';
      if(postcode.length > 2){
       var clickeado = false;

       document.getElementById("search_result").addEventListener("mouseleave", function(){
        document.getElementById('search_result').innerHTML="";
       })
        
        var ajax_request = new XMLHttpRequest;      
        ajax_request.open('POST','reciclado/process_data.php',true);
        ajax_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
       
        ajax_request.onreadystatechange = function (){
            if(ajax_request.readyState == 4 && ajax_request.status == 200){
                
                var response = JSON.parse(ajax_request.responseText);
                
                if(response.length > 0){

                    for(var count=0; count<response.length; count++){
                        var text= response[count].postcode + "?" + response[count].address + "?" + response[count].telephone;
                        html += '<a href="#" id="' + text + '" onclick="postcode_clicked('+ "this.id" +')"  ' + '>' + response[count].postcode + '</a>';
                        
                    }
                   
                }else{
                   
                }

                html+='</div>';
                document.getElementById('search_result').innerHTML=html;
              
            }
        }

        ajax_request.send("postcode=" + postcode);
    
      
      }else{
        document.getElementById('search_result').innerHTML="";
      }
     

}



    </script>

            </div>
            <div id="confirmacion">
                <div id="no">
                    <a href="manipulador/limpiar_cookie.php"><img src="img/No_Check_Circle.png"></a>

                </div>
                <div id="ok">
                    <img src="img/Yes_Check_Circle.png">
                </div>

            </div>
        </div>
    </div>

    
</body>

</html>