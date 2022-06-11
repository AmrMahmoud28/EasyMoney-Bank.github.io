<?php
if (isset($_POST["signupSubmit"])) {
    $fullName = $_POST["nameField"];
    $email = $_POST["emailField"];
    $username = $_POST["newUsernameField"];
    $password = $_POST["newPasswordField"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (invalidUid($username) !== false) {
        header("location: ../Registration.php?error=invalidUid");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../Registration.php?error=invalidEmail");
        exit();
    }

    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../Registration.php?error=usernameTaken");
        exit();
    }

    createUser($conn, $fullName, $email, $username, $password);

} else {
    header("location: ../Registration.php");
    exit();
}
