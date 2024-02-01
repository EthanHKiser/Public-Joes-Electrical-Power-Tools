<?php

if (isset($_POST["submit"])) {
    $username = $_POST["adminUid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once '../includes/dbh.inc.php';
    require_once 'functions.admin.inc.php';

    if (emptyInputSignup($username, $pwd, $pwdRepeat) !== false) {
        header("location: ../adminedit.php?error=emptyinput");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../adminedit.php?error=passwordsdontmatch");
        exit();
    }

    createAdmin($conn, $username, $pwd);

}
else {
    header("location: ../adminedit.php");
    exit();
}

    createAdmin($conn, $username, $pwd);