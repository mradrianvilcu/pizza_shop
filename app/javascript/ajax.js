function imp_invoice(){
    var botones_invoice = document.getElementsByClassName("invoice");
    for(var i=0; i < botones_invoice.length; i++){
        botones_invoice[i].addEventListener("click",function(evento){
        
            var imp_id = evento.target.id.replace("btnInvoice","");

            var printContents =  document.getElementById("invoice" + imp_id).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
    
            window.print();
            
            document.body.innerHTML = originalContents;

            location.reload();
        });
    
       
    }
}






function imp_kitchen(){
    
    var botones_kitchen = document.getElementsByClassName("kitchen");
    for(var i=0; i < botones_kitchen.length; i++){
        botones_kitchen[i].addEventListener("click",function(evento){
            
            var imp_id = evento.target.id.replace("btnKitchen","");
            //alert(imp_id);
           
            var pet_impresora = new XMLHttpRequest();
                    
                    pet_impresora.open('POST', 'kitchen.php', true);
                    pet_impresora.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    pet_impresora.onreadystatechange = function () {
                          if (pet_impresora.readyState == 4 && pet_impresora.status == 200) {                        
                              location.reload();
                          }
                    }

                    pet_impresora.send('id_order=' + imp_id);

        });
    }
}


function imp_deleted(){
    var botones_kitchen = document.getElementsByClassName("kitchen2");
    for(var i=0; i < botones_kitchen.length; i++){
        botones_kitchen[i].addEventListener("click",function(evento){
            var imp_id = evento.target.id.replace("btnDelete","");
            //alert(imp_id);
       
            var pet_impresora = new XMLHttpRequest();
                    
                    pet_impresora.open('POST', 'delete_order.php', true);
                    pet_impresora.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    pet_impresora.onreadystatechange = function () {
                          if (pet_impresora.readyState == 4 && pet_impresora.status == 200) {                        
                            location.reload();
                          }
                    }

                    pet_impresora.send('id_order=' + imp_id);

    

        });
    }
}