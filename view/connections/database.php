<?php
$hostName="localhost";
$DbUserName="root";
$password="";
$databaseName="makeatry";
$connect = mysqli_connect($hostName,$DbUserName,$password,$databaseName);
if(!$connect){
    die("DataBase Error");
}
else{
// echo "Connected";
}
?>