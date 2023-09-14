function imprimir(){
    document.getElementById("btnImprimir").addEventListener("click",function(){

        document.body.style.margin = "1rem";
        var printContents = document.getElementById("invoice").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents; 
        document.body.style.margin = "0";       
        
    });
}