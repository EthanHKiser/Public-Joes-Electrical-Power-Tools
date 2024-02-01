<?php

function createListing($conn, $image, $title, $quanity, $partNo, $price1, $price2, $description) {
    $sql = "INSERT INTO shop (itemImage, itemTitle, itemQuanity, itemPartNumber, itemPrice1, itemPrice2, description) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../adminedit.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "sssssss", $image, $title, $quanity, $partNo, $price1, $price2, $description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../adminedit.php?error=none");
    exit();
}