<?php
$host="localhost";
$user="root";
$password=""; 
$dbname="pos";

$connect=mysqli_connect($host,$user,$password,$dbname);

if(!$connect){
    echo "No Connection";
}else{
     //echo "We are good to go";
}

?>