<?php
$host="localhost";
$user="root"; 
$password=""; 
$dbname="pos"; 

$connect_online=mysqli_connect($host,$user,$password,$dbname);

if(!$connect_online){
    echo "No Connection";
}else{
     //echo "We are good to go";
}

?>