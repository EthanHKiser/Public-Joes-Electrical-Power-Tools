<?php

session_start();
include '../includes/functions.inc.php';
include '../includes/dbh.inc.php';

if (isset($_POST["submit"])) {
    $userId = $_SESSION["userid"];
    $image = $_POST["image"];
    $title = $_POST["title"];
    $part = $_POST["part"];
    $quantity2 = 1;
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    $_SESSION["quantity"] = $quantity;

    cartChecker($conn, $userId, $image, $title, $part, $quantity2, $quantity, $price);
}

function cartChecker($conn, $userId, $image, $title, $part, $quantity2, $quantity, $price) {
    $sql = "SELECT * FROM cart WHERE userId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../parts.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);

    $resultsData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultsData)) {
        Checker($conn, $userId, $image, $title, $part, $quantity2, $quantity, $price);
    } else {
        AddToCart($conn, $userId, $image, $title, $part, $quantity2, $quantity, $price);
    }

    mysqli_stmt_close($stmt);
}

function Checker($conn, $userId, $image, $title, $part, $quantity2, $quantity, $price) {
    $sql = "SELECT * FROM cart WHERE userId = $userId AND partNum = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../parts.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $part);
    mysqli_stmt_execute($stmt);

    $resultsData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultsData)) {
        header("location: ../parts.php?error=productincart");
        exit();
    } else {
        AddToCart($conn, $userId, $image, $title, $part, $quantity2, $quantity, $price);
    }

    mysqli_stmt_close($stmt);
}

function AddToCart($conn, $userId, $image, $title, $part, $quantity2, $quantity, $price) {
    $sql = "INSERT INTO cart (userId, title, price, img, quantity, quantity2, partNum) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../part.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "isssiis", $userId, $title, $price, $image, $quantity2, $quantity, $part);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../cart.php");
        exit();
}