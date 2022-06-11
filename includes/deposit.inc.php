<?php

session_start();

if(isset($_POST["depositSubmit"])){
    $deposit = $_POST["depositAmount"];
    
    require_once 'dbh.inc.php';

    updateBalanceDeposit($conn, $deposit);
    insertTransactionsDeposit($conn, $deposit);

    sleep(2);
    header("location: ../Profile.php");
    exit();
}
else{
    header("location: ../Profile.php");
    exit();
}

function updateBalanceDeposit($conn, $deposit){
    $sql = "UPDATE users SET usersBalance = ? WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../Profile.php?error=stmtFailed");
        exit();
    }

    $_SESSION["usersBalance"] += $deposit;

    mysqli_stmt_bind_param($stmt, "ds", $_SESSION["usersBalance"], $_SESSION["usersUid"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function insertTransactionsDeposit($conn, $deposit){
    $type = "Deposit";

    $sql = "INSERT INTO transactions (usersUid, transactionsType, transactionsAmount, usersBalance, transactionsDate) VALUES (?, ?, ?, ?, current_timestamp());";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../Profile.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssdd", $_SESSION["usersUid"], $type, $deposit, $_SESSION["usersBalance"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}