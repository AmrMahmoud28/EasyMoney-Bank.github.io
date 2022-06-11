<?php

if(isset($_POST["signinSubmit"])){
    $username = $_POST["usernameField"];
    $password = $_POST["passwordField"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    loginUser($conn , $username , $password);
}
else{
    header("location: ../Registration.php");
    exit();
}