<?php

if (isset($_POST["submit"])) {
    
    $email = $_POST["email"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // error handlers

    if (emptyInputSignup($email, $uid, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUid($uid) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (emailExists($conn, $email) !== false) {
        header("location: ../signup.php?error=emailtaken");
        exit();
    }

    createUser($conn, $email, $uid, $pwd);

}
else {
    header("location: ../signup.php");
    exit();
}