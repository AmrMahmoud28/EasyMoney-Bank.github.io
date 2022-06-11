<?php

function invalidUid($username)
{
    $result = true;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email)
{
    $result = true;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../Registration.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $fullName, $email, $username, $password)
{
    $cardNumber = getUserCardNumber();
    $cardExpires = getUsersCardExpires();
    $cardCVV = getUsersCardCVV();
    $balance = 0;

    $sql = "INSERT INTO users (usersFullName, usersEmail, usersUid, usersPwd, usersCardNumber, usersCardExpires, usersCardCVV, usersBalance) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../Registration.php?error=stmtFailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssd", $fullName, $email, $username, $hashedPwd, $cardNumber, $cardExpires, $cardCVV, $balance);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    loginUser($conn, $username, $password);
}

// ===================================================================================================

function loginUser($conn, $username, $password)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../Registration.php?error=wrongLogin");
        exit();
    }

    $passwordHashed = $uidExists["usersPwd"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {
        header("location: ../Registration.php?error=wrongLogin");
        exit();
    } else if ($checkPassword === true) {
        session_start();

        $_SESSION["usersId"] = $uidExists["usersId"];
        $_SESSION["usersFullName"] = $uidExists["usersFullName"];
        $_SESSION["usersEmail"] = $uidExists["usersEmail"];
        $_SESSION["usersUid"] = $uidExists["usersUid"];
        $_SESSION["usersCardNumber"] = $uidExists["usersCardNumber"];
        $_SESSION["usersCardExpires"] = $uidExists["usersCardExpires"];
        $_SESSION["usersCardCVV"] = $uidExists["usersCardCVV"];
        $_SESSION["usersBalance"] = $uidExists["usersBalance"];

        sleep(1);
        header("location: ../Profile.php");
        exit();
    }
}

// ===================================================================================================

function getUserCardNumber()
{
    $num1 = "4685";
    $num2 = rand(1000, 9999);
    $num3 = rand(1000, 9999);
    $num4 = rand(1000, 9999);

    $cardNumber = "$num1 $num2 $num3 $num4";
    return $cardNumber;
}

function getUsersCardExpires()
{
    $year = "" . (date("Y") + 4);
    $year = $year[2] . $year[3];

    $month = "" . date("m");

    $cardExpires = "$month/$year";
    return $cardExpires;
}

function getUsersCardCVV()
{
    $cardCVV = "" . rand(100, 999);
    return $cardCVV;
}
