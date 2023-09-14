function comprar(){
    //localStorage.clear();

    function food(id, quantity, price){
        this.id=id;
        this.quantity=quantity;
        this.price=price;
        }    
  
        var arrayCompra=[]; // creamos un array vacio

    var btns = document.getElementsByClassName("btnComprar");
    for(var i=0; i<btns.length; i++){ //recorremos todos los botones que agregan productos
        btns[i].addEventListener("click",function(event){
           
            if(localStorage.getItem("cart") === null){ // si el cart no esta declarado creamos el primero
                var arPrice = event.target.id.split("?");
                var item = new food(event.target.id,"1",arPrice[7]);
                arrayCompra.push(item);
                localStorage.setItem("cart",JSON.stringify(arrayCompra));
                
              
            }else{  // si ya esta declarado

                arrayCompra = JSON.parse(localStorage.getItem("cart")); // al estar ya declarado sustituimos el array viejo por el nuevo
                var itemNuevo = true;
                for(var xi=0; xi<arrayCompra.length;xi++){ // recorremos el nuevo array

                    if(arrayCompra[xi].id == event.target.id){  // hemos encontrado ya el clickeado dentro
                        itemNuevo=false;
                        arrayCompra[xi].quantity = parseInt(arrayCompra[xi].quantity) + 1;
                        localStorage.setItem("cart",JSON.stringify(arrayCompra));
                    }

                }

                if(itemNuevo == true){ // no hemos encontrado el clickeado por lo que lo aniadimos
                    var arPrice = event.target.id.split("?");
                    var item = new food(event.target.id,"1",arPrice[7]);
                    arrayCompra.push(item);
                    localStorage.setItem("cart",JSON.stringify(arrayCompra));
                }

            }

            var nameClicked = document.getElementById(event.target.id).innerHTML;
            document.getElementById(event.target.id).innerHTML = "&#10003;";
            setTimeout(function(){
            document.getElementById(event.target.id).innerHTML = nameClicked;
            }, 500);

            numeroCart();

        });
    }

}

function desplegarMenu(){ /// -------para los que son menu
    var btnsMenu = document.getElementsByClassName("btnMenu");
    var btnsCerrarMenu = document.getElementsByClassName("closeCM");
    var btnsBuy = document.getElementsByClassName("btnBuyMenu");
    for(var is=0; is<btnsMenu.length; is++){
        btnsMenu[is].addEventListener("click", function(event){
            document.getElementById("menu" + event.target.id).style.display="flex";
            document.body.style.overflow = "hidden";
        });
    }


    for(var is2=0; is2<btnsCerrarMenu.length; is2++){
        btnsCerrarMenu[is2].addEventListener("click", function(event){
            var aux_id_x = event.target.id.replace("closeCortinaMenu", "");
            document.getElementById("menu" + aux_id_x).style.display="none";
            document.body.style.overflow = "auto";
        });
    }

    for(var is3=0; is3<btnsBuy.length; is3++){
        btnsBuy[is3].addEventListener("click", function(event){
            var aux_id_x = event.target.id.replace("buy", "");
            var aux_id_x2 = aux_id_x.split("?");
            var divSelect = document.getElementsByClassName("selected" + aux_id_x)
            var id_completo=aux_id_x2[0] + "?";
            for(var is4=0; is4<divSelect.length;is4++){
                //divSelect.length
                 id_completo += divSelect[is4].value + "?";
            }
            if(divSelect.length == "1"){
                id_completo += "0?0?0?0?0?";
            }else if(divSelect.length == "2"){
                id_completo += "0?0?0?0?";
            }else if(divSelect.length == "3"){
                id_completo += "0?0?0?";
            }else if(divSelect.length == "4"){
                id_completo += "0?0?";
            }else if(divSelect.length == "5"){
                id_completo += "0?";
            }
            id_completo+=aux_id_x2[7]; //se le aniade el precio
        

            //agregamos al local storage;
            function food(id, quantity, price){
                this.id=id;
                this.quantity=quantity;
                this.price=price;
                } 

                arrayCompra=[];

                if(localStorage.getItem("cart") === null){ // si el cart no esta declarado creamos el primero
                    var item = new food(id_completo,"1",aux_id_x2[7]);
                    arrayCompra.push(item);
                    localStorage.setItem("cart",JSON.stringify(arrayCompra));
                    
                  
                }else{  // si ya esta declarado
                    
                    arrayCompra = JSON.parse(localStorage.getItem("cart")); // al estar ya declarado sustituimos el array viejo por el nuevo
                var itemNuevo = true;
                for(var xi=0; xi<arrayCompra.length;xi++){ // recorremos el nuevo array

                    if(arrayCompra[xi].id == id_completo){  // hemos encontrado ya el clickeado dentro
                        itemNuevo=false;
                        arrayCompra[xi].quantity = parseInt(arrayCompra[xi].quantity) + 1;
                        localStorage.setItem("cart",JSON.stringify(arrayCompra));
                    }

                }

                if(itemNuevo == true){ // no hemos encontrado el clickeado por lo que lo aniadimos
                    var item = new food(id_completo,"1",aux_id_x2[7]);
                    arrayCompra.push(item);
                    localStorage.setItem("cart",JSON.stringify(arrayCompra));
                }
                    
                }

                numeroCart();
                document.getElementById("menu" + event.target.id.replace("buy", "")).style.display="none";
                document.body.style.overflow = "auto";
        });
    }
    
}

function numeroCart(){
    
    if(localStorage.getItem("cart") === null){  
    }else{
        var total=0;
        var cantidad = JSON.parse(localStorage.getItem("cart"));
        for(var i3=0; i3<cantidad.length;i3++){
         total+= parseInt(cantidad[i3].quantity);
        }

        document.getElementById("numeroCart").innerText = total;
    }

}