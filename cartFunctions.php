<?php
session_start();

include 'includes/dbh.inc.php';

function removeItem($conn, $user, $part) {
    $sql = "DELETE FROM cart WHERE userId = ? AND partNum = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../parts.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "is", $user, $part);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if (isset($_POST["remove_item"])) {
    $user = $_SESSION['userid'];
    $part = $_POST["partNum"];
    removeItem($conn, $user, $part);
    header("location: cart.php?error=removed");
}

// UPDATEING CART

function update($conn, $userId, $quantity, $partNum) {
    $sql = "UPDATE cart SET quantity = ? WHERE userId = ? AND partNum = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../parts.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iis", $quantity, $userId, $partNum);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if (isset($_POST["update_quantity"])) {
    $userId = $_SESSION['userid'];
    $quantity = $_POST["quantity"];
    $partNum = $_POST["partNum"];

    update($conn, $userId, $quantity, $partNum);
    header("location: cart.php");
}

