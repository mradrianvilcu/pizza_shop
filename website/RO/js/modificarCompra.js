function verCompra(){
    var contenido = document.getElementById("idDetalles");

    if(localStorage.getItem("cart") === null){

        contenido.innerText = "YOUR CART IS EMPTY";

    }else{

        // CREACION DE LOS DIV

        var listaAComprar = JSON.parse(localStorage.getItem("cart"));
        var cuantoTotal=0;
        for(var xi=0; xi<listaAComprar.length;xi++){   //Bucle que recorre toda la lista en el localstorage
             if(listaAComprar[xi].quantity > 0){
                 
       
               //se crea el div que contiene a un solo elemento de la lista
            var divContainer=document.createElement("div");    
            contenido.appendChild(divContainer);
            divContainer.setAttribute("class", "elementoLista");
            divContainer.setAttribute("id","elem" + xi);

            //se crea el div que contiene el nombre del producto
            var vDivNombre=document.createElement("div");
            divContainer.appendChild(vDivNombre);
            vDivNombre.setAttribute("id","name" + xi);
            vDivNombre.setAttribute("class", "elementoNombre");
            var vDivN=document.createElement("div");
            vDivN.setAttribute("class", "elementoN");
            vDivNombre.appendChild(vDivN);
            var arrayIds=listaAComprar[xi].id.split("?");
            
            regresarNombre(arrayIds[0], vDivN);
            

            //crear lista si es necesaria
            if(arrayIds[1] != 0){
                var vDivUL=document.createElement("ul");
                vDivNombre.appendChild(vDivUL);
                var vDivLi=document.createElement("li");
                vDivUL.appendChild(vDivLi);
                vDivLi.innerText = "adsada";
                vDivLi.setAttribute("class", "elementoLi");
                regresarLi(arrayIds[1], vDivLi);
                for(var xis=2; xis <=6; xis ++){
                    if(arrayIds[xis] != 0){
                        vDivLi=document.createElement("li");
                        vDivUL.appendChild(vDivLi);
                        vDivLi.setAttribute("class", "elementoLi");
                        regresarLi(arrayIds[xis], vDivLi);
                    }   
                }
            }else{}

            //se crea el boton menos
            var btnMenos = document.createElement("div");
            divContainer.appendChild(btnMenos);
            btnMenos.innerText = "-";
            btnMenos.setAttribute("id","i" + xi);
            btnMenos.setAttribute("class","btnMenos");
            btnMenos.addEventListener("click",function(){
                    var xes=parseInt(this.id.replace("i", ""));
   
                    listaAComprar[xes].quantity=parseInt(listaAComprar[xes].quantity) - 1;
   
                    localStorage.setItem("cart", JSON.stringify(listaAComprar));
                    
                    var xex="n"+ xes;
   
               
                    restarNumero(xex,contenido);
                    divTotalNr.innerText = calcularTotal(cuantoTotal,listaAComprar);
                    continuar(calcularTotal(cuantoTotal,listaAComprar));
    
            });

            //se crea el div de la cantidad
            var vDivCantidad = document.createElement("div");
            divContainer.appendChild(vDivCantidad);
            vDivCantidad.innerText = listaAComprar[xi].quantity;
            vDivCantidad.setAttribute("id","n" + xi);


            //se crea el boton mas
            var btnMas = document.createElement("div");
            divContainer.appendChild(btnMas);
            btnMas.innerText = "+";
            btnMas.setAttribute("class","btnMas");
            btnMas.setAttribute("id","d"+xi);
            btnMas.addEventListener("click",function(){

                var xes=parseInt(this.id.replace("d", ""));

                listaAComprar[xes].quantity=parseInt(listaAComprar[xes].quantity) + 1;

                localStorage.setItem("cart", JSON.stringify(listaAComprar));

                var xex="n"+ xes;

                sumarNumero(xex);

                divTotalNr.innerText = calcularTotal(cuantoTotal,listaAComprar);
            

            });

            //se crea el boton delete
            var btnDel = document.createElement("div");
            divContainer.appendChild(btnDel);
            btnDel.innerText = "×";
            btnDel.setAttribute("class","btnDel");
            btnDel.setAttribute("id", "x" + xi);
            btnDel.addEventListener("click",function(){
                var xes=parseInt(this.id.replace("x", ""));
                listaAComprar[xes].quantity=0;
                localStorage.setItem("cart", JSON.stringify(listaAComprar));
                document.getElementById("elem" + xes).style.display="none";

                divTotalNr.innerText = calcularTotal(cuantoTotal,listaAComprar);
                continuar(calcularTotal(cuantoTotal,listaAComprar));
                borrarLocalStorage(contenido);
            });


             }
        }

        //se crea el total
        var divTotal=document.createElement("div");    
            contenido.appendChild(divTotal);
            divTotal.setAttribute("id","totalNumero");
            divTotal.innerText = "Subtotal: £";
            var divTotalNr=document.createElement("div");
            divTotal.appendChild(divTotalNr);
            divTotalNr.innerText = calcularTotal(cuantoTotal,listaAComprar);

            continuar(calcularTotal(cuantoTotal,listaAComprar)); //se crea la session para continuar la compra 

        //se crea el boton de continuar 
        var divContinuar=document.createElement("div");  
        contenido.appendChild(divContinuar);
        divContinuar.setAttribute("id", "contenedorCont");
        var divA=document.createElement("a");
        divContinuar.appendChild(divA);
        divA.setAttribute("href","form_compra.php"); 
        divA.innerText = "NEXT";

        //se crean comentarios debajo de next
        var divComment = document.createElement("div");
        contenido.appendChild(divComment);
        divComment.innerHTML="*subtotal fara delivery charge";
    }
}

function restarNumero(elem,elem2){
    var boxACambiar=document.getElementById(elem);
    var numeroViejo=parseInt(boxACambiar.innerText);
    var numeroNuevo= numeroViejo - 1;
    boxACambiar.innerText=numeroNuevo;

    if(numeroNuevo == 0){

      var buscarId= "elem" + (elem.replace("n", ""));
      var elementoABorrar=document.getElementById(buscarId);
      elementoABorrar.style.display ="none";

    }

    borrarLocalStorage(elem2);


}

function borrarLocalStorage(elem2){
    var checkLista=JSON.parse(localStorage.getItem("cart"));
    
    var isEmpty=true;
     
    for(var iii=0; iii < checkLista.length ; iii++){
        if(checkLista[iii].quantity != 0){
          isEmpty=false;
          break;
        }
    }
  
    
    if(isEmpty == true){
      localStorage.clear();
      elem2.innerText="YOUR CART IS EMPTY";
    }
  
  
  
  }



function sumarNumero(elem){
    var boxACambiar=document.getElementById(elem);
    var numeroViejo=parseInt(boxACambiar.innerText);
    var numeroNuevo= numeroViejo + 1;;
    boxACambiar.innerText=numeroNuevo;
}



function regresarNombre(id, divInnerText){
    
    var peticion = new XMLHttpRequest();
            peticion.open('POST', 'manipulador/getName.php', true);
            peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            peticion.onreadystatechange = function () {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    
                   divInnerText.innerText = peticion.responseText;

                }

            }
          
            peticion.send('pro_id=' + id);
}

function regresarLi(id, divInnerText){
    
    var peticion = new XMLHttpRequest();
            peticion.open('POST', 'manipulador/getLi.php', true);
            peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            peticion.onreadystatechange = function () {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    
                   divInnerText.innerText = peticion.responseText;

                }

            }
          
            peticion.send('pro_id=' + id);
}


function calcularTotal(cuanto, lista){
    for(var x2=0; x2<lista.length;x2++){   //Bucle que recorre toda la lista en el localstorage
        if(lista[x2].quantity > 0){
            cuanto += parseFloat(lista[x2].price) * parseInt(lista[x2].quantity);
        }
    }

    return cuanto.toFixed(2);
}

function continuar(cantidadTotal){
    var peticionCantidad = new XMLHttpRequest();
    peticionCantidad.open('POST', 'manipulador/continuar_cesta.php', true);
    peticionCantidad.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    peticionCantidad.onreadystatechange = function () {
        if (peticionCantidad.readyState == 4 && peticionCantidad.status == 200) {

        }

    }
  
    peticionCantidad.send('total=' + cantidadTotal);
}