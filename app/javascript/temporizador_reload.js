function temp_reload(){ // para las orders que han sido printed
    var nr_printed_orders = document.getElementById("nr_printed_orders");
 

    setInterval(function(){
       
        var pet_calcular_orders = new XMLHttpRequest();
                    
        pet_calcular_orders.open('POST', 'obtener_nr_orders.php', true);
        pet_calcular_orders.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        pet_calcular_orders.onreadystatechange = function () {
              if (pet_calcular_orders.readyState == 4 && pet_calcular_orders.status == 200) {                        
                
                     if(parseInt(pet_calcular_orders.responseText) > parseInt(nr_printed_orders.innerText)){
                        
                            //alert(parseInt(pet_calcular_orders.responseText));
                            location.reload();
                            
                       
                     }
              }
        }
    
        pet_calcular_orders.send('orders_viejas=' + nr_orders);



    },5000);
    

}


function temp_reload2(){ // para todas las orders
    var nr_orders = document.getElementById("nr_orders");
 

    setInterval(function(){
       
        var pet_calcular_orders = new XMLHttpRequest();
                    
        pet_calcular_orders.open('POST', 'obtener_nr_orders_2.php', true);
        pet_calcular_orders.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        pet_calcular_orders.onreadystatechange = function () {
              if (pet_calcular_orders.readyState == 4 && pet_calcular_orders.status == 200) {                        
                
                     if(parseInt(pet_calcular_orders.responseText) > parseInt(nr_orders.innerText)){
                        
                            //alert(parseInt(pet_calcular_orders.responseText));
                            location.reload();
                            
                       
                     }
              }
        }
    
        pet_calcular_orders.send('orders_viejas=' + nr_orders);



    },5000);
    

}

function temp_reload3(){ // ACTUALIZAR DATABASE
    /*  -- BLOQUEO LA ACTUALIZACION */
    setInterval(function(){
    
    var pet_calcular_orders = new XMLHttpRequest();
                    
        pet_calcular_orders.open('POST', 'reciclado/actualizar_data_base.php', true);
        pet_calcular_orders.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        pet_calcular_orders.onreadystatechange = function () {
              if (pet_calcular_orders.readyState == 4 && pet_calcular_orders.status == 200) {                        
                  
                            
                            if(pet_calcular_orders.responseText == "true"){
                                //alert("actualizado");
                                location.reload();
                            }else{}       
                     
              }
        }
    
        pet_calcular_orders.send();
    

    },5000);
    
}
