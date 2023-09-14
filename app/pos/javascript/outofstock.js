function Not_Available(){

    var products = document.getElementsByClassName("product_categorie");
    for(var i=0; i<products.length; i++){
        products[i].addEventListener("click",function(evento){
           
          var elem = document.getElementById("stamp_" + evento.target.id);
          const mySrc = elem.src.split("/");
          var pro_id=evento.target.id;
          var available_value;
          if(mySrc[mySrc.length - 1] == "stampPizzaMaria.png"){ //its 0
                 elem.src= "img/noStampPizzaMaria.png"
                 available_value=1;
          }else{                                                //its 1
                 elem.src= "img/stampPizzaMaria.png"; 
                 available_value=0;
          }

          var change_availability = new XMLHttpRequest();
                    
                    change_availability.open('POST', 'manipulador/change_availability.php', true);
                    change_availability.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    change_availability.onreadystatechange = function () {
                          if (change_availability.readyState == 4 && change_availability.status == 200) {                        
                             
                          }
                    }

                    change_availability.send('product_id=' + pro_id + '&available=' + available_value);
        
        });
    }
}