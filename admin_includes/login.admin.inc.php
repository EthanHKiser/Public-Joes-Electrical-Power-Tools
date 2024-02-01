<?php

if (isset($_POST["submit"])) {
    $username = $_POST["adminUid"];
    $pwd = $_POST["pwd"];

    require_once '../includes/dbh.inc.php';
    require_once 'functions.admin.inc.php';

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../adminedit.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
}
else {
    header("location: ../adminlogin.php");
    exit();
}