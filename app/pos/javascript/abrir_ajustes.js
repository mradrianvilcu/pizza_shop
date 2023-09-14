function ruedaAjustes(){
    var btn_ajustes = document.getElementById("ajustes");
    var barra_enlaces = document.getElementById("enlaces");
    btn_ajustes.addEventListener("click",function(){
    if(barra_enlaces.style.display=="none"){
        barra_enlaces.style.display = "flex";
    }else{
        barra_enlaces.style.display = "none";
    }
   

    });
}
