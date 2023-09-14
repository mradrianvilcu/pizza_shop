var botonesDelete;

function agregar(){
   

    var productos = document.getElementsByClassName("linkProducto");
   
    for(var i=0; i < productos.length; i++){
        productos[i].addEventListener("click",function(evento){
            
           
           //alert("mi ID es " + evento.target.id);
           var peticion = new XMLHttpRequest();
          
           peticion.open('POST', 'manipulador/agregar_producto_lista.php', true);
           peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
           peticion.onreadystatechange = function () {
                 if (peticion.readyState == 4 && peticion.status == 200) {
                   

                    $("#lista").load("reciclado/ver_cesta.php");
                    

                   recuperarTotal(); 
        }
    
    }
    
    peticion.send('producto_id=' + evento.target.id + '&menu_pro_id1=' + "0" + '&menu_pro_id2=' + "0" + '&menu_pro_id3=' + "0" + '&menu_pro_id4=' + "0" + '&menu_pro_id5=' + "0" + '&menu_pro_id6=' + "0");
    //peticion.send('producto_id=' + evento.target.id + '&size=' + selectSize.value);


        });
    }
    

  
    
}

function agregarCharge(){
   
    var trigger = document.getElementById("search_result");
    var postcode = document.getElementById("postcode");
    trigger.addEventListener("click", function(){
        //alert(postcode.value);

        var peticionCharge = new XMLHttpRequest();
          
           peticionCharge.open('POST', 'reciclado/deliverycharge.php', true);
           peticionCharge.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
           peticionCharge.onreadystatechange = function () {
                 if (peticionCharge.readyState == 4 && peticionCharge.status == 200) {
                    
                    $("#lista").load("reciclado/ver_cesta.php");

                        recuperarTotal();

                 }
            }

            peticionCharge.send('postcode=' + postcode.value);

    });
}

function agregarMenu(){

    var btnsSendMenu = document.getElementsByClassName("btnEnviarMenu");
    
    for(var i=0; i < btnsSendMenu.length; i++){
        btnsSendMenu[i].addEventListener("click",function(evento){
        
            var array_rows=[];
            var nr_id=evento.target.id.replace("btnEnviarMenu",""); // id del producto(menu)
            var optionsMenu = document.getElementsByClassName("menu_selected?" + nr_id);
            for(var ii=0; ii< optionsMenu.length; ii++){
             
                array_rows.push(optionsMenu[ii].value);

                
            }

            
                    //------- start peticion php 

                    var peticion3 = new XMLHttpRequest();
                    
                    peticion3.open('POST', 'manipulador/agregar_producto_lista.php', true);
                    peticion3.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    peticion3.onreadystatechange = function () {
                          if (peticion3.readyState == 4 && peticion3.status == 200) {
                           
                            $("#lista").load("reciclado/ver_cesta.php");

                            recuperarTotal(); 
                 }
             
             }
             //1
             if(array_rows[0]){
                 auxRow1=array_rows[0];
             }else{
                 auxRow1="0";
             }

             //2
             if(array_rows[1]){
                auxRow2=array_rows[1];
            }else{
                auxRow2="0";
            }

            //3
            if(array_rows[2]){
                auxRow3=array_rows[2];
            }else{
                auxRow3="0";
            }

            //4
            if(array_rows[3]){
                auxRow4=array_rows[3];
            }else{
                auxRow4="0";
            }

            //5
            if(array_rows[4]){
                auxRow5=array_rows[4];
            }else{
                auxRow5="0";
            }

            //6
            if(array_rows[5]){
                auxRow6=array_rows[5];
            }else{
                auxRow6="0";
            }

            
             //alert(auxRow1 + " " + auxRow2 + " " + auxRow3 + " " + auxRow4 + " " + auxRow5 + " " + auxRow6);
             peticion3.send('producto_id=' + nr_id + '&menu_pro_id1=' + auxRow1 + '&menu_pro_id2=' + auxRow2 + '&menu_pro_id3=' + auxRow3 + '&menu_pro_id4=' + auxRow4 + '&menu_pro_id5=' + auxRow5 + '&menu_pro_id6=' + auxRow6);
             // ---- fin peticion php -----------
             
             
             // desactivar div con el menu


              document.getElementById("menu" + nr_id).style.display="none";

        });
    }

}


function recuperarTotal(){
    var peticionTotal = new XMLHttpRequest();
         
           peticionTotal.open('GET', 'reciclado/calcular_total.php', true);
           peticionTotal.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
           peticionTotal.onreadystatechange = function () {
                 if (peticionTotal.readyState == 4 && peticionTotal.status == 200) {
                 
                   document.getElementById("total").innerText = peticionTotal.responseText;

                 }
                }

                peticionTotal.send(null);


               

               
}




function borrarElementoLista(x){
   
    botonesDelete = document.getElementsByClassName("btnDelete");
          var arrayDelete = x.id.split("?");
         
              var peticion2 = new XMLHttpRequest();
          
              peticion2.open('POST', 'manipulador/borrar_producto_lista.php', true);
              peticion2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
              peticion2.onreadystatechange = function () {
                    if (peticion2.readyState == 4 && peticion2.status == 200) {
                          
                        $("#lista").load("reciclado/ver_cesta.php");

                        recuperarTotal();
           }
       
       }
       peticion2.send('id_borrar=' + arrayDelete[1] + '&menu_pro_id1=' + arrayDelete[2] + '&menu_pro_id2=' + arrayDelete[3] + '&menu_pro_id3=' + arrayDelete[4] + '&menu_pro_id4=' + arrayDelete[5] + '&menu_pro_id5=' + arrayDelete[6] + '&menu_pro_id6=' + arrayDelete[7]);

    




    
}



