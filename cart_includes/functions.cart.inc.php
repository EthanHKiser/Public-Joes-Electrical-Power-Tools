<?php

function addToCart($conn, $userId, $productName, $productPrice, $productImage, $productQuanity, $productMpn) {
    $sql = "INSERT INTO cart (userId, name, price, image, quanity, part) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../parts.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ssssss", $userId, $productName, $productPrice, $productImage, $productQuanity, $productMpn);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../cart.php?error=none");
        exit();
}