
function asdf(){

      // GO TO TOP SCRIPT
      
      document.addEventListener("scroll",function(){
     
        var boxGoToTop=document.getElementById("boxA");
        var altura=window.innerHeight/2;
        var hscroll = window.scrollY;
        

    if(altura>hscroll){
        boxGoToTop.style.display="none";
        
    }else{
        boxGoToTop.style.display="block";
     // alert("scroll " + hscroll + "height " + altura);
    }

      });

}




function abrirBtn3L(){
     var corti=document.getElementById("cortina");
     corti.style.display = "flex";
     document.body.style.overflow ="hidden";
}

function cerrarBtn3L(){
    var corti=document.getElementById("cortina");
    corti.style.display = "none";
    document.body.style.overflow ="auto";
}

