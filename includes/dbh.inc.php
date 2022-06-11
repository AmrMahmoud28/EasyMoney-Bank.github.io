<?php

$serverName = "sql11.freesqldatabase.com";
$dBUserName = "sql11499111";
$dBPassword = "UxqXwwJkSp";
$dBName = "sql11499111";

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}