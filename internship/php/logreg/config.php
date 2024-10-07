<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "registerpage"; 
$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error()); 
}

?>