<?php

$servername = "localhost";
$dBusername = "root";
$dBPassword = "";
$dbName = "sistemalogin";


$conn = mysqli_connect($servername, $dbUsername, $dBname);

if(!$conn)
{
    die("Connection failed: ".mysqli_connect_error());
    
}