<?php

function emptyInputSignup($email, $uid, $pwd, $pwdRepeat) {
    $results;
    if (empty($email) || empty($uid) || empty($pwd) || empty($pwdRepeat)) {
        $results = true;
    }
    else {
        $results = false;
    }
    return $results;
}

function invalidUid($uid) {
    $results;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        $results = true;
    }
    else {
        $results = false;
    }
    return $results;
}

function invalidEmail($email) {
    $results;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $results = true;
    }
    else {
        $results = false;
    }
    return $results;
}

function pwdMatch($pwd, $pwdRepeat) {
    $results;
    if ($pwd !== $pwdRepeat) {
        $results = true;
    }
    else {
        $results = false;
    }
    return $results;
}

function emailExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultsData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultsData)) {
        return $row;
    }
    else {
        $results = false;
        return $results;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $email, $uid, $pwd) {
    $sql = "INSERT INTO users (usersEmail, usersUid, usersPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "sss", $email, $uid, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
        exit();
}

function emptyInputLogin($email, $pwd) {
    $results;
    if (empty($email) || empty($pwd)) {
        $results = true;
    }
    else {
        $results = false;
    }
    return $results;
}

function loginUser($conn, $email, $pwd) {
    $emailExists = emailExists($conn, $email);

    if ($emailExists === false) {
        header("location: ../signin.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $emailExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../signin.php?error=wronglogin");
        exit();
    }
    elseif ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $emailExists["usersId"];
        $_SESSION["useruid"] = $emailExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
}