<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "mydb";

$connection = mysqli_connect($servername,$username,$password,$db);

if(!$connection){
    die ("connection error" . mysqli_connect_error());
}
else{
   // echo "connected succesfully";
}

