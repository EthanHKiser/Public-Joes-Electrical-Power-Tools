<?php

include_once '../upload.php';

if (isset($_POST["submit"])) {
    
    $image = $fileDestinationNew;
    $title = $_POST["title"];
    $quanity = $_POST["productquanity"];
    $partNo = $_POST["partNo"];
    $price1 = $_POST["price1"];
    $price2 = $_POST["price2"];
    $description = $_POST["descpription"];

    require_once '../includes/dbh.inc.php';
    require_once 'functions.list.inc.php';

    createListing($conn, $image, $title, $quanity, $partNo, $price1, $price2, $description);

}
else {
    header("location: ../adminedit.php");
    exit();
}