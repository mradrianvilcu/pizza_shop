<html>
<head>
    <title>Pizza Maria | THANK YOU</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/cssGeneral.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="stylesheet" href="css/header.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="stylesheet" href="css/footer.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="stylesheet" href="css/basket.css<?php include("reciclado/reset_cache.php") ?>" >
<link rel="icon" href="../img/favicon.gif" type="image/gif" sizes="16x16">
<script src="js/jsGeneral.js<?php include("reciclado/reset_cache.php") ?>"></script>
</head>

<body onload="asdf()">

<?php 
session_start();
if(isset($_SESSION['totalO'])){
?>


   <!-- detalles/menu -->
   <div style="height:100%; width:100%;">
   <div style="display:flex; padding:1rem; width:100%; height:100%; justify-content:center; flex-direction:column; align-items:center;">
   <p style="font-weight:bold; font-size:2rem; margin:1.5rem;">THANK YOU! </p>
   DELIVERY CHARGE: £ <?php if(isset($_SESSION["delivery"])){ echo $_SESSION["delivery"]; } ?> <br/>
   TOTAL: £ <?php if(isset($_SESSION["totalO"])){ echo $_SESSION["totalO"]; } ?> <br/>
   Platesti cand ajunge curierul. <br/>
   Pay when the delivery driver will arrive.
   <a style="text-decoration:none; color:white; padding:0.5rem; margin-top: 2rem; background-color:#d40000;" href="index.php">HOME</a>
   </div>

   <?php }else{
    header("location:index.php");
   } ?>


</body>


</html>