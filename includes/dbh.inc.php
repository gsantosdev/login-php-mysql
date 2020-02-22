<?php

$servername = "localhost";
$dBusername = "root";
$dBPassword = "";
$dBname = "sistemalogin";


$conn = mysqli_connect($servername, $dBusername, $dBPassword,$dBname);

if(!$conn)
{
    die("Connection failed: ".mysqli_connect_error());
    
}