<html>
    <head>
    <title>Pizza Maria | LANGUAGE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pizza, gratare, mancaruri traditionale, supe/ciorbe, deserturi si painici proaspete.">
    <link rel="icon" href="../img/favicon.gif" type="image/gif" sizes="16x16">
    </head>
    <body>
        <?php 
        if(isset($_COOKIE['language'])){
            $lang = $_COOKIE['language'];
            if($lang == "RO"){
               header("location:RO/index.php");
            }else if($lang == "EN"){
                header("location:EN/index.php");
            }
        }
        ?>
        <div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
            <div style="display:flex; flex-direction:column; justify-content:center; align-items:center;">
              <img src="img/email.png" style="width:400px; height:auto;" >
              <h3>Select your language:</h3>
              <a style="color:white; background-color:red; text-decoration:none; padding:0.5rem; margin:0.5rem;" href="EN/index.php">English</a>
              <a style="color:white; background-color:red; text-decoration:none; padding:0.5rem; margin:0.5rem;" href="RO/index.php">Română</a>
            </div>

        </div>
        
    </body>
</html>