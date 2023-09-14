<?php

// -------- si ya le dimos a recordar
if (isset($_COOKIE['username_Cookie'])) {
    header('location: orders.php');
} else {
}

//------ para cuando le damos al boton type=submit, su name=login
if (isset($_POST['login'])) {
    include("reciclado/conectar_base_datos.php");
    include("reciclado/conectar_base_datos_online.php");
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * from admins WHERE username='$username' AND password='$password'";
    $resultado = $connect->query($sql);
    if ($resultado->num_rows > 0) {
        $resultadoFinal = $resultado->fetch_assoc();
        // VAMOS A CREAR COOKIE SI O SI
            //echo $resultadoFinal['username'];
            setcookie('username_Cookie', $resultadoFinal['username'], time() + 3600 * 24 * 30,"/");

            header('location: orders.php');
        
    }
}


?>




<form action="index.php" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <button type="submit" name="login">Log in</button>
    </div>
</form>

<?php
if (isset($_POST['login'])) {

    if ($resultado->num_rows > 0){
        header('location: orders.php');
    } else {
        echo "Username o Password no correctas.";
    }
}
?>