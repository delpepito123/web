<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = ""; //xampp le password est vide
$dBName = "loginsystem";

$connection = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName); // connection à la db

if(!$connection){
    die("Connection failed : ".mysqli_connect_error()); // fonction die = exit
}

?>