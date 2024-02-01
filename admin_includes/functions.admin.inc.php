<?php
//
function uidExists($conn, $username) {
    $sql = "SELECT * FROM admins WHERE adminsUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $username);
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
//
function createAdmin($conn, $username, $pwd) {
    $sql = "INSERT INTO admins (adminsUid, adminsPwd) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../adminsignup.php?error=none");
        exit();
}

function emptyInputLogin($username, $pwd) {
    $results;
    if (empty($username) || empty($pwd)) {
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

function emptyInputSignup($username, $pwd, $pwdRepeat) {
    $results;
    if (empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $results = true;
    }
    else {
        $results = false;
    }
    return $results;
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username);

    if ($uidExists === false) {
       header("location: ../adminlogin.php?error=wronglogin");
    exit();
   }

    $pwdHashed = $uidExists["adminsPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../adminlogin.php?error=wronglogin");
        exit();
    }
    elseif ($checkPwd === true) {
        session_start();
        $_SESSION["adminsid"] = $uidExists["adminsId"];
        $_SESSION["adminsuid"] = $uidExists["adminsUid"];
        header("location: ../index.php");
        exit();
    }
}