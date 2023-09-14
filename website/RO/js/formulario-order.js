
const inputs = document.getElementsByClassName("inputFila");
const avisos = document.getElementsByClassName("avisoFila");
const btnSubmit = document.getElementById("btnEnviar");


const expresiones = {
    name:/^.{3,50}$/,
    email:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    address:/^.{3,50}$/,
    postcode:/^.{4,20}$/,
    telephone:/^\+?\d{6,20}$/,
}

for(var i=0; i<inputs.length;i++){
   
   inputs[i].addEventListener('keyup', validarFormulario);  // apretamos una tecla
   inputs[i].addEventListener('blur', validarFormulario);  //deseleccionamos un input
}

function validarFormulario(event){
    switch(event.target.name){
        case "name":
            if(expresiones.name.test(event.target.value)){
                avisos[0].style.display="none";
            }else{
                avisos[0].style.display="block";
            }
            break;
        case "email":
            if(expresiones.email.test(event.target.value)){
                avisos[1].style.display="none";
            }else{
                avisos[1].style.display="block";
            }
            break; 
        case "address":
            if(expresiones.address.test(event.target.value)){
                avisos[3].style.display="none";
            }else{
                avisos[3].style.display="block";
            }
            break;
        case "postcode":
            if(expresiones.postcode.test(event.target.value)){
                avisos[2].style.display="none";
                document.getElementById("dCButton").style.display = "block";
            }else{
                avisos[2].style.display="block";
                document.getElementById("dCButton").style.display = "none";
            }
            break;
        case "telephone":
            if(expresiones.telephone.test(event.target.value)){
                avisos[4].style.display="none";
            }else{
                avisos[4].style.display="block";
            }
            break;
    }
    
}

document.getElementById("dCButton").addEventListener("click",function(){
     calcularCharge();
});

btnSubmit.addEventListener("click", function(event){
var enviarForm=true;

    for(var ii=0;ii<inputs.length;ii++){
          if(inputs[ii].value == ""){
                avisos[ii].style.display="block";
          }
    }

    for(var ii=0;ii<avisos.length;ii++){
          if(avisos[ii].style.display== "block"){
              enviarForm=false;
          }
    }

    if(document.getElementById("dCInfo").innerText.localeCompare("Postcode out of delivery area.") == 0){
        enviarForm=false;
    }

        var calcularTotal = JSON.parse(localStorage.getItem("cart"));
        var twc=0;
        for(var con=0; con < calcularTotal.length; con++){
            twc += calcularTotal[con].quantity * calcularTotal[con].price;
        }
        
        if(twc < 17.0){
            enviarForm=false;
            document.getElementById("minimum_payment").style.display = "block";
        }


    //var calcularTotal = JSON.parse(localStorage.getItem("cart"));
       
       if(document.getElementById("time").value == "--select time--"){
            enviarForm=false; 
       }

      if(enviarForm==true){
        
        var na = document.getElementById("name").value;
        var em = document.getElementById("email").value;
        var dir = document.getElementById("address").value;
        var pc = document.getElementById("postcode").value;
        var tel = document.getElementById("telephone").value;
        var tac = document.getElementById("tacamuri").value;
        var comm = document.getElementById("comments").value;
        var pay = document.getElementById("payment").value;
        var dat = localStorage.getItem("cart");
        var rem = document.getElementById("remember");
        var date = document.getElementById("time").value;
        if(rem.checked){
            var reme = 1;
        }else{
            var reme = 0;
        }

        
        var peticion = new XMLHttpRequest();
            peticion.open('POST', 'manipulador/send_order.php', true);
            peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            peticion.onreadystatechange = function () {
                if (peticion.readyState == 4 && peticion.status == 200) {
                    
                    
                    
                    if(peticion.responseText == "cash"){
                        window.location.href = "cash_details.php";
                        localStorage.clear();
                    }else if(peticion.responseText == "transfer"){
                        window.location.href = "transfer_details.php";
                        localStorage.clear();
                    }
                    

                }

            }
          
            peticion.send('name=' + na + '&email=' + em +'&address=' + dir + '&postcode=' + pc + '&telephone=' + tel + '&comments=' + comm + '&tacamuri=' + tac + '&datos=' + dat + '&payment=' + pay + '&remember=' + reme + '&date=' + date);
        
      }else{
        
      }
});


function calcularCharge(){
            var postcode = document.getElementById("postcode").value;
            var pinfo = document.getElementById("dCInfo");
            var pbutton = document.getElementById("dCButton");
                var peticion = new XMLHttpRequest();
                       peticion.open('POST', 'reciclado/deliverycharge.php', true);
                       peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                       peticion.onreadystatechange = function () {
                             if (peticion.readyState == 4 && peticion.status == 200) {
                            
                                pinfo.style.display = "block";
                                pbutton.style.display = "none";
                                pinfo.innerText = peticion.responseText;

                }

            }
          
            peticion.send("postcode=" + postcode);
}

 