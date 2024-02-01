<?php
session_start();
include 'includes/dbh.inc.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];

    update($conn, $name, $email);
}

if (isset($_POST["delete"])) {
    $id = $_SESSION["userid"];

    delete($conn, $id);
}

function update($conn, $name, $email) {
    $sql = "UPDATE users SET usersEmail = ?, usersUid = ? WHERE usersId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../parts.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssi", $email, $name, $_SESSION["userid"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // You can redirect to a success page or perform other actions after the update
    // For example, you can redirect to the profile page:
    header("location: profile.php?success=update");
    exit();
}

function delete($conn, $id) {
    $sql = "DELETE FROM users WHERE usersId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id); // Bind the user ID as an integer
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    session_start();
session_unset();
session_destroy();

header("location: ../index.php");
        exit();
}

if (isset($_POST["updateList"])) {
    include_once 'upload.php';

    $image = $fileDestinationNew; // Handle file uploads separately
    $title = $_POST["title"];
    $quantity = $_POST["quantity"];
    $part = $_POST["part"];
    $price1 = $_POST["1"];
    $price2 = $_POST["2"];

    updateListing($image, $title, $quantity, $part, $price1, $price2);
}