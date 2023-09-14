function abrirOpciones(){
    
    var productos_menu = document.getElementsByClassName("linkMenu");
    for(var i=0; i < productos_menu.length; i++){
        productos_menu[i].addEventListener("click",function(evento){
            
                document.getElementById("menu" + evento.target.id).style.display="flex";
        });
    }
    
}


function cerrarOpciones(){
    var cerrar_menu = document.getElementsByClassName("btnCerrar");
    for( var i=0; i<cerrar_menu.length; i++){
         cerrar_menu[i].addEventListener("click",function(evento){
               
               var aux_btn_cerrar = evento.target.id.replace("btnCerrar","");
               document.getElementById("menu" + aux_btn_cerrar).style.display="none";
         });
    }
}