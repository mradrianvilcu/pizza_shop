<html>

<head>
    <link href="css/links.css" type="text/css" rel="stylesheet" />
    <link href="css/form.css" type="text/css" rel="stylesheet" />
    <script src="javascript/abrir_ajustes.js"></script>
</head>

<body onload="ruedaAjustes()">
    <?php
        include ("../reciclado/session2.php");
        include("reciclado/links.php");
        include("../reciclado/conectar_base_datos.php");

    
    ?>


    <div style=" margin-top:5rem; display:flex; flex-direction:column; align-items:center; justify-content:center;">
        
        <div style="margin:1rem;"><a style="text-decoration:none; background-color:rgb(55,55,55); color:white; padding:0.5rem;" href="ver_total_dia.php">TOTAL ZIUA</a></div>
        <div style="margin:1rem;"><a style="text-decoration:none; background-color:rgb(55,55,55); color:white; padding:0.5rem;" href="ver_total_interval.php">TOTAL INTERVAL</a></div>
        <div style="margin:1rem;"><a style="text-decoration:none; background-color:rgb(55,55,55); color:white; padding:0.5rem;" href="ver_producte_interval.php">PRODUCTE INTERVAL</a></div>
        <div style="margin:1rem;"><a style="text-decoration:none; background-color:rgb(55,55,55); color:white; padding:0.5rem;" href="ver_top_ten.php">TOP 10</a></div>
    </div>





</body>

</html>