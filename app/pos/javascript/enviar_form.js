function enviarDatos(){
    document.getElementById("ok").addEventListener("click",function(){
     
        if(document.getElementById("total").innerText != 0){
            if(document.getElementById("telephone").value != ""){
                if(document.getElementById("postcode").value != ""){
                    if(document.getElementById("address").value != ""){
                        if(document.getElementById("tacamuri").value != "-1"){
                            document.getElementById("form_detalles").submit();
                        }else{
                            alert("Tacamuri can't be empty.");
                        }
                    }else{
                        alert("Address can't be empty.");
                    }
                }else{
                    alert("Postcode can't be empty.");
                }
            }else{
                alert("Telephone can't be empty.");
            }
        }else{
           alert("Empty cart can't be sent");
        }

     
        
    });
   
}